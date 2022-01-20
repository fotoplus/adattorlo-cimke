<?php 

$segments[1] = isset($segments[1]) ? $segments[1] : false;
switch($segments[1]):
  default:
    ?>

      <nav>  
          <ul>    
            <li><a href="/adatszolgaltatas/jegyzek-lista" class="space">Jegyzékek listázása</a> -- Fejlesztés alatt!</li>
            <li><a href="/adatszolgaltatas/teljes-lekerdezes" class="space">Teljes lekérdezés indítása</a></li>
          </ul>
          <a href="/" class="space">Vissza</a>
        </nav>

      
      
      
    <?php
  break;
  case "jegyzek-lista":
    $query=('SELECT `id`, `datum`, `iktatoszam` FROM `atadas-atvetel` ORDER BY `datum` ASC');
    $result = $mysqli->query($query);
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
  case "teljes-lista":
    $query=('SELECT `cimke`.`sorszam` AS `cimke`, `kn` , `datum`, `telephely` FROM `cimke` LEFT JOIN `ertekesites` ON `ertekesites`.`sorszam`=`cimke`.`sorszam` WHERE 1');
    $result = $mysqli->query($query);
    echo '<a href="/" class="space">Vissza</a>';
    echo '<table style="border:1px solid #ccc; text-align: center;" width="100%">';
    while($row = $result->fetch_assoc()) {
      $vtsz= substr($row['kn'], 0, 4);
      echo ('
        <tr>
            <td style="border:1px solid #ccc;">'.$row['cimke'].'</td>
            <td style="border:1px solid #ccc;">'.$row['datum'].'</td>
            <td style="border:1px solid #ccc;">'.$vtsz.'</td>
            <td style="border:1px solid #ccc;">'.$row['telephely'].'</td>
        </tr>');
    }

    echo '</table>';
    echo '<a href="/" class="space">Vissza</a>';
  break;
endswitch;

?>