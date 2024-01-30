<?php
include('server.php');
include('../assets/vars.php');	
require('../assets/config.php');

$id= $_REQUEST['id'];

 ?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?php echo "$pageTitle"; ?></title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper fadeInDown">
  
  <h3>Update user info </h3>

  <div id="formContent">

    <!-- update form -->
    <form method="post" action="edit.php">
          <?php include('../assets/errors.php'); ?>
          
          <input type="text" id="login" class="fadeIn second" name="username" placeholder="New username">

          <input type="text" id="password" class="fadeIn third" name="email" placeholder="New email">

          <input type="password" id="password" class="fadeIn third" name="password_1" placeholder="New password">

          <input type="password" id="password" class="fadeIn third" name="password_2" placeholder="Confirm new password">

          <input type="hidden" name="id" value="<?php echo $id; ?>">

          <input type="submit" class="fadeIn fourth" name="update_user" value="Update">


    </form>
  </div>
</div>
<!-- partial -->
  
</body>
</html>
