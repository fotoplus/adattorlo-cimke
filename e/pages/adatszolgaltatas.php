<?php 

$segments[1] = isset($segments[1]) ? $segments[1] : false;
switch($segments[1]):
  default:
    ?>
      <nav>  
          <ul>    
            <li><a href="/adatszolgaltatas/jegyzek-lekerdezes" class="space">Jegyzékek listázása</a></li>
            <li><a href="/adatszolgaltatas/teljes-lekerdezes" class="space">Teljes lekérdezés indítása</a></li>
          </ul>
          <a href="/" class="space">Vissza</a>
        </nav>

      
      
      
    <?php
  break;
  case "jegyzek-lekerdezes":

    if( isset($_POST['jegyzek']) and is_numeric($_POST['jegyzek']) ):

      echo <<<HTML
        <a href="/adatszolgaltatas/jegyzek-lekerdezes" class="space">Vissza</a>
      HTML;


      $result = $mysqli->query('SELECT * FROM `telephelyek` ORDER BY `id` ASC LIMIT 10');
      $telephelyek=array();
      while($row = $result->fetch_assoc()) {
          $telephelyek[ $row["id"] ] = $row["name"];
      }

      $query=('SELECT `cimke`.`sorszam` AS `cimke`, `kn` , `datum`, `tszam`, `doboz`, `csomag` , `ertekesites`.`tid` AS `e_tid`, `cimke`.`tid` AS `c_tid` FROM `cimke` LEFT JOIN `ertekesites` ON `ertekesites`.`sorszam`=`cimke`.`sorszam` WHERE `cimke`.`aid` = %s');
      $query = sprintf($query, $mysqli->real_escape_string($_POST['jegyzek']));
      $result = $mysqli->query($query);
      echo <<<HTML
        <table style="border:1px solid #ccc; text-align: center;" width="100%">
        <tr>
            <td style="border:1px solid #ccc;">Csomag azonosító</td>
            <td style="border:1px solid #ccc;">Címke sorszáma</td>
            <td style="border:1px solid #ccc;">Doboz azonosító</td>
            <td style="border:1px solid #ccc;">Átadás dátuma</td>
            <td style="border:1px solid #ccc;">VTSZ</td>
            <td style="border:1px solid #ccc;">Eladta <span class="red">(törlendő!)</span></td>
            <td style="border:1px solid #ccc;">Helye <span class="red">(törlendő!)</span></td>
        </tr>
      HTML;
  
      while($row = $result->fetch_assoc()) {
        $vtsz= substr($row['kn'], 0, 4);

        $telephely_e = !empty($telephelyek[ $row['e_tid'] ]) ? $telephelyek[ $row['e_tid'] ] : false;
        $telephely_c = !empty($telephelyek[ $row['c_tid'] ]) ? $telephelyek[ $row['c_tid'] ] : false;

        echo <<<HTML
          <tr>
              <td style="border:1px solid #ccc;">t{$row['tszam']}/d{$row['doboz']}/csb{$row['csomag']}</td>
              <td style="border:1px solid #ccc;">{$row['cimke']}</td>
              <td style="border:1px solid #ccc;">t{$row['tszam']}/d{$row['doboz']}</td>
              <td style="border:1px solid #ccc;">{$row['datum']}</td>
              <td style="border:1px solid #ccc;">{$vtsz}</td>
              <td style="border:1px solid #ccc;">{$telephely_e}</td>
              <td style="border:1px solid #ccc;">{$telephely_c}</td>
          </tr>
        HTML;
      }
  
      echo <<<HTML
        </table>
        <a href="/adatszolgaltatas/jegyzek-lekerdezes" class="space">Vissza</a>
      HTML;

    else:

      $query=('SELECT `id`, `datum`, `iktatoszam` FROM `atadas-atvetel` ORDER BY `datum` ASC');
      $result = $mysqli->query($query);
      echo <<<HTML
        <p>Ez a funkció még nem működik!</p>
        <a href="/adatszolgaltatas" class="space">Vissza</a>
        <form name="jegyzek-lekerdezes" method="post">
          <table style="border:1px solid #ccc; text-align: center;" width="100%">
      HTML;

      while($row = $result->fetch_assoc()) {
        echo <<<HTML
            <tr>
                <td style="border:1px solid #ccc;">{$row['iktatoszam']}</td>
                <td style="border:1px solid #ccc;">{$row['datum']}</td>
                <td style="border:1px solid #ccc;"><button name="jegyzek" value="{$row['id']}" title="Lekérdezés indítása erre a jegyzékre">Lekérdezés</button></td>
            </tr>
        HTML;
      }

      echo <<<HTML
          </table>
        </form>
        <a href="/adatszolgaltatas" class="space">Vissza</a>
      HTML;

    endif;

  break;
  /*
  case "jegyzek-lekerdezes":
    echo '<a href="/adatszolgaltatas/jegyzek-lista" class="space">Vissza</a>';

    echo '<a href="/adatszolgaltatas/jegyzek-lista" class="space">Vissza</a>';
  break;
  */
  case "teljes-lekerdezes":

    $result = $mysqli->query('SELECT * FROM `telephelyek` ORDER BY `id` ASC LIMIT 10');
    $telephelyek=array();
    while($row = $result->fetch_assoc()) {
        $telephelyek[ $row["id"] ] = $row["name"];
    }

    $query=('SELECT `cimke`.`sorszam` AS `cimke`, `kn` , `datum`, `tszam`, `doboz`, `csomag` , `ertekesites`.`tid` AS `e_tid`, `cimke`.`tid` AS `c_tid` FROM `cimke` LEFT JOIN `ertekesites` ON `ertekesites`.`sorszam`=`cimke`.`sorszam` WHERE 1');
    $result = $mysqli->query($query);
    echo <<<HTML
      <a href="/adatszolgaltatas" class="space">Vissza</a>
      <table style="border:1px solid #ccc; text-align: center;" width="100%">
      <tr>
          <td style="border:1px solid #ccc;">Csomag azonosító</td>
          <td style="border:1px solid #ccc;">Címke sorszáma</td>
          <td style="border:1px solid #ccc;">Doboz azonosító</td>
          <td style="border:1px solid #ccc;">Átadás dátuma</td>
          <td style="border:1px solid #ccc;">VTSZ</td>
          <td style="border:1px solid #ccc;">Eladta <span class="red">(törlendő!)</span></td>
          <td style="border:1px solid #ccc;">Helye <span class="red">(törlendő!)</span></td>
      </tr>
    HTML;

    while($row = $result->fetch_assoc()) {
      $vtsz= substr($row['kn'], 0, 4);

      $telephely_e = !empty($telephelyek[ $row['e_tid'] ]) ? $telephelyek[ $row['e_tid'] ] : false;
      $telephely_c = !empty($telephelyek[ $row['c_tid'] ]) ? $telephelyek[ $row['c_tid'] ] : false;

      echo <<<HTML
        <tr>
            <td style="border:1px solid #ccc;">t{$row['tszam']}/d{$row['doboz']}/csb{$row['csomag']}</td>
            <td style="border:1px solid #ccc;">{$row['cimke']}</td>
            <td style="border:1px solid #ccc;">t{$row['tszam']}/d{$row['doboz']}</td>
            <td style="border:1px solid #ccc;">{$row['datum']}</td>
            <td style="border:1px solid #ccc;">{$vtsz}</td>
            <td style="border:1px solid #ccc;">{$telephely_e}</td>
            <td style="border:1px solid #ccc;">{$telephely_c}</td>
        </tr>
      HTML;
    }

    echo <<<HTML
      </table>
      <a href="/adatszolgaltatas" class="space">Vissza</a>
    HTML;

  break;
endswitch;

?>