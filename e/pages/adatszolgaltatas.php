<?php 

$segments[1] = isset($segments[1]) ? $segments[1] : false;
switch($segments[1]):
  default:
    ?>
      <p>Ez még nem készült el.</p>
      <a href="/" class="space">Vissza</a>
      <a href="/adatszolgaltatas/teljes-lista" class="space">Teljes lekérdezés indítása</a>
    <?php
  break;
  case "teljes-lista":
    $query=('SELECT `cimke`.`sorszam` AS `cimke`, `kn` , `datum`, `telephely` FROM `cimke` LEFT JOIN `ertekesites` ON `ertekesites`.`sorszam`=`cimke`.`sorszam` WHERE 1');
    $result = $mysqli->query($query);
    echo '<table>';
    while($row = $result->fetch_assoc()) {
      echo <<<HTML
        <tr>
            <td>$row['cimke']</td>
            <td>$row['datum']</td>
            <td>substr($row['kn'], 0, 4)</td>
            <td>$row['telephely']</td>
        </tr>
      HTML;

    }
    echo '</table>';
    echo '<a href="/" class="space">Vissza</a>';
  break;
endswitch;

?>