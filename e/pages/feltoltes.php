<?php require_once ('e/modules/accesscontrol/ipcheck.php');

?>

<div id="main-center" class="rounded-main border-main">


  <?php
  $segments[1] = isset($segments[1]) ? $segments[1] : false;
  switch($segments[1]):
    default:
      ?>
        <a href="/feltolte/jegyzek">Jegyzék</a>
        <a href="/feltolte/cimke">Cimke</a>
      <?php
    break;
    case "jegyzek":
  ?>

    <form method="post" action="/feltoltes/jegyzek">
      <fieldset>
          <legend>Új jegyzék rögzítése</legend>

          <input name="step" type="hidden" value="jegyzek" >

          <label for="iktatoszam">Átadó jegyzék iktatószáma</label>
          <input name="iktatoszam" type="text" value="">

          <label for="datum">Átadás/átvétel ideje</label>
          <input name="datum" type="date" value="">

          <button name="save" >Mentés</button>
          <a href="/feltoltes" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
      </fieldset>
    </from>
  <?php
    break;

  endswitch;

  ?>

</div>
