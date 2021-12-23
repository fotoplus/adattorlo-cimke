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
    $head='';
    $text='';
  break;
  case '403':
    $head='Ki?';
    $text='Az oldal megjelenítéséhez hitelesítésre lenne szükség.';
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
