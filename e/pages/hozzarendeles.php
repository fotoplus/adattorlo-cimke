
  <?php
  $segments[1] = isset($segments[1]) ? $segments[1] : false;
  switch($segments[1]):
    default:
      ?>
      <nav>  
           <a href="/" class="space">Vissza</a>
      </nav>
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

              <a href="/" title="Mentés nélküli visszalépés" class="space" >Vissza</a>
          </fieldset>
        </form>
      </form>
      <?php
    break;
  endswitch;

  ?>


