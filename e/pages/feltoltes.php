
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
        <a href="/" class="space">Vissza</a>
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
        </form>
      <?php
    break;
    case "cimke":
      $cimke['iktatoszam']   = ( isset($_POST['iktatoszam'])  and !empty($_POST['iktatoszam']) )  ? $_POST['iktatoszam']  : false;
      $cimke['tszam']        = ( isset($_POST['tszam'])       and !empty($_POST['tszam'])      )  ? $_POST['tszam']       : false;
      $cimke['csomag']       = ( isset($_POST['csomag'])      and !empty($_POST['csomag'])     )  ? $_POST['csomag']      : false;
      $cimke['doboz']        = ( isset($_POST['doboz'])       and !empty($_POST['doboz'])      )  ? $_POST['doboz']       : false;
      $cimke['kezdet']       = ( isset($_POST['kezdet'])      and !empty($_POST['kezdet'])     )  ? $_POST['kezdet']      : false;
      $cimke['veg']          = ( isset($_POST['veg'])         and !empty($_POST['veg'])        )  ? $_POST['veg']         : false;

      if( isset($_POST['save']) and !array_search(false, $cimke) ):

        if ($_POST['save'] == 'ellenorzes'):

          $szam = $cimke['veg']-$cimke['kezdet']+1;
          $msg = '<p>Ezzel a művelettel <span class="bold">'.$szam.'</span> db új címkét fogsz létrehozni a rendszerben.</p>';
          $msg .= '<p>Ha rendben vannak az adatok, nyomd meg a létrehozás gombot.</p>';

        elseif($_POST['save'] == 'letrehozas'):
          
          // Címke sorszám
          $sorszam=$cimke['kezdet'];

          // Számláló
          $i=0;
          
          do {
            $stmt = $mysqli->prepare('INSERT INTO `cimke` (`aid`, `tszam`, `csomag`, `doboz`, `sorszam`) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('sssss', $cimke['iktatoszam'], $cimke['tszam'], $cimke['csomag'], $cimke['doboz'], $sorszam);
            if ( $stmt->execute() ) :
              $log .= 'A <span class="green">' . $sorszam . '</span> sorszámú címke hozzáadva.'.chr(13);
              $i++; // Számláló léptetés (sikeres hozzáadás)
            else:
              // Ez mondjuk hiba esetén nem jelenik meg, mert már feljebb megáll.
              $log .= '<span class="red">Hiba (' . $sorszam . '): '.$stmt->errorCode().'</span>'.chr(13);
            endif;
            $sorszam++; // Címke sorszám léptetés
          } while($sorszam <= $cimke['veg']);

          $msg = '<p>' . $i . ' új címke került a rendszerbe.</p>';
          $msg = '<p>Ha hibát írt ki, vissza kell vonni a műveletet.<br>Szükség esetén készíts képernyőképet és kérj segítséget!</p>';
          $cimke = false;

        else:
          $msg = '<p class="red">Váratlan hiba történt. Sor: '. __LINE__ .'</p>';
        endif;

      endif;
      ?>
        <form method="post" action="/feltoltes/cimke" autocomplete="off">
          <fieldset>
              <legend>Új címke intervallum rögzítése</legend>
              <?php
              if($log):
                print '<pre id="log" class="rounded-main">' . $log . '</pre>';
              endif;

              if($msg):
                print'<div class="msg rounded-main border-main">';
                print $msg;
                print '</div>';
              endif;
              ?>

              <label for="iktatoszam">Az átadó jegyzék iktatószáma</label>
              <select name="iktatoszam" required>
                <option <?php if(!$cimke or !$cimke['iktatoszam']) { print('selected="selected"'); } ?> disabled="disabled">Válassz a listából</option>
                <?php
                  $query_iktatoszamok = ('SELECT * FROM `atadas-atvetel` ORDER BY `datum` ASC');
                  $result_iktatoszamok = $mysqli->query($query_iktatoszamok);
                  while($iktatoszamok = $result_iktatoszamok->fetch_assoc()) {
                    print('<option value="' . $iktatoszamok['id'] . '"');
                    if(isset($cimke['iktatoszam']) and $cimke['iktatoszam']==$iktatoszamok['id']) { print(' selected="selected" '); }
                    print('>' . $iktatoszamok['iktatoszam'] . '</option>');
                  }

                ?>
              </select>

              <label for="tszam">A "T" jelű első szám a CSV-ből"</label>
              <input name="tszam" type="number" value="<?php print $cimke['tszam']; ?>" required>

              <label for="csomag">A csomag azonosítószáma</label>
              <input name="csomag" type="number" value="<?php print $cimke['csomag']; ?>" required>

              <label for="doboz">A doboz azonosítószáma</label>
              <input name="doboz" type="number" value="<?php print $cimke['doboz']; ?>" required>

              <label for="kezdet">Sorszámok kezdete</label>
              <input name="kezdet" type="number" value="<?php print $cimke['kezdet']; ?>" required>

              <label for="veg">Sorszámok vége</label>
              <input name="veg" type="number" value="<?php print $cimke['veg']; ?>" required>

              <?php 
                if ( isset($_POST['save']) and $_POST['save'] == 'ellenorzes'):
                  print('<button name="save" value="letrehozas" >Létrehozás</button>');
                else:
                  print('<button name="save" value="ellenorzes" >Tovább</button>');
                endif;
              ?>
              <a href="/feltoltes" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
          </fieldset>
        </form>


      <?php
    break;
  endswitch;

  ?>


