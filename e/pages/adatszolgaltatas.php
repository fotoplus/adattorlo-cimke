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