<?php
if(!array_search($ip_allow_list, $_SERVER['REMOTE_ADDR'])) {
    die('Hozzáférés megtagadva.');
}
?>