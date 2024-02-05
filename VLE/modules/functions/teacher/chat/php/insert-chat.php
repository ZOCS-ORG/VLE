<?php
session_start();
if (isset($_SESSION['username'])) {
    include_once "config.php";

    // Upload file attachment
    //@TODO Validate file size
    if (!empty($_FILES['attachment'])) {
        $attachment = basename($_FILES['attachment']['name']);
        $path = "../../../../utils/chats/attachment/". $attachment;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $path)) {
            echo "File uploaded successfully";;
        } else {
            echo "There was an error uploading the file, please try again!";
        }
    }


    $outgoing_id = $_SESSION['username'];
    $incoming_id = mysqli_real_escape_string($db, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($db, $_POST['message']);



    echo $outgoing_id;
    echo $incoming_id;
    echo $message;
    if (!empty($message)) {
        $sql = mysqli_query($db, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, attachment)
                                        VALUES ('$incoming_id', '$outgoing_id', '$message', '$attachment')") or die();
    }
} else {
    header("location: ../login.php");
}
 