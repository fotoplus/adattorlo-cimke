<?php require_once ('e/modules/accesscontrol/ipcheck.php');

?>

<h1>Új átadás/átvétel rögzítése</h1>

<form name="feltoltes" method="post">
 
 <?php
 ?>
  <h2>Átadójegyzék</h2>

  <input name="step" type="hidden" value="jegyzek" >

  <legend for="iktatoszam">Átadó jegyzék iktatószáma</legend>
  <input name="iktatoszam" type="text" value="">

  <legend for="datum">Átadás/átvétel ideje</legend>
  <input name="datum" type="date" value="">

  <input type="subit" name="tovabb" vlaue="Mentés és tovább" title="Menti a jegyzék adatait és továbblép a cimkék rögzítéséhez" >
  <input type="subit" name="mentes" vlaue="Mentés" >
  <a href="/feltoltes" title="Mentés nélküli visszalépés" >Vissza</a>

<?php
 ?>

</from>