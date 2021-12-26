<?php

if( isset($_POST['save']) ):

  if(
    isset($_POST['sorszam'])
    and
    !empty($_POST['sorszam'])
  ):
    $sorszam = str_replace('ö', 0, $_POST['sorszam']);
    $sorszam = is_numeric($sorszam) ? $sorszam : false;
  else:
    $sorszam=false;
  endif;


  if($sorszam):
    $query = sprintf('SELECT * FROM `ertekesites` WHERE `sorszam=`"%s"', $mysqli->real_escape_string($sorszam));
    $result = $mysqli->query($query);
    $count = $result->num_rows;

    if($count > 0):
      $err='Ez a sorszámú címke már ki lett adva. Egy címke csak egy alkalommal adható ki.';
    else:
      $query = sprintf('SELECT * FROM `cimke` WHERE `sorszam`="%s"', $mysqli->real_escape_string($sorszam));
      $result = $mysqli->query($query);
      $count = $result->num_rows;

      if($count < 1):
        $err='Ez a címke nem szerepel a jegyzékben, az nem lett még felvíve vagy nem ehhez a céghez tartozik.';
      elseif($count > 1):
        $err='Ez a címke egynél többször szerepel a jegyzében. Ilyen nem fordulhatna elő, jelezd a hibát az illetékesnek.';
      endif;
  
    endif;

  else:
    $err='Hiányzó/hibás sorszám. A sorszám csak számokat tartalmazhat.';
  endif;


  if(!$err) {

  } else {
    echo <<<HTML
      <div id="error"> . $err . </div>
      <a href="/ertekesites">Vissza</a>
    HTML;
  }

else:

?>

  <form method="post" action="/ertekesites" autocomplete="off" >
    <fieldset>
        <legend>Új értékesítés <br> <?php echo $branch; ?> </legend>

        <label for="datum">Dátum</label>
        <input name="datum" type="date" value="<?php print(date('Y-m-d')); ?>" required>

        <label for="sorszam">Címke sorszáma</label>
        <input name="sorszam" type="text" value="" placeholder="Olvasd be a vonalkódot" required>

        <label>Termék</label>
        <div class="radio-group">
          <?php
            $query = ('SELECT * FROM `termek` ORDER BY `id` ASC');
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