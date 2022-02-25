<?php


$result_osszes = $mysqli->query('SELECT `id` FROM `cimke` WHERE 1');
$osszes = $result_osszes->num_rows;

$result_nincs_atadva = $mysqli->query('SELECT `id` FROM `cimke` WHERE `tid` IS NULL');
$nincs_atadva = $result_nincs_atadva->num_rows;


$result_eladott = $mysqli->query('SELECT `id` FROM `ertekesites` WHERE 1');
$eladott = $result_eladott->num_rows;

$eladhato = $osszes - $eladott;

echo <<<HTML
  <section class="rounded-main">
    <h1>Címkék</h1>
    <table>
      <tr>
        <td>Összes</td>
        <td>Eladott</td>
        <td>Eladható</td>
        <td>Szabad</td>
      </tr>
      <tr>
        <td class="rounded-main">{$osszes}</td>
        <td class="rounded-main">{$eladott}</td>
        <td class="rounded-main">{$eladhato}</td>
        <td class="rounded-main">{$nincs_atadva}</td>
      </tr>
    </table>
  </section>

  <h1>Telephelyek szerint</h1>
HTML;


$result = $mysqli->query('SELECT * FROM `telephelyek` ORDER BY `id` ASC');
while($row = $result->fetch_assoc()) {

  $result_osszes = $mysqli->query('SELECT `id` FROM `cimke` WHERE `tid` = '. $row['id']);
  $osszes = $result_osszes->num_rows;

  $result_eladott = $mysqli->query('SELECT `id` FROM `ertekesites` WHERE `tid` = '. $row['id']);
  $eladott = $result_eladott->num_rows;

  $eladhato = $osszes - $eladott;

  echo <<<HTML
      <section class="rounded-main">
        <h2>{$row['name']}</h2>
        <table>
          <tr>
            <td>Összes</td>
            <td>Eladott</td>
            <td>Eladható</td>
          </tr>
          <tr>
            <td class="rounded-main">{$osszes}</td>
            <td class="rounded-main">{$eladott}</td>
            <td class="rounded-main">{$eladhato}</td>
          </tr>
        </table>
      </section>
    HTML;
}

echo <<<HTML
<p><a href="/" title="Vissza" class="space">Vissza</a></p>
HTML;

?>