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
include('./credentials/secure_config.php');

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

/** Title
 * 
 * Az oldal neve
 * 
 */
$title = "FOTOPLUS";


?>