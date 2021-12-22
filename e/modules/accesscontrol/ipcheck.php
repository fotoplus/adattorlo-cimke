<?php
print $_SERVER['REMOTE_ADDR'];
print_r($ip_allow_list);

if(!array_key_exists($_SERVER['REMOTE_ADDR'], $ip_allow_list)) {
    die('Hozzáférés megtagadva.');
}
?>