<?php
print $_SERVER['REMOTE_ADDR'];
print_r($ip_allow_list);

if(!array_key_exists($ip_allow_list, $_SERVER['REMOTE_ADDR'])) {
    die('Hozzáférés megtagadva.');
}
?>