<?php
// require_once('../scripts/parent_validation.php');
// require_once('../../../config/admin_server.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

require_once('../../../../PHPmailer/sendmail.php');
$emails = new email();


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

    textarea {
        width: 90%;
    }

    [type=radio] {
        width: 30%;
    }
</style>

<!-- MAPS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header">
                    <h5 class="text-center my-2">Add new Parent</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <table class="table" id="dataTable" width="100%" cellspacing="9">
                            <input id="id" type="hidden" name="id" placeholder="Enter Id">
                            <tr>
                                <td>Username:</td>
                                <td class="text-right"><input type="text" name="username" placeholder="Username.." required></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td class="text-right"><input type="email" name="email" placeholder="Email" required></td>
                            </tr>
                            <tr>
                                <td>Mother's Name:</td>
                                <td class="text-right"><input type="text" name="mothername" placeholder="Mother's Name"></td>
                            </tr>
                            <tr>
                                <td>Father's Name:</td>
                                <td class="text-right"><input type="text" name="fathername" placeholder="Father's Name"></td>
                            </tr>
                            <tr>
                                <td>Mother's Number:</td>
                                <td class="text-right"><input type="number" name="motherphone" placeholder="Mother's Phone Number"></td>
                            </tr>
                            <tr>
                                <td>Father's Number:</td>
                                <td class="text-right"><input type="number" name="fatherphone" placeholder="Father's Phone Number"></td>
                            </tr>
                            <tr>
                                <td>Address:</td>
                                <td class="text-right">
                                    <textarea name="address" id="" cols="30" rows="4"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="submit_parent" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require_once('../layouts/footer_to_end.php');


if (isset($_POST['submit_parent'])) {

    // return var_dump($_POST);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $fatherphone = $_POST['fatherphone'];
    $motherphone = $_POST['motherphone'];
    $address = $_POST['address'];

    $user_id = $_SESSION['id'];

    $password = $username . "@" . date('His');
    $encPass = md5($password);

    $sql_user = "INSERT INTO users (`name`, `username`, `password`, `user_role`, `phone`, `email`, `address`, `par_fathername`, `par_mothername`, `par_fatherphone`, `par_motherphone`, `created_by` ) 
                VALUES('$username','$username', '$encPass','parent','$motherphone', '$email', '$address', '$fathername','$mothername','$fatherphone','$motherphone', '$user_id')";

    mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));
    $id = mysqli_insert_id($db);

    //? SEND EMAIL
    $message = "Dear Mr " . $fathername . " And Mrs " . $mothername . ", Welcome to the Virtual Learning Platform, your username is  " . $username . " and your password is " . $password . ""
        . "<br> Kind Regards <br>" . ' <img src="../../../assets/logo/vle.png" height="100px" width="200px">';

    $emails->send_mail($email, $message, "WELCOME TO THE VLE");

    // return var_dump($email);
    echo "<script> window.location = 'all_parents.php?created=true' </script>";
    // echo "<script> history.back() </script>";

}
?>