<div id="main-center">

<?php


?>

  <form method="post" action="/ertekesites" autocomplete="off" >
    <fieldset>
        <legend>Új értékesítés</legend>

        <label for="datum">Dátum</label>
        <input name="datum" type="date" value="<?php print(date('Y-m-d')); ?>" required>

        <label for="sorszam">Címke sorszáma</label>
        <input name="sorszam" type="text" value="" placeholder="Olvasd be a vonalkódot" required>

        <label for="termek">Termék</label>
        <select name="termek" required="required">
          <option disabled="disabled">Válassz a listából</option>
          <option >1</option>
          <option >2</option>
        </select>



        <button name="save" value="uj" >Mentés</button>
        <a href="/ertekesites" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
    </fieldset>
  </form>
</div>