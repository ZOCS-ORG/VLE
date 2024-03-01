<?php
    session_start();
    include_once "config.php";

    $outgoing_id = $_SESSION['id'];
    $searchTerm = mysqli_real_escape_string($db, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE id != '$outgoing_id' AND (name LIKE '%$searchTerm%' OR username LIKE '%$searchTerm%')  ";
    $output = "";
    $query = mysqli_query($db, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>