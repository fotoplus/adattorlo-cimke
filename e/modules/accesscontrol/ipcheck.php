<?php

if(isset($_SERVER['REMOTE_ADDR']) and !empty($_SERVER['REMOTE_ADDR'])):

    $ip=$_SERVER['REMOTE_ADDR'];

    $query = sprintf('SELECT `telephelyek`.`id` AS `branch_id`, `telephelyek`.`name` AS `branch_name` FROM `ip_cimek` LEFT JOIN `telephelyek` ON `ip_cimek`.`tid` = `telephelyek`.`id` WHERE `ip_cimek`.`ipv4`="%s"', $mysqli->real_escape_string($ip));
    $result = $mysqli->query($query);
    $count = $result->num_rows;
    $result = $result->fetch_assoc();


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




?>