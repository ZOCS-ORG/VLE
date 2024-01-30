<?php
    
    require '../includes/connect.php';
    
    if(isset($_POST['submit'])){
      // validation for reg_no starts here
      if (empty($_POST['reg_no'])) {
        $error= 'Please enter your Registration Number';
      } else if (strlen($_POST['reg_no'])<255) {
        $reg_no=mysqli_reaL_escape_string($db ,$_POST['reg_no']);
      } else{
        $error= 'Enter a valid Registration Number';
      }
      // validation for reg_no ends here

      // validation for pass starts here
      if (empty($_POST['pass'])) {
        $error= 'Please enter your Registration Number';
      } else if (ctype_alpha('pass')) {
        $pass=mysqli_reaL_escape_string($db ,$_POST['pass']);
      } else{
        $error = 'Enter a valid Registration Number';
      }
      // validation for pass ends here

      if(empty($error)){
        $password = md5($pass);
        $result= $db->query("SELECT * FROM students WHERE username='$reg_no' AND password='$password'");
        if( $result->num_rows ==1 ){
          while($row= $result->fetch_assoc()){
            $_SESSION['id']=$row['id'];
            header('Location:../student/stud_profile.php');
          }

          // $_SESSION['reg_no']=$reg_no;
          // echo "<script>window.open('../student/stud_profile.php', '_self')</script>";
        } else {?>
          <div class="card-panel blue">
            <span class="white-text"><?php echo "The Reg Number or Password is incorrect, plese try again or signUp"; ?>
            </span>
          </div>
        <?php }
      }
      else{?>
        <div class="card-panel blue">
          <span class="white-text"><?php echo $error.", please try again"; ?>
          </span>
        </div>
      <?php }
    }
  ?>