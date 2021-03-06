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
    $query = sprintf('SELECT * FROM `ertekesites` WHERE `sorszam`="%s"', $mysqli->real_escape_string($sorszam));
    $result = $mysqli->query($query);
    $count = $result->num_rows;

    if($count > 0):
      $err='<p>A(z) <span class="bold">'.$sorszam.'</span> sorszámú címke már ki lett adva. Egy címke csak egy alkalommal adható ki.</p>';
    else:
      $query = sprintf('SELECT * FROM `cimke` WHERE `sorszam`="%s"', $mysqli->real_escape_string($sorszam));
      $result = $mysqli->query($query);
      $count = $result->num_rows;

      if($count < 1):
        $err='<p>A(z) <span class="bold">'.$sorszam.'</span> sorszámú címke nem szerepel a jegyzékben, az nem lett még felvíve vagy nem ehhez a céghez tartozik.</p>';
      elseif($count > 1):
        $err='<p>A(z) <span class="bold">'.$sorszam.'</span> sorszámú címke egynél többször szerepel a jegyzében. Ilyen nem fordulhatna elő, jelezd a hibát az illetékesnek.</p>';
      else:
        $datum      = ( isset($_POST['datum']) and !empty($_POST['datum'])) ? date('Y-m-d', strtotime($_POST['datum'])) : false;
        $kn         = ( isset($_POST['termek']) and !empty($_POST['termek'])) ? $_POST['termek'] : false;
        $telephely  = isset($branch['id']) ? $branch['id'] : false;
      
        if(!$datum or !$telephely or !$kn):
          $err="<p>Minden mezőt ki kell tölteni!</p>";
        elseif(date('Y-m-d') < $datum):
          $err='<p>A jövő csak sejthető, de teljes bizonyossággal nem tudhatunk semmit, kivéve, ha valaki a jövőből visszautazott, és megkért arra, hogy vidd fel ezt az értékesítést előre. Ennek viszont beláthatatlan következményei lehennének, ezért erre nincs is lehetőség. </p><iframe src="https://giphy.com/embed/RmfhMeDyN0bVYBFKNR" width="480" height="360" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>';
        endif;
     
      endif;
  
    endif;

  else:
    $err='<p>Hiányzó/hibás sorszám. A sorszám csak számokat tartalmazhat. A kapott sorszám: </p><pre>'.$_POST['sorszam'].'</pre>';
  endif;


  if(!$err):

    $stmt = $mysqli->prepare('INSERT INTO `ertekesites`(`sorszam`, `datum`, `kn`, `tid`) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $sorszam, $datum, $kn, $telephely);

    if($stmt->execute()):
      $msg = '<p>A(z) <span class="bold">'.$sorszam.'</span> sorszámú címke átadását <span class="bold">'.$datum.'</span> dátummal rögzítettük.</p>';
    else:
      // Ez mondjuk hiba esetén nem jelenik meg, mert már feljebb megáll.
      $msg = '<p>Sajnálatos módon valami nem sikerült, az adatbázis válasza: '.$stmt->errorCode().'</p>';
    endif;

    echo <<<HTML
      <div class="msg rounded-main border-main">$msg</div>
      <p><a href="/ertekesites" title="Vissza" class="space">Vissza</a></p>

    HTML;

  else:
    echo <<<HTML
      <div class="error rounded-main"> $err </div>
      <a href="/ertekesites" class="space">Vissza</a>
    HTML;
  endif;

else:

?>

  <form method="post" action="/ertekesites" autocomplete="off" >
    <fieldset>
        <legend>Új értékesítés</legend>

        <label for="datum">Dátum</label>
        <input name="datum" type="date" value="<?php print(date('Y-m-d')); ?>" required>

        <label>Termék</label>
        <div class="radio-group">
          <?php
            $query = ('SELECT * FROM `termek` ORDER BY `id` ASC');
            $result = $mysqli->query($query);
            while($termekek = $result->fetch_assoc()) {
                $kn_szam = substr($termekek['kn'], 0, 4) . ' ' . substr($termekek['kn'], 3, 2) . ' '. substr($termekek['kn'], 5, 2);
                if($termekek['id'] == 1):
                  // A memóriakártyákat letiltjuk, jelen álláspont szerint nem kell adni hozzá címkét.
                  echo('<input id="termek' . $termekek['id'] . '" type="radio" name="termek" value="' . $termekek['kn'] .'" label="'.$termekek['nev'].'" title="'.$kn_szam.'" disabled>');
                else:
                  echo('<input id="termek' . $termekek['id'] . '" type="radio" name="termek" value="' . $termekek['kn'] .'" label="'.$termekek['nev'].'" title="'.$kn_szam.'" required>');
                endif;
            }
          ?>
        </div>

        <label for="sorszam">Címke sorszáma</label>
        <input name="sorszam" type="text" value="" placeholder="Olvasd be a vonalkódot" required>

        <button name="save" value="uj" >Mentés</button>
        <a href="/" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
    </fieldset>
  </form>

<?php

endif;

?>