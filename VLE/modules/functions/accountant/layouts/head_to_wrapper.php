<?php
  session_start();
  include('../../../utils/vars.php');
  require_once('../../../config/config.php');

  $id = $_SESSION['id'];
  $username = $_SESSION['username'];
 // Authenticate!!!
 $query =  "SELECT * FROM accountants WHERE username='$username' ";
 $results=mysqli_query($db,$query);
 $row=mysqli_fetch_array($results);
 $login_session = $row['name'];
 $_SESSION['img'] = $row['img'];
 $name = $_SESSION['name'] = $row['name'];
 $id = $_SESSION['id'] = $row['id'];
 $role = $_SESSION['role'] = "accountant";

 if(empty($login_session)){
   header("Location: ../../../../");
 }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Accountant - <?php echo "$app_name"; ?></title>

    <link href="../../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../../../assets/sb-admin-2.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

    <!-- Date picker -->
    <script type="text/javascript" src="http://services.iperfect.net/js/IP_generalLib.js"></script>
    <!-- Calendar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Attendancee  EDIT THIS...  -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <!-- ATTENTANCE ENDS HERE -->

<style>
    body {
        color: black !important;
        font-family: helvetica;
    }
</style>

</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar Check if page wants to dispaly side bar -->
    <?php
        if (isset($add_side_bar) && $add_side_bar == false) {
            # do nothing...
        }else {
            include('sidebar.php');
        }
    ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- 
        Main page - content starts from here...
        <div id="content">
    -->

    <?php
    /**
     * @TODO: 
     *  Make these alerts more dynamic.
     */
    ?>
    <center>
    <?php if(isset($_GET['created']) && isset($_GET['created']) == true){ ?>
        <div class="alert alert-success col-lg-6 col-md-6">
                <p><?php echo "Created Successfuly!" ?> </p> 
        </div>
        <script type="text/javascript">
            setTimeout(function() {
            $('.alert').alert('close');
            }, 4800);
        </script>
    <?php } ?>
    </center>
    <center>
    <?php if(isset($_GET['updated']) && isset($_GET['updated']) == true){ ?>
        <div class="alert alert-success col-lg-6 col-md-6">
                <p><?php echo "Updated Successfuly!" ?> </p> 
        </div>
        <script type="text/javascript">
            setTimeout(function() {
            $('.alert').alert('close');
            }, 4800);
        </script>
    <?php } ?>
    </center>
    <center>
    <?php if(isset($_GET['deleted']) && isset($_GET['deleted']) == true){ ?>
        <div class="alert alert-danger col-lg-6 col-md-6">
                <p><?php echo "Deleted Successfully!" ?> </p> 
        </div>
        <script type="text/javascript">
            setTimeout(function() {
            $('.alert').alert('close');
            }, 4800);
        </script>
    <?php } ?>
    </center>
