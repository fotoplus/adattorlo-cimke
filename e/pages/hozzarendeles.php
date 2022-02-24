
  <?php
  $segments[1] = isset($segments[1]) ? $segments[1] : false;
  switch($segments[1]):
    default:
      if( isset($_POST['save']) and $_POST['save'] == 'hozzarendeles' ):

        $telephely        = isset($_POST['telephely'])  ? $_POST['telephely']   : false;
        $cimke['kezdet']  = isset($_POST['kezdet'])     ? $_POST['kezdet']      : false;
        $cimke['veg']     = isset($_POST['veg'])        ? $_POST['veg']         : false;


        if($telephely and $cimke['kezdet'] and $cimke['veg']):
          // Címke sorszám
          $sorszam=$cimke['kezdet'];

          // Számláló
          $i=0;
          
          do {
            $query = sprintf('SELECT * FROM `` WHERE `sorszam`="%s"', $mysqli->real_escape_string($sorszam));
            $result = $mysqli->query($query);
            $count = $result->num_rows;
        
            if($count != 1):
              $err='<p>A(z) <span class="bold">'.$sorszam.'</span> sorszámú címke nem létezik.</p>';
            else:
              $stmt = $mysqli->prepare('INSERT INTO `cimke` (`tid`) VALUES (?)');
              $stmt->bind_param('s', $telephely);

              if ( $stmt->execute() ) :
                $log .= 'A <span class="green">' . $sorszam . '</span> sorszámú címke hozzáadva.'.chr(13);
              else:
                // Ez mondjuk hiba esetén nem jelenik meg, mert már feljebb megáll.
                $log .= '<span class="red">Hiba (' . $sorszam . '): '.$stmt->errorCode().'</span>'.chr(13);
              endif;
            endif;

            $sorszam++; 
            $i++; // Számláló

          } while($sorszam <= $cimke['veg']);

          $msg = '<p>' . $i . ' új címke került a rendszerbe.</p>';
          $msg = '<p>Ha hibát írt ki, vissza kell vonni a műveletet.<br>Szükség esetén készíts képernyőképet és kérj segítséget!</p>';
          $cimke = false;
        else:
          $msg='<p>Hiányzó adatok.</p>';
          die($msg);
        endif;

      endif;
      ?>
      <form method="post" action="/hozzarendeles/" autocomplete="off">
          <fieldset>
              <legend>Címke intervallum telephelyhez rendelése</legend>
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

              <label>Telephely</label>
              <div class="radio-group">
                <?php
                  $query = ('SELECT * FROM `telephelyek` ORDER BY `id` ASC');
                  $result = $mysqli->query($query);
                  while($telephely = $result->fetch_assoc()) {
                      echo('<input id="telephely' . $telephely['id'] . '" type="radio" name="telephely" value="' . $telephely['id'] .'" label="'.$telephely['name'].'" title="'.$telephely['name'].'" required>');
                  }
                ?>
              </div>

              <label for="kezdet">Sorszámok kezdete</label>
              <input name="kezdet" type="number" value="<?php print $cimke['kezdet']; ?>" required>

              <label for="veg">Sorszámok vége</label>
              <input name="veg" type="number" value="<?php print $cimke['veg']; ?>" required>

              <button name="save" value="hozzarendeles" >Hozzárendelés</button>
              
              <a href="/" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
          </fieldset>
        </form>
      </form>
      <?php
    break;
  endswitch;

  ?>


