<?php
while ($row = mysqli_fetch_assoc($query)) {
    $username = $row['username'];
    $sql2 = "SELECT * FROM messages
            WHERE (incoming_msg_id = '$username' OR outgoing_msg_id = '$username' )
            AND (outgoing_msg_id = '$outgoing_id' OR incoming_msg_id = '$outgoing_id' )
            -- AND user_role = 'parent'
            ORDER BY msg_id DESC LIMIT 2";
    $query2 = mysqli_query($db, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "Offline") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['username']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="chat.php?user_id=' . $row['username'] . '">
                    <div class="content">
                    <img src="../../../utils/chats/images/user2.jpg" alt="">
                    <div class="details">
                        <span>' . $row['name'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"> <i class="fas fa-circle"></i></div>
                </a>';
}
