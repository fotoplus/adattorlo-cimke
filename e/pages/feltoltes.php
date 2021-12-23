<?php require_once ('e/modules/accesscontrol/ipcheck.php');

?>

<div id="main-center" class="rounded-main border-main">




  <?php

  switch($segments[1]):
    default:

    break;
    case "jegyzek":
  ?>
  
    <h1><span>Új jegyzék<br>iktatószám rögzítése</h1>

    <form method="post" action="/feltoltes/jegyzek">
      <fieldset>
          <legend>Átadójegyzék</legend>

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
