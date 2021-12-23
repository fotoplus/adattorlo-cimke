<?php

if(!array_key_exists($_SERVER['REMOTE_ADDR'], $ip_allow_list)) {
   header('Location: /hiba/403');
   exit;
} else {
    $branch = $ip_allow_list[$_SERVER['REMOTE_ADDR']];
    $allow = true;
}

?>