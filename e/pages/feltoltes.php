<?php require_once ('e/modules/accesscontrol/ipcheck.php');

?>



<h1>Új átadás/átvétel rögzítése</h1>

<form name="feltoltes" method="post">
  <fieldset>
    <?php
    ?>
      <legend>Átadójegyzék</legend>

      <input name="step" type="hidden" value="jegyzek" >

      <label for="iktatoszam">Átadó jegyzék iktatószáma</label>
      <input name="iktatoszam" type="text" value="">

      <label for="datum">Átadás/átvétel ideje</label>
      <input name="datum" type="date" value="">

      <input type="subit" name="tovabb" vlaue="Mentés és tovább" title="Menti a jegyzék adatait és továbblép a cimkék rögzítéséhez" >
      <input type="subit" name="mentes" vlaue="Mentés" >
      <a href="/feltoltes" title="Mentés nélküli visszalépés" >Vissza</a>

    <?php
    ?>
  </fieldset>
</from>