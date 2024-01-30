<?php
include('../../config/config.php');

    $id=$_REQUEST['id'];
    $query = "DELETE FROM users WHERE id=$id"; 
    $result = mysqli_query($db,$query) or die ( mysqli_error($db));
    header("Location: index.php"); 
?>