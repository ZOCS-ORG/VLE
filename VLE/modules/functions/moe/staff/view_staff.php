<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$staff_id = $_GET['id'];

?>
<hr />
<?php
$query = "SELECT users.*, s.name AS school from users
            LEFT JOIN school_teachers st ON st.teacher_id = users.id
            LEFT JOIN schools s ON st.school_id = s.school_id
            where users.id = '$staff_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    $images_dir = "../../../utils/images/users/";

    while ($row = mysqli_fetch_assoc($result)) {
        $picname = $row['img'];
?>
        <main>
            <div class="card mb-4">
                <div class=" card-header text-center">
                    <h3 class="text-">Staff Info</h3>
                    <div class="text-">
                        <?php // echo "<img src='" . $images_dir . $picname . "' alt='" . $picname . "' width='140' height='140'> " ?>

                        <div class="text-center text-white">
                            <a href="update_staff.php?id=<?php echo $staff_id ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="../../../config/admin_server.php?id=<?php echo $staff_id; ?>&delete_staff=true" class="btn btn-danger btn-sm">Delete</a>
                        </div>

                    </div>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class=" mb-4">
                                <div class="card-body text-right">
                                    <h5 style="color:lightblue"> Personal Info </h5>
                                    <hr>
                                    <p>Staff ID</p>
                                    <p>Name</p>
                                    <p>Username</p>
                                    <p>Gender</p>
                                    <h5 style="color:lightblue"> Contact Info </h5>
                                    <hr>
                                    <p>Email</p>
                                    <p>Phone Number</p>
                                    <p>Address</p>
                                    <p>School</p>

                                </div>
                            </div>
                        </div>
                        <div>
                            <hr style="height:100%; width:1px; background-color:grey; ">
                        </div>

                        <div class="col-lg-5">
                            <div class=" mb-4">
                                <div class="card-body">
                                    <h5 style="color: transparent"> Personal Info</h5>
                                    <hr>
                                    <p> <?php echo $row['id']; ?> </p>
                                    <p> <?php echo $row['name']; ?> </p>
                                    <p> <?php echo $row['username']; ?> </p>
                                    <p> <?php echo $row['sex']; ?>. </p>
                                    <h5 style="color: transparent"> Contact Info</h5>
                                    <hr>
                                    <p> <?php echo $row['email']; ?> </p>
                                    <p> <?php echo $row['phone']; ?> </p>
                                    <p> <?php echo $row['address']; ?> </p>
                                    <p> <?php echo $row['school']; ?> </p>
                                    <h5 style="color: transparent"> Other</h5>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
<?php
    }
} else {
    echo 'No Records Found!';
}
?>



<?php require_once('../layouts/footer_to_end.php'); ?>