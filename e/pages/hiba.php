<?php

switch($segments[1]):
  default:
    $head='Jajj';
    $text='Valami egészen váratlan dolog történt.';
  break;
  case '400':
    $head='Rossz kérés';
    $text='';
  break;
  case '401':
    $head='Ki?';
    $text='Az oldal megjelenítéséhez hitelesítésre lenne szükség.';
  break;
  case '403':
    $head='Nem!';
    $text='Hozzáférés megtagadva.';
  break;
  case '404':
    $head='Nincs.';
    $text='Ez eltűnt, vagy talán soha nem is volt ilyen.';
  break;
  case '500':
    $head='A csudába';
    $text='Hiba van a rendszerben.';
  break;
endswitch;

?>
<div class="main-center">

  <h1><?php print $head; ?></h1>

  <p><?php print $text; ?></p>

</div>