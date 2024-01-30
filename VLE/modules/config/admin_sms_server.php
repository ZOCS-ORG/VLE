<?php
    // include_once('config.php');

/**
 * 
 * SMS MESSEGES SERVER!!
 */

// SEND MESSEGES...
if(isset($_POST['send_single_sms'])){
    function sendSMS() {
        $sender = $_POST['school_dn'];
        $phone = $_POST['phone'];
        $msg = $_POST['msg'];
        $username = "test";
        $pass = "user";

        $sender = preg_replace('/\s+/', '', $sender);
        $msg = urlencode($msg);

        $message_type = "1";
        //$etopupURL = "https://sms.chesco-tech.com/third-party-send-sms.php?sender_id=" . $sender_id . "&mobile_to=26" . $phoneNumber . "&message_type=" . $message_type . "&message=" . $reply_msg;

        $etopupURL = "https://sms.chesco-tech.com/third-party-send-sms-merchant.php?sender_id=".$sender."&mobile_to=26".$phone."&message_type=1&message=".$msg."&username=".$username."&password=".$pass;

        $ch = curl_init(); // initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $etopupURL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        $delivery = substr($result, 2,4);
        $to_number = substr($result, 9, 10);

        
        //return var_dump($delivery." to number ".$to_number);
        //return $result;

        if ($delivery == 1701 ) {
            $delivery_msg = "<span style='color:green'>Messenge to ".$to_number." successfully sent </span><br/> ";
        }elseif($delivery == 1707 ) {
            $delivery_msg = "<span style='color:red'>Messenge to ".$to_number." not sent </span> <br/>";
        }
        
        /** End php to accommodate js and html */ ?> 
        
        <center>
        <?php if(isset($delivery)){ ?>
            <div class="alert alert-success alert-dismissible col-lg-6 col-md-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p><?php echo $delivery_msg; ?> </p> 
            </div>
            <script type="text/javascript">
                setTimeout(function() {
                $('.alert').alert('close');
                }, 3800);
            </script>
        <?php } ?>
        </center>

        <?php /** Restart php */
                
    }
    sendSMS();
}

// SEND Multiple MESSEGES...
if(isset($_POST['send_multiple_sms'])){

    $sender = $_POST['school_dn'];
    $msg = $_POST['msg'];
    $username = "test";
    $pass = "user";

    $phones = $_POST['phones'];
    foreach ($phones as $key => $value) {
        $phone = $phones[$key];
        
        $sender = preg_replace('/\s+/', '', $sender);
        $msg = urlencode($msg);

        $message_type = "1";
        //$etopupURL = "https://sms.chesco-tech.com/third-party-send-sms.php?sender_id=" . $sender_id . "&mobile_to=26" . $phoneNumber . "&message_type=" . $message_type . "&message=" . $reply_msg;

        $etopupURL = "https://sms.chesco-tech.com/third-party-send-sms-merchant.php?sender_id=".$sender."&mobile_to=26".$phone."&message_type=1&message=".$msg."&username=".$username."&password=".$pass;

        $ch = curl_init(); // initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $etopupURL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        
        $delivery = substr($result, 2,4);
        $delivery = $delivery;
        $to_number = substr($result, 9, 10);
        $to_number = $to_number;

        // Handle the response
        if ($delivery == 1701 ) {
            $delivery_msg = "<span style='color:green'>Messenge to ".$to_number." successfully sent </span><br/> ";
        }elseif($delivery == 1707 ) {
            $delivery_msg = "<span style='color:red'>Messenge to ".$to_number." not sent </span> <br/>";
        }
        
        /** End php to accommodate js and html */ ?> 
        
        <center>
        <?php if(isset($delivery)){ ?>
            <div class="alert alert-success alert-dismissible col-lg-6 col-md-6">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p><?php echo $delivery_msg; ?> </p> 
            </div>
            <script type="text/javascript">
                setTimeout(function() {
                $('.alert').alert('close');
                }, 300);
            </script>
        <?php } ?>
        </center>
    
        <?php /** Restart php */
        
    }
    return $result;
        
}

?>

