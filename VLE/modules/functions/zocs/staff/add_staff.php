<?php
require_once('../scripts/staff_validation.php');
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
    // $teaPassword = md5($_POST['password']);
    $teaPhone = $_POST['phone'];
    $raw_province = $_POST['province'];
    $raw_district = $_POST['district'];
    $province = intval($raw_province);
    $district = intval($raw_district);
    $teaEmail = $_POST['email'];
    $teaGender = $_POST['gender'];
    $teaDOB = $_POST['dob'];
    $teaHireDate = $_POST['hiredate'];
    $teaAddress = $_POST['address'];
    $teaSalary = $_POST['salary'];
    $user_type = $role = $_POST['user_role'];
    //$filename = $_FILES['file']['name'];
    $filetmp = $_FILES['file']['tmp_name'];
    $img = $teaName . "_" . rand(100, 1000000) . ".jpg";
    move_uploaded_file($filetmp, "../../../utils/images/users/" . $img);

    // $sql = "INSERT INTO teachers (`id`, `name`, `username`, `password`, `phone`, `email`, `address`, `sex`, `dob`, `hiredate`, `salary`, `img`,`user_type`)
    //     VALUES('$teaId','$teaName','$username','$teaPassword','$teaPhone','$teaEmail','$teaAddress','$teaGender','$teaDOB','$teaHireDate','$teaSalary', '$img','$user_type' )";

    // $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    // $teaId = mysqli_insert_id($db);

    $userid = 00; //$teaId;

    $teaPassword = $username . "@" . date('His');
    $encPass = md5($teaPassword);

    $sql_user = "INSERT INTO users (`name`, `username`, `password`, `user_role`, `phone`, `email`, `sex`, `address`,`province_id`,`district_id`) 
                VALUES('$teaName','$username', '$encPass','$user_type','$teaPhone', '$teaEmail', '$teaGender', '$teaAddress', '$province', '$district' )";

    $success = mysqli_query($db, $sql_user) or die('Could not enter data: ' . mysqli_error($db));


    $message = "Dear " . $teaName . ", Welcome to the Virtual Learning Platform, your username is  " . $username . " and your password is " . $teaPassword . ""
        . "<br> Kind Regards <br>" . ' <img src="../../../assets/logo/vle.png" height="100px" width="200px">';

    $emails->send_mail($teaEmail, $message, "WELCOME TO THE VLE");


    $created_id = mysqli_insert_id($db);

    echo "<script>document.location='../users/view.php?id=" . $created_id . "&created=true'</script>";
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

    textarea {
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
                                <td class="text-right"><input class="form-control" id="name" type="text" name="name" placeholder="Name" required></td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Username:</b></td>
                                <td class="text-right"><input class="form-control" id="name" type="text" name="username" placeholder="Username" required></td>
                            </tr>
                            <tr hidden="">
                                <td>Password:</td>
                                <td style=" color: black"><b>Name:</b></td>
                                <td class="text-right"><input class="form-control" id="password" type="text" name="password" value="<?php echo date("His") . "@123"; ?>" placeholder="Enter Password"></td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Phone Number:</b></td>
                                <td class="text-right"><input class="form-control" type="number" name="phone" placeholder="Phone Number" required></td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Email:</b></td>
                                <td class="text-right"><input class="form-control" id="email" type="email" name="email" placeholder="Email" required></td>
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
                            <tr hidden="">
                                <td>Date Hired:</td>
                                <td style=" color: black"><b>Name:</b></td>
                                <td class="text-right">
                                    <input type="text" name="hiredate" id="date2" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                                </td>
                            </tr>
                            <tr>

                                <td style=" color: black"><b>Physical Address:</b></td>
                                <td class="text-right">
                                    <textarea class="form-control" name="address" id="" cols="30" rows="4"></textarea>
                                </td>
                            </tr>

                            <tr>
                                <td style="color: black"><b>User type:</b></td>
                                <td class="text-right">
                                    <div class="form-group">
                                        <select name="user_role" class="form-control" id="user_role" required onchange="showFields()">
                                            <option value="">-- SELECT --</option>
                                            <option value="admin">SUPER ADMIN</option>
                                            <option value="zocs">ZOCS USER</option>
                                            <option value="moe">MOE</option>
                                            <option value="drc">DEBS</option>
                                            <option value="university">UNIVERSITY</option>
                                            <!-- <option value="teacher">TEACHER</option> -->
                                        </select>
                                    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    $(document).ready(function() {
        $('#provinceSelect').change(function() {
            var provinceId = $(this).val();
            // console.log(provinceId);
            if (provinceId !== 'none') {
                $.ajax({
                    url: 'get_district.php',
                    type: 'POST',
                    data: {
                        province_id: provinceId
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#districtSelect').empty();
                        $('#districtRow').show();
                        $('#districtSelect').append($('<option>', {
                            value: 'none',
                            text: '-- Select District --'
                        }));
                        $.each(response, function(key, value) {
                            $('#districtSelect').append($('<option>', {
                                value: value.district_id,
                                text: value.district_name
                            }));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#districtRow').hide();
                $('#districtSelect').empty();
            }
        });
    });
</script>

<script>
    function showFields() {
        var userType = document.getElementById("user_role").value;
        var provinceRow = document.getElementById("provinceRow");
        var districtRow = document.getElementById("districtRow");

        provinceRow.style.display = "none";
        districtRow.style.display = "none";

        if (userType === "drc") {
            provinceRow.style.display = "table-row";
            districtRow.style.display = "table-row";
        }
    }
</script>

<?php require_once('../layouts/footer_to_end.php'); ?>