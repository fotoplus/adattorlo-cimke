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

        <label>Termék</label>
        
        
        



        <button name="save" value="uj" >Mentés</button>
        <a href="/ertekesites" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
    </fieldset>
  </form>
</div>