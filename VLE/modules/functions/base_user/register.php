<?php
session_start();
include('../../config/config.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php echo "Welcome!"; ?></title>
  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="wrapper fadeInDown">

    <h3>Add new user</h3>

    <div id="formContent">
      <hr>



      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

              <div class="card-header">
                <h5 class="text-center my-2">Add new staff</h5>
              </div>
              <div class="card-body">
                <form action="register.php" method="post" onsubmit="return staff_validation();" enctype="multipart/form-data">

                  <table class="table" id="dataTable" width="100%" cellspacing="9">

                    <input id="id" type="hidden" name="id" placeholder="Enter Id">
                    <tr>
                      <td>Name:</td>
                      <td class="text-right"><input id="name" type="text" name="name" placeholder="Name" required></td>
                    </tr>
                    <tr>
                      <td>User name:</td>
                      <td class="text-right"><input id="name" type="text" name="username" placeholder="Use name" required></td>
                    </tr>
                    <tr>
                      <td>Password:</td>
                      <td class="text-right"><input id="password" type="password" name="password" placeholder="Enter Password"></td>
                    </tr>
                    <tr>
                      <td>Phone Number:</td>
                      <td class="text-right"><input type="number" name="phone" placeholder="Phone Number" required></td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td class="text-right"><input id="email" type="email" name="email" placeholder="Email" required></td>
                    </tr>
                    <tr>
                      <td>Date of Birth:</td>
                      <td class="text-right">
                        <input type="text" name="dob" id="date1" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Gender:</td>
                      <td class="text-right"><input type="radio" name="gender" id="m" value="Male" onclick="teaGender = this.value;"> <label for="m">Male</label> <input type="radio" name="gender" id="f" value="Female" onclick="this.value"> <label for="f"> Female</label></td>
                    </tr>
                    <tr>
                      <td>Date Hired:</td>
                      <td class="text-right">
                        <input type="text" name="hiredate" id="date2" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                      </td>
                    </tr>
                    <tr>
                      <td>Address:</td>
                      <td class="text-right"><input id="address" type="text" name="address" placeholder="Enter Address" required></td>
                    </tr>
                    <tr>
                      <td>User type:</td>
                      <td class="text-right">
                        <div class="form-">
                          <select name="user_role" class="form-" id="user_role" required>
                            <option value="admin">Admin</option>
                          </select>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Salary:</td>
                      <td class="text-right"><input id="salary" type="text" name="salary" placeholder="eg. 21000" required></td>
                    </tr>
                    <tr>
                      <td>Picture:</td>
                      <td class="text-right"><input id="file" type="file" name="file"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="add_staff" value="Submit"></td>
                    </tr>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </div>

</body>

</html>







<?php

// Create Admin

// return var_dump($_POST['add_staff']);

if (!empty($_FILES))
  if (!empty($_POST['add_staff'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $hireDate = $_POST['hiredate'];
    $address = $_POST['address'];
    $filetmp = $_FILES['file']['tmp_name'];
    $img = $name . "_" . rand(100, 1000000) . ".jpg";
    move_uploaded_file($filetmp, "../../utils/images/admin/" . $img);
    $sql = "INSERT INTO `admin`(`name`, `username`, `password`, `phone`, `email`, `dob`, `hiredate`, `address`, `sex`, `img`)
        VALUES('$name','$username','$password','$phone','$email','$dob','$hireDate','$address','$gender', '$img')";

    $success = mysqli_query($db, $sql);
    $id = mysqli_insert_id($db);
    $userid = "ad_" . $id;
    $sql_user = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`)
            VALUES('$userid','$name','$username','$password','admin')";
    $success = mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));

    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;

    echo "<script>document.location='../../functions/admin/account/index.php?created=true'</script>";
    return;
  }
