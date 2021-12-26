<?php

if( isset($_POST['save']) ):

  $sorsazm    = (!empty($_POST['sorszam']) and is_num($_POST['sorszam'])) ? $_POST['sorszam'] : false;

  $query = sprintf('SELECT * FROM `ertekesites` WHERE cimke="%s"',
  $mysqli->real_escape_string($sorszam));
  $result_email_chk = $mysqli->query($query_email_chk);
  $email_count = $result_email_chk->num_rows;

else:

?>

  <form method="post" action="/ertekesites" autocomplete="off" >
    <fieldset>
        <legend>Új értékesítés</legend>

        <label for="telephely">Telephely</table>
        <p><?php echo $branch; ?></p>

        <label for="datum">Dátum</label>
        <input name="datum" type="date" value="<?php print(date('Y-m-d')); ?>" required>

        <label for="sorszam">Címke sorszáma</label>
        <input name="sorszam" type="text" value="" placeholder="Olvasd be a vonalkódot" required>

        <label>Termék</label>
        <div class="radio-group">
          <?php
            $query = ('SELECT * FROM `termek` ORDER BY `nev` ASC');
            $result = $mysqli->query($query);
            while($termekek = $result->fetch_assoc()) {
                $kn_szam = substr($termekek['kn'], 0, 4) . ' ' . substr($termekek['kn'], 3, 2) . ' '. substr($termekek['kn'], 5, 2);
                echo('<input id="termek' . $termekek['id'] . '" type="radio" name="termek" value="' . $termekek['kn'] .'" label="'.$termekek['nev'].'" title="'.$kn_szam.'" required>');
            }
          ?>
        </div>

        <button name="save" value="uj" >Mentés</button>
        <a href="/" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
    </fieldset>
  </form>

<?php

endif;

?>