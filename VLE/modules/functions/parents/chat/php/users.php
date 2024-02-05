<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['username'];
    $sql = "SELECT * FROM messages
        INNER JOIN users ON users.username = messages.outgoing_msg_id
                OR users.username = messages.incoming_msg_id
        WHERE users.username != '$outgoing_id'
        AND '$outgoing_id' IN (messages.outgoing_msg_id OR messages.incoming_msg_id)
        GROUP BY users.username ORDER BY messages.msg_id DESC";
    $query = mysqli_query($db, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>