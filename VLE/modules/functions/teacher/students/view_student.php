<?php
// require_once('../scripts/student_validation.php');
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$student_id = $_GET['id'];

?>
<hr />
<?php
$query = "SELECT * FROM users where id = '$student_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    $images_dir = "../../../utils/images/users/";

    while ($row = mysqli_fetch_assoc($result)) {
        $picname = $row['img'];

        // return print_r($row ?? !null );
?>

        <main>
            <div class="container-fluid col-md-9 ">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Learners Info</h3>
                        <?php echo "<img src='" . $images_dir . $picname . "' alt='" . $picname . "' width='140' height='140'> " ?>
                    </div>







                    <form>
                        <div class="container text- center" style="padding:40px">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="name" value="<?= htmlspecialchars($row['name']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="username" value="<?= htmlspecialchars($row['username']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label">Phone:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="phone" value="<?= htmlspecialchars($row['phone']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" readonly class="form-control-plaintext" id="email" value="<?= htmlspecialchars($row['email']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sex" class="col-sm-2 col-form-label">Sex:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="sex" value="<?= htmlspecialchars($row['sex']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-sm-2 col-form-label">Date of Birth:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="dob" value="<?= htmlspecialchars($row['dob']); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stu_addmissiondate" class="col-sm-2 col-form-label">Admission Date:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="stu_addmissiondate" value="<?= htmlspecialchars($row['stu_addmissiondate']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="address" value="<?= htmlspecialchars($row['address']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stu_class" class="col-sm-2 col-form-label">Class:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="stu_class" value="<?= htmlspecialchars($row['stu_class']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stu_parent" class="col-sm-2 col-form-label">Parent:</label>
                                <div class="col-sm-10">
                                    <!-- <input type="text" readonly class="form-control-plaintext" id="address" value="<?= htmlspecialchars($row['address']); ?>"> -->
                                    <?php
                                    $parent_id = $row['stu_parent'];
                                    $q = "SELECT id, par_fathername, par_mothername 
                                                FROM users  WHERE users.id = '$parent_id' ";

                                    $res = mysqli_query($db, $q) or die(mysqli_error($db));

                                    if (mysqli_num_rows($res) > 0) {
                                        while ($r = mysqli_fetch_assoc($res)) {
                                            echo " " . $r['par_fathername'] . " & ";
                                            echo " " . $r['par_mothername'] . " ";
                                            echo "<a class='btn btn-info btn-sm' href='../parent/view_parent.php?id=" . $row['stu_parent'] . "'>View.</a>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="Results" class="col-sm-2 col-form-label">Results:</label>
                                <div class="col-sm-10">
                                    <!-- <input type="text" readonly class="form-control-plaintext" id="Results" value="<?= htmlspecialchars($row['nok_class']); ?>"> -->
                                    <?php
                                    $q_results = "SELECT  name, id,date FROM results WHERE student_id = '$student_id' GROUP BY name ";

                                    $res_results = mysqli_query($db, $q_results) or die(mysqli_error($db));
                                    $count = 1;
                                    if (mysqli_num_rows($res_results) > 0) {
                                        while ($r_res = mysqli_fetch_assoc($res_results)) {
                                            // <!-- Fomart date  -->
                                            $date = strtotime($r_res['date']);
                                            $date_fmtd = date('d F,Y', $date);

                                            $name = $r_res['name'];
                                            echo "<div class='nav nav-link'>- <a href='../../reports/student_grades_report.php?name=$name&stud_id=$student_id'>"
                                                . $name . "</a> | " . $date_fmtd . "</div>";
                                    ?>

                                    <?php
                                        }
                                    }
                                    ?>

                                </div>
                            </div>

                            <hr>
                            <h3>Next of Kin</h3>
                            <div class="form-group row">
                                <label for="nok_name" class="col-sm-2 col-form-label">Nok Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="nok_name" value="<?= htmlspecialchars($row['nok_name']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nok_relationship" class="col-sm-2 col-form-label">Relationship:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="nok_relationship" value="<?= htmlspecialchars($row['nok_relationship']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nok_phone" class="col-sm-2 col-form-label">Phone:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="nok_phone" value="<?= htmlspecialchars($row['nok_phone']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nok_email" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" readonly class="form-control-plaintext" id="nok_email" value="<?= htmlspecialchars($row['nok_email']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nok_address" class="col-sm-2 col-form-label">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="nok_address" value="<?= htmlspecialchars($row['nok_address']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nok_occupation" class="col-sm-2 col-form-label">Occupation:</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="nok_occupation" value="<?= htmlspecialchars($row['nok_occupation']); ?>">
                                </div>
                            </div>


                        </div>
                    </form>














                </div>
            </div>
        </main>
<?php
    }
} else {
    echo 'Invalid ID';
}
?>

<style>
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 3px solid lightblue;
        width: 40%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("parent_model");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php require_once('../layouts/footer_to_end.php'); ?>