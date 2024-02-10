<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - <?php echo "$app_name"; ?></title>

  <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../../../assets/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- DataTables -->
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">


  <!-- Date picker -->
  <script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
  <!-- J-Query -->
  <link href="jquery-ui.css" rel="stylesheet">


   
</head>

<body id="page-top">

  <div id="wrapper">

<?php
  require_once('../../../config/config.php');

  // include_once('../layouts/head_to_wrapper.php');

  $super_db_server = "localhost";
  $super_db_user = "root";
  $super_db_pass = "";
  $super_db_name = "srms_keys";
  $super_db = mysqli_connect($super_db_server, $super_db_user, $super_db_pass, $super_db_name);

?>

<?php 
  
  if(!empty($_POST['register_key'])){
      $new_key = $_POST['_key'];

      $fatal_error = "";

      /** check if key is valid */
      $l_query = $super_db->query("SELECT * FROM _keys WHERE _key='$new_key'");
      if (mysqli_num_rows($l_query) === 1) {
        while($row=$l_query->fetch_assoc()){
          $date_created = $row['date'];
          $duration = $row['duration'];
        }

        $my_l_query = $db->query("SELECT * FROM _keys WHERE _key='$new_key'");
        if (mysqli_num_rows($my_l_query) > 0 ) {
            $fatal_error = "License key is already in use by this software";
        }

        /** get tier/license type */
        if ($duration == 30 ) {
            $type = " One Month Trial ";
        }elseif($duration == 60 ){
            $type = " Two Months Trial ";
        }elseif($duration == 365 ){
            $type = " Pro ";
        }else {
            $type = $fatal_error = "Invalid License Type. Contact support for help.";
        }

        if (!$fatal_error) {
          $date = date('Y-m-d');
          $sql = "INSERT INTO _keys (`_key`) VALUES('$new_key')";
          $success = mysqli_query($db, $sql)or die('Could not enter data: '.mysqli_error($db));
          if($success){
            $licence_msg = "You successfully registered a new license key. <br/>
                            <hr/> License type: ".$type;
          }
        }

      }else{
        $fatal_error = "Invalid license key";
      }

  }

?>

<link rel="stylesheet" href="style.css">

<div class="wrapper fadeInDown">

  <hr style="padding-bottom: 10%"/>

  <?php 
    if(isset($fatal_error)){
      echo "<h5 style='color:#d85656;'>$fatal_error</h5>";
    }
  ?>
  <?php
  if(isset($success)){
      echo "<h3 style='color:green'>".$licence_msg."</h3>
      <a href='index.php'> Go to license page </a>";
  }else{
  ?>
    <h3>Register New License Key </h3>
    <div id="formContent">
        <br> 
        <form action="#" method="post">      
          <input type="text" id="key" class="fadeIn third" name="_key" placeholder="Paste License Key" required  />

          <input type="submit" class="fadeIn " name="register_key" value="Register">
        </form>

    </div>
    <br/>
    <hr>
    <h4><a href='index.php'> Go to license page </a> </h4>

<?php } ?>

</div>

  
</body>
</html>
