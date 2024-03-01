<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['id'];
    // $sql = "SELECT * FROM messages
    //             INNER JOIN users
    //             ON users.id = messages.outgoing_msg_id
    //             OR users.id = messages.incoming_msg_id
    //     WHERE users.id != '$outgoing_id'
    //     -- AND user_role = 'teacher'
    //     AND '$outgoing_id' IN (messages.outgoing_msg_id OR messages.incoming_msg_id)
    //     GROUP BY users.id
    //     -- ORDER BY messages.msg_id DESC
    //     ";
    // $sql = "SELECT * FROM parents
    //         INNER JOIN users ON users.id = parents.user_id
    //         WHERE parents.created_by = '$outgoing_id'
    //         ";
    ////? Afetr user change below
    // $sql = "SELECT u.id, u.status, u.name FROM parents p 
    //     INNER JOIN users u ON u.id = p.user_id
    //     WHERE p.created_by = '$outgoing_id'
    //     GROUP  BY u.id
    // ";
    $sql = "SELECT u.id, u.status, u.name FROM users u WHERE created_by = '$outgoing_id' AND user_role = 'parent' GROUP  BY u.id ";

    $query = mysqli_query($db, $sql);
    $output = "";
    if (mysqli_num_rows($query) == 0) {
        $output .= "No users are available to chat";
    } elseif (mysqli_num_rows($query) > 0) {
        include_once "data.php";
    }
    
    //  var_dump($query);
    echo $output;
