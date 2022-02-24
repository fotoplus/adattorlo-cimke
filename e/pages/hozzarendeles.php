
  <?php
  /**
   * Hozzárendelés
   * 
   * Címkét (címke-sorszámot) rendel hozzá telephelyhez.
   * Ez az értékesítést nem befolyásolja, ezért nem is kötelező,
   * viszont követhetőbb vele, hol hány (szabad) címke van.
   * 
   */

  $err=false;
  $log=false;
  $msg=false;

  $segments[1] = isset($segments[1]) ? $segments[1] : false;
  switch($segments[1]):
    default:
      if( isset($_POST['save']) and $_POST['save'] == 'hozzarendeles' ):

        $telephely   = isset($_POST['telephely'])  ? $_POST['telephely']   : false;
        $kezdet      = isset($_POST['kezdet'])     ? $_POST['kezdet']      : false;
        $veg         = isset($_POST['veg'])        ? $_POST['veg']         : false;


        if($telephely and $kezdet and $veg):
          // Címke sorszám
          $sorszam=$kezdet;

          // Számláló
          $i=0;
          
          do {
            /**
             * Megnézzük, hogy az adott sorszámmal létezik-e címke a rendszerben.
             * Csak hozzáadott címke rendelhetőtelephelykhez.
             * 
            */
            $query_cimke = sprintf('SELECT `id` FROM `cimke` WHERE `sorszam`="%s"', $mysqli->real_escape_string($sorszam));
            $result_cimke = $mysqli->query($query_cimke);
            $count_cimke = $result_cimke->num_rows;
            if($count_cimke != 1):
              $err .='<p>A(z) <span class="bold">'.$sorszam.'</span> sorszámú címke nem létezik.</p>';
            else:
              
              $query_telephely_cimkek = sprintf('SELECT `id` FROM `cimke` WHERE `sorszam`="%s" AND `tid` IS NOT NULL', $mysqli->real_escape_string($sorszam));
              $result_telephely_cimkek = $mysqli->query($query_telephely_cimkek);
              $count_telephely_cimkek = $result_telephely_cimkek->num_rows;
              if($count_telephely_cimkek != 0):
                $err .='<p>A(z) <span class="red">'.$sorszam.'</span> sorszámú címke már hozzá lett rendelve egy telephelyhez.</p>';
              endif;
               
              $stmt = $mysqli->prepare('UPDATE `cimke` SET `tid` = ? WHERE `cimke`.`sorszam` = "'.$sorszam.'"');
              $stmt->bind_param('s', $telephely);

              if ( $stmt->execute() ) :
                $log .= 'A <span class="green">' . $sorszam . '</span> sorszámú címke hozzárendelve a telephelyhez.'.chr(13);
              else:
                // Ez mondjuk hiba esetén nem jelenik meg, mert már feljebb megáll.
                $log .= '<span class="red">Hiba (' . $sorszam . '): '.$stmt->errorCode().'</span>'.chr(13);
              endif;
            endif;

            $sorszam++; 
            $i++; // Számláló

          } while($sorszam <= $veg);

          $msg .= '<p>' . $i . ' címke hozzá lett rendelve a telephelyhez.</p>';
          $msg .= '<p>Ha hibát írt ki, vissza kell vonni a műveletet.<br>Szükség esetén készíts képernyőképet és kérj segítséget!</p>';
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

              if($err):
                print '<pre id="log" class="rounded-main">' . $err . '</pre>';
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
                  echo('<!--input class="torles" type="radio" name="telephely" value="NULL" label="Elvétel / Törlés" title="Korábbi kapcsolat törlése" required-->');
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


