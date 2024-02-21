<?php
// require_once('../../../config/teacher_server.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
require_once('../../../config/config.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

// $id = $_SESSION['id'];

?>

<hr />

<?php


//? upte data in users if post is set

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // get password if it's set or assign it empty
    if (isset($_POST['password'])) {
        $pass = ", password = '$password' ";
    } else {
        $password = "";
    }

    // update query
    $query = "UPDATE users SET name = '$name', username = '$username', phone = '$phone', email = '$email', dob = '$dob', sex = '$gender', address = '$address' $pass WHERE id = '$id' ";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    if ($result) {
        echo '   <h3 class="container" style=" background-color: green">Updated successfully</h3>';
    } else {
        // echo '<script>alert("User Update Failed");</script>';
    }
}


$query = "SELECT  * from users where id = '$id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>



        <style>
            .table-width {
                padding-right: 75px;
                padding-left: 75px;
                margin-right: auto;
                margin-left: auto;
            }

            @media (min-width: 768px) {
                .table-width {
                    width: 750px;
                }
            }

            @media (min-width: 992px) {
                .table-width {
                    width: 970px;
                }
            }

            @media (min-width: 1200px) {
                .table-width {
                    width: 1170px;
                }
            }

            input {
                width: 60%;
            }

            select {
                width: 60%;
            }

            textarea {
                width: 60%;
            }

            [type=radio] {
                width: 30%;
            }
        </style>
        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update My Profile</h3>
                    </div>
                    <div class="card-body">

                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">

                                <input id="id" type="hidden" name="id" placeholder="Enter Id">
                                <tr>

                                    <td style=" color: black"><b>Name:</b></td>
                                    <td class="text-right"><input class="form-control" id="name" type="text" name="name" value="<?php echo $row['name'] ?>" placeholder="Name" required></td>
                                </tr>
                                <tr>

                                    <td style=" color: black"><b>Username:</b></td>
                                    <td class="text-right"><input class="form-control" id="name" type="text" name="username" value="<?php echo $row['username'] ?>" placeholder="Username" required></td>
                                </tr>
                                <tr>
                                    <td style=" color: black"><b>Password:</b></td>
                                    <td class="text-right"><input class="form-control" id="password" type="text" name="password" value="<?php echo $row['password'] ?>" placeholder="New Password"></td>
                                </tr>
                                <tr>

                                    <td style=" color: black"><b>Phone Number:</b></td>
                                    <td class="text-right"><input class="form-control" type="number" name="phone" value="<?php echo $row['phone'] ?>" placeholder="Phone Number" required></td>
                                </tr>
                                <tr>

                                    <td style=" color: black"><b>Email:</b></td>
                                    <td class="text-right"><input class="form-control" id="email" type="email" name="email" value="<?php echo $row['email'] ?>" placeholder="Email" required></td>
                                </tr>
                                <tr>
                                    <td style=" color: black"><b>Date of Birth:</b></td>
                                    <td class="text-right">
                                        <input type="text" name="dob" value="<?php echo $row['dob'] ?>" id="date1" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                                    </td>
                                </tr>
                                <tr>

                                    <td style=" color: black"><b>Gender:</b></td>
                                    <td class="text-right"><input type="radio" name="gender" id="m" value="Male" onclick="teaGender = this.value;"> <label for="m">Male</label> <input type="radio" name="gender" id="f" value="Female" onclick="this.value"> <label for="f"> Female</label></td>
                                </tr>
                                <tr>

                                    <td style=" color: black"><b>Physical Address:</b></td>
                                    <td class="text-right">
                                        <textarea class="form-control" name="address" cols="20" rows="3"><?php echo $row['address'] ?></textarea>
                                    </td>
                                </tr>


                                <tr id="provinceRow" style="display: none;">
                                    <td style="color: black"><b>Province:</b></td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            <select id="provinceSelect" class="form-control select2" name="province" tabindex="1">
                                                <option value="none">-- Select Province --</option>
                                                <?php
                                                $query2 = mysqli_query($db, "SELECT * FROM provinces") or die(mysqli_error($db));
                                                while ($row = mysqli_fetch_array($query2)) {
                                                ?>
                                                    <option value="<?php echo $row['province_id']; ?>">
                                                        <?php echo $row['province_name']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="districtRow" style="display: none;">
                                    <td style="color: black"><b>District:</b></td>
                                    <td class="text-right">
                                        <div class="form-group">
                                            <select id="districtSelect" name="district" class="form-control">

                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-success " type="submit" name="update" value="Create User"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </main>
<?php
    }
} else {
    echo 'No Records Found!';
}









require_once('../layouts/footer_to_end.php');

?>