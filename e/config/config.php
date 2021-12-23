<?php

/** DEV
 * 
 * Fejlesztői hozzáférés
 */
$dev['ip']=false;
$dev['branch']=false;

/** Secure config
 * 
 * Nem nyilvános beállításokhoz.
 * 
 */
include('e/credentials/secureconfig.php');


/** PHP hibakijelzés
 * 
 * Bővebben: https://www.php.net/manual/en/errorfunc.configuration.php
 *
 */
#error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
error_reporting(E_ALL);
ini_set("display_errors", 1); 


/** ParseURI / URI_IGNORE
 * 
 * Az URI elejének figyelmenkívülhagyása, ha szükséges
 * Bővebben: /e/modules/parse_uri/README.md
 * 
 */
define("URI_IGNORE", 0);

/** IP allow list
 * 
 * Engedélyezett IP címek
 * 
 */
$ip_allow_list = array(
  '109.232.207.137'   => 'Központ',
  '81.182.248.25'     => 'Központ',
  '195.228.232.60'    => 'Centrum',
  '92.249.143.114'    => 'Budapest',
  $dev['ip']          => $dev['branch']
);


/** Termék típusok
 * 
 * 
 */
$termek = array(
  '8523 51 10'  => 'Pendrive',
  '8523 51 10'  => 'Memóriakártya',
  '8523 51 10'  => 'SSD vagy más félvezető alapú adattároló',
  '8471 70 50'  => 'Merevlemezes meghajtó (HDD)',
  '8471 49 00'  => 'Asztali számítógép',
  '8471 30 00'  => 'Hordozható számítógép',
  '8471 41 00'  => 'Táblagép',
  '8517 12 00'  => 'Mobiltelefon',

);



/** Title
 * 
 * Az oldal neve
 * 
 */
$title = "FOTOPLUS";


/** REDIRECT_URL
 * 
 * Elutasított hozzáférés esetén ide irányítja a látogatót.
 * 
 * Formátum: https://valami.hu
 * 
 */
define("REDIRECT_URL", "https://www.fotoplus.hu");


?>