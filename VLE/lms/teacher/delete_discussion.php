<?php

require ('../includes/connect.php');

if (isset($_GET['forum_id']) && !empty($_GET['forum_id'])) {

    $forum_id = mysqli_real_escape_string($db, $_GET['forum_id']);


    $delete_query = "DELETE FROM zone_discussions WHERE id = '$forum_id'";

    if (mysqli_query($db, $delete_query)) {

        header("Location: zone.php");
        exit();
    } else {

        echo "Error deleting discussion: " . mysqli_error($db);
    }
} else {

    header("Location: zone.php");
    exit();
}
?>
