<?php

if(isset($_SERVER['REMOTE_ADDR']) and !empty($_SERVER['REMOTE_ADDR'])):

    $ip=$_SERVER['REMOTE_ADDR'];

    $query = sprintf('SELECT `telephelyek`.`id` AS `branch_id`, `telephelyek`.`name` AS `branch_name` FROM `ip_cimek` LEFT JOIN `telephelyek` ON `ip_cimek`.`tid` = `telephelyek`.`id` WHERE `ip_cimek`.`ipv4`="%s"', $mysqli->real_escape_string($ip));
    $result = $mysqli->query($query);
    $count = $result->num_rows;

    if($count == 1):
        
        $branch['name']=$result['branch_name'];
        $branch['id']=$result['branch_id'];

        $allow = true;
    else:
        $allow = false;
    endif;

else:
    $allow = false;
endif;

if(!$allow):
    header('Location: '. REDIRECT_URL);
    exit;
endif;



/*

if(!array_key_exists($_SERVER['REMOTE_ADDR'], $ip_allow_list)):
   header('Location: '. REDIRECT_URL);
   exit;
else:
    $branch = $ip_allow_list[$_SERVER['REMOTE_ADDR']];
    $allow = true;
endif;
*/

?>