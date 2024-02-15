<?php
require_once('../../../config/admin_server.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');
include_once('../../../../PHPmailer/sendmail.php');
$emails = new email();

if (isset($_POST['add_user'])) {
    //

    $teaId = $_POST['id'];
    $teaName = $_POST['name'];
    $username = $_POST['username'];
    $teaPassword = md5($_POST['password']);
    $teaPhone = $_POST['phone'];
    $teaEmail = $_POST['email'];
    $teaGender = $_POST['gender'];
    $teaDOB = $_POST['dob'];
    $teaHireDate = $_POST['hiredate'];
    $teaAddress = $_POST['address'];
    $teaSalary = $_POST['salary'];
    $user_type = $role = "teacher";
    //$filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $img = $teaName . "_" . rand(100, 1000000) . ".jpg";
    move_uploaded_file($filetmp, "../../../utils/images/users/" . $img);
    

    $userid = 00; //$teaId;

    $sql_user = "INSERT INTO users (`userid`, `name`, `username`, `password`, `user_role`, `phone`, `email`, `sex`, `address`, `img`) 
                VALUES('$userid', '$teaName','$username', '$teaPassword','$user_type','$teaPhone', '$teaEmail', '$teaGender', '$teaAddress','$img' )";

    $message = "Dear " . $teaName . ", Welcome to the Virtual Learning Platform, your username is  " . $username . " and your password is " . $_POST['password'] . ""
        . "<br> Kind Regards <br>" . ' <img src="../../../assets/logo/vle.png" height="100px" width="200px">';

    $emails->send_mail($teaEmail, $message, "WELCOME TO THE VLE");

    $success = mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));

    $created_id = mysqli_insert_id($db);

    $school = $_POST['school'];

    $success = mysqli_query($db, "INSERT INTO school_teachers (`school_id`, `teacher_id`)
            VALUES ('$school', '$created_id') ") or die('Could not enter data: ' . mysqli_error($db));

    echo "<script>document.location='view_staff.php?id=" . $created_id . "&created=true'</script>";
    // header('Location: ../users/view.php?id=' . $teaId . "&created=true");
}
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
        width: 90%;
    }

    select {
        width: 90%;
    }

    [type=radio] {
        width: 30%;
    }
</style>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-lg-8" style="border: 2px solid #73AD21; ">
            <div>
                <div class="card-header">
                    <h5 class="text-center my-2">Add New User</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <table class="table" id="dataTable" width="100%" cellspacing="9">

                            <input id="id" type="hidden" name="id" placeholder="Enter Id">
                            <tr>

                                <td style=" color: black"><b>Name:</b></td>
                                <td class="text-right"><input id="name" type="text" name="name" placeholder="Name" required></td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Username:</b></td>
                                <td class="text-right"><input id="name" type="text" name="username" placeholder="Username" required></td>
                            </tr>
                            <tr hidden="">
                                <td>Password:</td>
                                <td style=" color: black"><b>Name:</b></td>
                                <td class="text-right"><input id="password" type="text" name="password" value="<?php echo date("His") . "@123"; ?>" placeholder="Enter Password"></td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Phone Number:</b></td>
                                <td class="text-right"><input type="number" name="phone" placeholder="Phone Number" required></td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Email:</b></td>
                                <td class="text-right"><input id="email" type="email" name="email" placeholder="Email" required></td>
                            </tr>
                            <tr hidden="">

                                <td style=" color: black"><b>Date of Birth:</b></td>
                                <td class="text-right">
                                    <input type="text" name="dob" id="date1" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td style=" color: black"><b>Gender:</b></td>
                                <td class="text-right"><input type="radio" name="gender" id="m" value="Male" onclick="teaGender = this.value;"> <label for="m">Male</label> <input type="radio" name="gender" id="f" value="Female" onclick="this.value"> <label for="f"> Female</label></td>
                            </tr>

                            <tr>

                                <td style=" color: black"><b>School:</b></td>
                                <td class="text-right">
                                    <div class="form-">
                                        <select name="school" class="form-" id="school" required>
                                            <option value="">-- SELECT --</option>
                                            <?php
                                            $sql = "SELECT * FROM schools;";
                                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                                            while ($row = mysqli_fetch_array($res)) {
                                            ?>
                                                <option value="<?php echo $row['school_id'] ?>"><?php echo $row['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr hidden="">
                                <td>Date Hired:</td>
                                <td style=" color: black"><b>Name:</b></td>
                                <td class="text-right">
                                    <input type="text" name="hiredate" id="date2" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                                </td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Physical Address:</b></td>
                                <td class="text-right"><input id="address" type="text" name="address" placeholder="Enter Address"></td>
                            </tr>
                            <tr hidden="">
                                <td>Salary:</td>
                                <td class="text-right"><input id="salary" type="text" name="salary" placeholder="eg. 21000"></td>
                            </tr>
                            <tr hidden="">
                                <td>Picture:</td>
                                <td class="text-right"><input id="file" type="file" name="file"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left"><input class="btn btn-sm btn-success " type="submit" name="add_user" value="Create User"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('../layouts/footer_to_end.php'); ?>