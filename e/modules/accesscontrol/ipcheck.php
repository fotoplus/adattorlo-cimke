<?php
if(!array_search($_SERVER['REMOTE_ADDR'], $ip_allow_list)) {
    die('Hozzáférés megtagadva.');
}
?>