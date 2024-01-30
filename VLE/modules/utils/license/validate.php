<?php
session_start();
    require_once('_auth.php');
    /** Main db */
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "zocs";
    $db = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    // return var_dump($_SESSION['id']);

/*
    $my_l_query = $db->query("SELECT * FROM _keys ORDER BY `_keys`.`id` DESC LIMIT 1");
    if (mysqli_num_rows($my_l_query) === 1) {
        while($row=$my_l_query->fetch_assoc()){
            $my_key = $row['_key'];
            $date_created = $row['date'];

            $duration = substr($my_key,10,4);
            $users = substr($my_key,15,4);



           
            if ($duration == 30 ) {
                $type = "One Month Trial";
            }elseif($duration == 60 ){
                $type = "Two Months Trial";
            }elseif($duration == 365 ){
                $type = "Pro";
            }else {
                $type = $fatal_error = "Invalid License Type. Contact upport for help.";
            }

            $current_date = date('Y-m-d');

            //get diff.
            $created = strtotime($date_created);
            $today = strtotime($current_date);
            $diff_in_secs = $today - $created;
            $diff_in_days = floor($diff_in_secs/86400);
            $exp = $duration - $diff_in_days;

            // echo "$duration dur.. $diff_in_days dif... exp = $exp";
            if($duration >= $exp) {
                $license_msg = "Your License expires in ".$exp." days.";
            }
            if($exp < 1 ){
                $fatal_error = "Your License has expired. Contact support for assistance";
                echo $duration;
            }

            //Check if corr num users
            $uz_query = $db->query("SELECT * FROM users ");
            if (mysqli_num_rows($uz_query) > 0) {
                $my_users = mysqli_num_rows($uz_query);
                $remaining_users = $users - $my_users;
                if ($my_users > $users ) {
                    $suplus_users = $my_users - $users;
                    $fatal_error = "You have too many users on this system. Please contact support for assistance. <br/>
                                           - Number of users allowed for your current plan is <b>".$users."<b> <br/>
                                           - Number of users registered is <b>".$my_users."<b> <br/>";
                }
            }

        }
    } else{ $fatal_error = "You do not have permission to use this software. Kindly contact Chesco-Tech to purchase
                    a license or try out a free trial"; }

    $admin_id = $_SESSION['id'];
    $query22 =  mysqli_query($db,"SELECT * FROM admin WHERE id='$admin_id' ")or die(mysqli_error($db));

    // return var_dump(mysqli_num_rows($query22));

    if (mysqli_num_rows($query22) > 0) {
        $add_license =  "<a href='../license/register_software.php' style='color:#5788dd;'>
            Or click to register new licence</a>";
        
    }
  
    if(isset($fatal_error)){
        include_once('../../base_user/license-error.php');
    }
*/