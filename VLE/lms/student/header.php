<?php
<<<<<<< Updated upstream
error_reporting(0);
=======
  error_reporting(0);
>>>>>>> Stashed changes
  session_start();

  if(!isset($_SESSION['id'])){
    header("location: ../../../../vle/modules/functions/student");
  }else{
    require '../includes/connect.php';
    if (isset($_REQUEST['student_id'])) {
      // return var_dump($_REQUEST['student_id']);
        $id = $_REQUEST['student_id'];
        // $_SESSION['id'] = $id;
    }else {
      $id=$_SESSION['id'];
    }
    
    $select_query= $db->query("SELECT * FROM users WHERE id='$id'");
    if($select_query->num_rows ==0){ header("location: ../../modules/functions/". $_SESSION['role'] ."/"); }
    while($row = $select_query->fetch_assoc()){
      $s_username = $row['username'];
      $class = $row['class_id'];
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Learner - <?php echo $s_username ?></title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
  
  <style>
    .txt_limit{
      width: 240px;
      white-space: wrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  </style>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.24/datatables.min.js"></script>
</head>