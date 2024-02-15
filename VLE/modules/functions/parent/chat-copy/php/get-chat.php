<?php
session_start();
if (isset($_SESSION['id'])) {
    include_once "config.php";
    $outgoing_id = $_SESSION['id'];
    $incoming_id = mysqli_real_escape_string($db, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages INNER JOIN users ON users.username = messages.outgoing_msg_id
                                                    -- OR users.username = messages.incoming_msg_id
                WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id' )
                OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id')
                GROUP BY msg
                ORDER BY msg_id
                ";
    $query = mysqli_query($db, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            //** Check if file has attachment.
            $file_extention = pathinfo($row['attachment'], PATHINFO_EXTENSION);
            if ($row['outgoing_msg_id'] === $outgoing_id) {

                if ($row['attachment'] != "") {
                    $output .=
                        '<div class="chat outgoing">
                            <div class="details">
                                <a href="../../../utils/chats/attachment/' . $row['attachment'] . '" target="_blank">
                                    <div style="border-radius: 8px; height: 100px; width:200px; background-color: lightgrey; padding:10px; position: relative;text-align: center;">
                                        <img style="height:80px; border-radius:0px; padding-bottom:3px" src="../../../utils/chats/attachment/attachment.png" alt="attach">
                                        <strong style="position: absolute; bottom: 10px; left:5%; color:#111">' . strtoupper($file_extention) . ' file</strong>
                                    </div>
                                </a>
                                <p>' . $row['msg'] . '</p>
                                <small style="margin-top:-15px!important; right:35px; position:absolute">' . sentAt($row['timestamp']) . '</small>
                            </div>
                        </div>';
                } else {
                    $output .=
                        '<div class="chat outgoing">
                            <div class="details">
                                <p>' . $row['msg'] . '</p>
                                <small style="margin-top:-15px!important; right:35px; position:absolute">' . sentAt($row['timestamp']) . '</small>
                            </div>
                        </div>';
                }
            } else {
                //? Incoming chats
                if ($row['attachment'] != "") {
                    $output .=
                        '<div class="chat incoming">
                            <div class="details">
                                <a href="../../../utils/chats/attachment/' . $row['attachment'] . '" target="_blank">
                                    <div style="border-radius: 8px; height: 100px; width:200px; background-color: lightgrey; padding:10px; position: relative;text-align: center;">
                                        <img style="height:80px; border-radius:0px; padding-bottom:3px" src="../../../utils/chats/attachment/attachment.png" alt="attach">
                                        <strong style="position: absolute; bottom: 10px; left:5%; color:#111">' . strtoupper($file_extention) . ' file</strong>
                                    </div>
                                </a>
                                <p>' . $row['msg'] . '</p>
                                <small style="margin-top:-15px!important; position:absolute">' . sentAt($row['timestamp']) . '</small>
                            </div>
                        </div>';
                } else {
                    $output .=
                        '<div class="chat incoming">
                            <div class="details">
                                <p>' . $row['msg'] . '</p>
                                <small style="margin-top:-15px!important; position:absolute">' . sentAt($row['timestamp']) . '</small>
                            </div>
                        </div>';
                }
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;
} else {
    header("location: ../login.php");
}


// Get timestamp
function sentAt($timestamp)
{
    $seconds = time() - strtotime($timestamp);
    $minutes = round($seconds / 60);
    $hours = round($seconds / 3600);
    $days = round($seconds / 86400);
    $weeks = round($seconds / 604800);
    $months = round($seconds / 2629440);
    $years = round($seconds / 31553280);

    if ($seconds <= 60) {
        return "Just now";
    } elseif ($minutes <= 60) {
        if ($minutes == 1) {
            return "1 minute ago";
        } else {
            return "$minutes minutes ago";
        }
    } elseif ($hours <= 24) {
        if ($hours == 1) {
            return "1 hour ago";
        } else {
            return "$hours hours ago";
        }
    } elseif ($days <= 7) {
        if ($days == 1) {
            return "1 day ago";
        } else {
            return "$days days ago";
        }
    } elseif ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "1 week ago";
        } else {
            return "$weeks weeks ago";
        }
    } elseif ($months <= 12) {
        if ($months == 1) {
            return "1 month ago";
        } else {
            return "$months months ago";
        }
    } else {
        if ($years == 1) {
            return "1 year ago";
        } else {
            return "$years years ago";
        }
    }
}
