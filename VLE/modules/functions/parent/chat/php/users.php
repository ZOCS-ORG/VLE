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
$sql = "SELECT u.id, u.status, u.name FROM users u 
        INNER JOIN parents p ON u.id = p.created_by
        WHERE p.user_id = '$outgoing_id'
        ";
$query = mysqli_query($db, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data.php";
}
echo $output;
?>