<?php require_once ('e/modules/accesscontrol/ipcheck.php');

?>

<div id="main-center" class="rounded-main border-main">


  <?php
  $segments[1] = isset($segments[1]) ? $segments[1] : false;
  switch($segments[1]):
    default:
      ?>
        <a href="/feltoltes/jegyzek" style="">Új jegyzék</a>
        <a href="/feltoltes/cimke">Új cimke (intervallum)</a>
      <?php
    break;
    case "jegyzek":
        if( isset($_POST['save']) ):

          $iktatoszam   = isset($_POST['iktatoszam'])   ? $_POST['iktatoszam']    : false;
          $datum        = isset($_POST['datum'])        ? $_POST['datum']         : false;

          $stmt = $mysqli->prepare('INSERT INTO `atadas-atvetel` (`datum`, `iktatoszam`) VALUES (?, ?)');
          $stmt->bind_param('ss', $datum, $iktatoszam);

          if ( $stmt->execute() ) :
            $msg = '<p>A(z) <span class="bold">'.$iktatoszam.'>/span> iktatószámú átadás-átvételi jegyzéket <span class="bold">'.$datum.'</span> dátummal elmentettük.</p>';
          else:
            // Ez mondjuk hiba esetén nem jelenik meg, mert már feljebb megáll.
            $msg = '<p>Sajnálatos módon valami nem sikerült, az adatbázis válasza: '.$stmt->errorCode().'</p>';
          endif;

        endif;
  ?>
    <form method="post" action="/feltoltes/jegyzek">
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

  endswitch;

  ?>

</div>
