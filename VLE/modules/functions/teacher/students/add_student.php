<?php
// require_once('../scripts/student_validation.php');
// require_once('../../../config/admin_server.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$user_id = $_SESSION['id'];

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
        padding: 5px;
    }

    [type=radio] {
        width: 30%;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header">
                    <h5 class="text-center my-2">Add new student</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" onsubmit="return student_validation();" enctype="multipart/form-data">

                        <table class="table" id="" width="100%" cellspacing="9">
                            <!-- <tr> -->
                            <!-- <td class="text-left">Student Id:</td> Hide ID input since it's now autogenerated-->
                            <input id="stuId" type="hidden" name="studentId" required placeholde="Enter Id">
                            <!-- </tr> -->
                            <tr>
                                <td>Student Name:</td>
                                <td class="text-right"><input id="stuName" type="text" name="studentName" required placeholde="Enter Name"></td>
                            </tr>
                            <tr>
                                <td>Student Username:</td>
                                <td class="text-right"><input type="text" name="username" required placeholde="Enter Username"></td>
                            </tr>
                            <tr>
                                <td>Student Phone:</td>
                                <td class="text-right"><input id="stuPhone" type="text" name="studentPhone" required placeholde="Enter Phone Number"></td>
                            </tr>
                            <tr>
                                <td>Student Email:</td>
                                <td class="text-right"><input id="stuEmail" type="text" name="studentEmail" required placeholde="Enter Email"></td>
                            </tr>
                            <tr>
                                <td>Gender:</td>
                                <td class="text-right">
                                    <input id="m" type="radio" name="gender" required value="Male" onclick="stuGender = this.value;"> <label for="m"> Male </label>
                                    <input id="f" type="radio" name="gender" required value="Female" onclick="this.value"> <label for="f">Female</label>
                                </td>
                            </tr>
                            <tr>
                                <td>Student DOB:</td>
                                <td class="text-right">
                                    <input type="text" name="stuDOB" required id="date1" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>Admission Date:</td>
                                <td class="text-right">
                                    <input type="text" name="studentAddmissionDate" required id="date1" alt="date" class="IP_calendar" title="Y-m-d" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>Student Physical Address:</td>
                                <td class="text-right"><input id="stuAddress" type="text" name="studentAddress" required placeholde="Enter Address"></td>
                            </tr>
                            <tr>
                                <td>Class:</td>
                                <td class="text-right">
                                    <select name="class_id" required id="class_id" >
                                        <option value="">Select</option>
                                        <?php
                                        $res = mysqli_query($db, "SELECT * FROM classes WHERE teacher_id = '$user_id' ");
                                        while ($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
                                        <?php }     ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>Parents:</td>
                                <td class="text-right">
                                    <select name="parentid" required id="parentid">
                                        <?php
                                        $res = mysqli_query($db, "SELECT * FROM users WHERE user_role = 'parent' AND created_by = '$user_id' ");
                                        while ($row = mysqli_fetch_array($res)) { ?>
                                            <option value="<?php echo $row['id']; ?>"> <?php echo $row['par_mothername'] . " and " . $row['par_fathername'] . " of ID " . $row['id']; ?> </option>
                                        <?php   }     ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                    <center>Next of Kin</center>
                                </td>
                            </tr>
                            <tr>
                                <td>Next of Kin:</td>
                                <td class="text-right"><input type="text" name="nok" required placeholde="Next of Kin Names"></td>
                            </tr>
                            <tr>
                                <td>Next of Kin Relationshipr:</td>
                                <td class="text-right">
                                    <select name="nok_relationship" required id="">
                                        <option value="" readonly>Select</option>
                                        <option value="spouse">Spouse</option>
                                        <option value="parent">Parent</option>
                                        <option value="child">Child</option>
                                        <option value="sibling">Sibling</option>
                                        <option value="grandparent">Grandparent</option>
                                        <option value="grandchild">Grandchild</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Next of Kin Phone:</td>
                                <td class="text-right"><input type="text" name="nok_phone" required placeholde="Next of Kin Phone"></td>
                            </tr>
                            <tr>
                                <td>Next of Kin Email:</td>
                                <td class="text-right"><input type="text" name="nok_email" required placeholde="Next of Kin Phone"></td>
                            </tr>
                            <tr>
                                <td>Next of Kin Physical Address:</td>
                                <td class="text-right"><input type="text" name="nok_address" required placeholde="Next of Kin Phone"></td>
                            </tr>
                            <tr>
                                <td>Next of Kin Occupation:</td>
                                <td class="text-right"><input type="text" name="nok_address" required></td>
                            </tr>


                            <tr>
                                <td>Student Picture:</td>
                                <td class="text-right"><input id="file" type="file" name="file" required></td>
                            </tr>
                            <td></td>
                            <td class="text-right"><input class="btn btn-sm btn-primary " type="submit" name="create_student" required value="Submit"></td>

                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Multi-Select suport -->
<link rel="stylesheet" href="../../../assets/select_box/vanillaSelectBox.css">
<script src="../../../assets/select_box/vanillaSelectBox.js"></script>
<script>
    let mySelect = new vanillaSelectBox("#subj", {
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,
        disableSelectAll: true,
        placeholde: "Assign subjects",
    });
</script>
<!-- End multi-select support  -->


<?php
require_once('../layouts/footer_to_end.php');

require_once('../../../../PHPmailer/sendmail.php');
$emails = new email();


if (isset($_POST['create_student'])) {

    $studentName = $_POST['studentName'];
    $username = $_POST['username'];
    $studentPhone = $_POST['studentPhone'];
    $studentEmail = $_POST['studentEmail'];
    $gender = $_POST['gender'];
    $stuDOB = $_POST['stuDOB'];
    $studentAddmissionDate = $_POST['studentAddmissionDate'];
    $studentAddress = $_POST['studentAddress'];
    $class_id = $_POST['class_id'];
    $parentid = $_POST['parentid'];
    $nok = $_POST['nok'];
    $nok_relationship = $_POST['nok_relationship'];
    $nok_phone = $_POST['nok_phone'];
    $nok_email = $_POST['nok_email'];
    $nok_address = $_POST['nok_address'];
    $nok_occupation = $_POST['nok_occupation'];
    $filetmp = $_FILES['file']['tmp_name'];
    if (isset($filetmp) && !empty($filetmp)) {
        $dir = "../../../utils/images/users/";
        $file = $studentName . "_" . rand(1000, 9999) . ".jpg";
        move_uploaded_file($filetmp, $dir . $file);
    } else {
        $file = "";
    }
    $subjects = $_POST['subjects'];

    $password = $username . "@" . date('His');
    $encPass = md5($password);
    $role = "student";
    //** 1 create user
    mysqli_query($db, "INSERT INTO users (`name`, `username`, `phone`, `email`, `sex`, `dob`, `stu_addmissiondate`,
                        `address`, `stu_class`, `stu_parent`, `nok_name`, `nok_relationship`, `nok_phone`, `nok_email`, `nok_address`, `nok_occupation`,
                        `img`, `password`, `user_role`, `created_by` ) 

                VALUES( '$studentName', '$username', '$studentPhone', '$studentEmail', '$gender', '$stuDOB', '$studentAddmissionDate',
                        '$studentAddress', '$class_id', '$parentid', '$nok', '$nok_relationship', '$nok_phone', '$nok_email', '$nok_address', '$nok_occupation',
                        '$file', '$encPass', '$role', '$user_id'

             )") or die('Could not enter data 1: ' . mysqli_error($db));

    $id = mysqli_insert_id($db); // user ID




    /** Assign subjects👇🏽...👇🏽 */
    // foreach ($subjects as $key => $value) {
        // $subject = $subjects[$key];
        // $query = "INSERT INTO student_subjects VALUES(' ', '$id', '$subject' )";
        // $result = mysqli_query($db, $query) or die('Error saving to mapping table: ' . mysqli_error($db));
    // }
    //? SEND EMAIL
    $message = "Dear " . $studentName . ", Welcome to the Virtual Learning Platform, your username is  " . $username . " and your password is " . $password . ""
        . "<br> Kind Regards <br>" . ' <img src="../../../assets/logo/vle.png" height="100px" width="200px">';

    $emails->send_mail($email, $message, "WELCOME TO THE VLE");

    echo "<script> window.location = 'all_students.php?id=" . $id . "&created=true' </script>";
}

?>