<?php require_once ('e/modules/accesscontrol/ipcheck.php');

?>

<div id="main-center" class="rounded-main border-main">


  <?php
  $segments[1] = isset($segments[1]) ? $segments[1] : false;
  switch($segments[1]):
    default:
      ?>
        <nav>  
          <ul>    
            <li><a href="/feltoltes/jegyzek" style="">Új átadás-átvételi jegyzék</a></li>
            <li><a href="/feltoltes/cimke">Új címke intervallum</a></li>
          </ul>
        </nav>
      <?php
    break;
    case "jegyzek":
        if( isset($_POST['save']) ):

          $iktatoszam   = isset($_POST['iktatoszam'])   ? $_POST['iktatoszam']    : false;
          $datum        = isset($_POST['datum'])        ? $_POST['datum']         : false;

          $stmt = $mysqli->prepare('INSERT INTO `atadas-atvetel` (`datum`, `iktatoszam`) VALUES (?, ?)');
          $stmt->bind_param('ss', $datum, $iktatoszam);

          if ( $stmt->execute() ) :
            $msg = '<p>A(z) <span class="bold">'.$iktatoszam.'</span> iktatószámú átadás-átvételi jegyzéket <span class="bold">'.$datum.'</span> dátummal elmentettük.</p>';
            $msg .= '<p>Visszatrhetsz az <a href="/feltoltes" title="Vissza">előző menüpontba</a>, vagy itt új intervallumot is rögzíthetsz.</p>';
          else:
            // Ez mondjuk hiba esetén nem jelenik meg, mert már feljebb megáll.
            $msg = '<p>Sajnálatos módon valami nem sikerült, az adatbázis válasza: '.$stmt->errorCode().'</p>';
          endif;

        endif;
      ?>
        <form method="post" action="/feltoltes/jegyzek" autocomplete="off" >
          <fieldset>
              <legend>Új jegyzék rögzítése</legend>

              <?php
              if($msg) {
                print'<div class="msg rounded-main border-main">';
                print $msg;
                print '</div>';
              }
              ?>

              <label for="iktatoszam">Átadó jegyzék iktatószáma</label>
              <input name="iktatoszam" type="text" value="" required>

              <label for="datum">Átadás/átvétel ideje</label>
              <input name="datum" type="date" value="" required>

              <button name="save" value="uj" >Mentés</button>
              <a href="/feltoltes" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
          </fieldset>
        </from>
      <?php
    break;
    case "cimke":
      if( isset($_POST['save']) ):
        $iktatoszam   = isset($_POST['iktatoszam'])   ? $_POST['iktatoszam']        : false;
        $csomag       = isset($_POST['csomag'])       ? $_POST['csomag']            : false;
        $doboz        = isset($_POST['doboz'])        ? $_POST['doboz']             : false;
        $kezdet       = isset($_POST['kezdet'])       ? $_POST['kezdet']            : false;
        $veg          = isset($_POST['veg'])          ? $_POST['veg']               : false;

        if ($_POST['save'] == 'ellenorzes'):

        elseif($_POST['save'] == 'letrehozas'):

          /*
          $stmt = $mysqli->prepare('INSERT INTO `atadas-atvetel` (`datum`, `iktatoszam`) VALUES (?, ?)');
          $stmt->bind_param('ss', $datum, $iktatoszam);

          if ( $stmt->execute() ) :
            $msg = '<p></p>';
          else:
            // Ez mondjuk hiba esetén nem jelenik meg, mert már feljebb megáll.
            $msg = '<p>Sajnálatos módon valami nem sikerült, az adatbázis válasza: '.$stmt->errorCode().'</p>';
          endif;
          */
        else:
          $msg = '<p class="red">Váratlan hiba történt. Sor: '. __LINE__ .'</p>';
        endif;

      endif;
      ?>
        <form method="post" action="/feltoltes/cimke" autocomplete="off">
          <fieldset>
              <legend>Új címke intervallum rögzítése</legend>
              <?php
              if($msg) {
                print'<div class="msg rounded-main border-main">';
                print $msg;
                print '</div>';
              }
              ?>

              <label for="iktatoszam">Az átadó jegyzék iktatószáma</label>
              <select name="iktatoszam" required>
                <option <?php if($iktatoszam) { print('selected="selected"'); ?> disabled="disabled">Válassz a listából</option>
                <?php
                  $query_iktatoszamok = ('SELECT * FROM `atadas-atvetel` ORDER BY `datum` ASC');
                  $result_iktatoszamok = $mysqli->query($query_iktatoszamok);
                  while($iktatoszamok = $result_iktatoszamok->fetch_assoc()) {
                      print('<option value="' . $iktatoszamok['id'] . '"');
                      if($selected==$iktatoszamok['id']) { print('selected="selected"'); }
                      print('>' . $iktatoszamok['iktatoszam'] . '</option>');
                    }

                ?>
              </select>

              <label for="csomag">A csomag azonosítószáma</label>
              <input name="csomag" type="number" value="<?php print $csomag; ?>" required>

              <label for="doboz">A doboz azonosítószáma</label>
              <input name="doboz" type="number" value="<?php print $doboz; ?>" required>

              <label for="kezdet">Sorszámok kezdete</label>
              <input name="kezdet" type="number" value="<?php print $kezdet; ?>" required>

              <label for="veg">Sorszámok vége</label>
              <input name="veg" type="number" value="<?php print $veg; ?>" required>

              <button name="save" value="ellenorzes" >Tovább</button>
              <a href="/feltoltes" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
          </fieldset>
        </from>


      <?php
    break;
  endswitch;

  ?>

</div>
