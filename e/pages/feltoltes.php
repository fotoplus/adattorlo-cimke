<?php require_once ('e/modules/accesscontrol/ipcheck.php');

?>



<h1>Új átadás/átvétel rögzítése</h1>


<?php

switch($segments[1]):
  default:

  break;
  case 
?>
  <form method="post" action="/feltoltes/jegyzek">
    <fieldset>
        <legend>Átadójegyzék</legend>

        <input name="step" type="hidden" value="jegyzek" >

        <label for="iktatoszam">Átadó jegyzék iktatószáma</label>
        <input name="iktatoszam" type="text" value="">

        <label for="datum">Átadás/átvétel ideje</label>
        <input name="datum" type="date" value="">

        <input type="submit" name="tovabb" vlaue="Mentés és tovább" title="Menti a jegyzék adatait és továbblép a cimkék rögzítéséhez" >
        <input type="submit" name="mentes" vlaue="Mentés" >
        <a href="/feltoltes" title="Mentés nélküli visszalépés" >Vissza</a>
    </fieldset>
  </from>
<?php

endswitch;

?>

