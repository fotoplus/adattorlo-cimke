<?php 

$segments[1] = isset($segments[1]) ? $segments[1] : false;
switch($segments[1]):
  default:
    ?>
      <p>Itt csak a teljes lekérdezés "működik".</p>
      <nav>  
          <ul>    
            <li><a href="/adatszolgaltatas/jegyzek-lista" class="space">Jegyzékek listázása</a></li>
            <li><a href="/adatszolgaltatas/teljes-lekerdezes" class="space">Teljes lekérdezés indítása</a></li>
          </ul>
          <a href="/" class="space">Vissza</a>
        </nav>

      
      
      
    <?php
  break;
  case "jegyzek-lista":
    $query=('SELECT `id`, `datum`, `iktatoszam` FROM `atadas-atvetel` ORDER BY `datum` ASC');
    $result = $mysqli->query($query);
    echo '<p>Ez a funkció még nem működik!</p>';
    echo '<a href="/adatszolgaltatas/" class="space">Vissza</a>';
    echo '<table style="border:1px solid #ccc; text-align: center;" width="100%">';
    while($row = $result->fetch_assoc()) {
      echo ('
        <tr>
            <td style="border:1px solid #ccc;">'.$row['iktatoszam'].'</td>
            <td style="border:1px solid #ccc;">'.$row['datum'].'</td>
            <td style="border:1px solid #ccc;"><button name="jegyzek" value="'.$row['id'].'" title="Lekérdezés indítása erre a jegyzékre">Lekérdezés</button></td>
        </tr>');
    }

    echo '</table>';
    echo '<a href="/adatszolgaltatas/" class="space">Vissza</a>';

  break;
  case "jegyzek-lekerdezes":
    
    echo '<a href="/" class="space">Vissza</a>';
  break;
  case "teljes-lekerdezes":
    $query=('SELECT `cimke`.`sorszam` AS `cimke`, `kn` , `datum`, `tszam`, `doboz`, `csomag` , `tid`, `telephelyek`.`name` AS `telephely` FROM `cimke` LEFT JOIN `ertekesites` ON `ertekesites`.`sorszam`=`cimke`.`sorszam` LEFT JOIN `telephelyek` ON `ertekesites`.`tid` = `telephelyek`.`id`');
    $result = $mysqli->query($query);
    echo '<a href="/" class="space">Vissza</a>';
    echo '<table style="border:1px solid #ccc; text-align: center;" width="100%">';
    echo ('
    <tr>
        <td style="border:1px solid #ccc;">Csomag azonosító</td>
        <td style="border:1px solid #ccc;">Címke sorszáma</td>
        <td style="border:1px solid #ccc;">Doboz azonosító</td>
        <td style="border:1px solid #ccc;">Átadás dátuma</td>
        <td style="border:1px solid #ccc;">VTSZ</td>
        <td style="border:1px solid #ccc;">Telephely <span class="red">(törlendő!)</span></td>
    </tr>');

    while($row = $result->fetch_assoc()) {
      $vtsz= substr($row['kn'], 0, 4);
      echo ('
        <tr>
            <td style="border:1px solid #ccc;">t'.$row['tszam'].'/d'.$row['doboz'].'/cs'.$row['csomag'].'</td>
            <td style="border:1px solid #ccc;">'.$row['cimke'].'</td>
            <td style="border:1px solid #ccc;">t'.$row['tszam'].'/d'.$row['doboz'].'</td>
            <td style="border:1px solid #ccc;">'.$row['datum'].'</td>
            <td style="border:1px solid #ccc;">'.$vtsz.'</td>
            <td style="border:1px solid #ccc;" title="'.$row['tid'].'">'.$row['telephely'].'</td>
        </tr>');
    }

    echo '</table>';
    echo '<a href="/" class="space">Vissza</a>';
  break;
endswitch;

?>