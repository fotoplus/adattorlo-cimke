<?php

if(!array_key_exists($_SERVER['REMOTE_ADDR'], $ip_allow_list)) {
    die('Hozzáférés megtagadva.');

} else {
    $branch = $ip_allow_list[$_SERVER['REMOTE_ADDR']];
}

?>