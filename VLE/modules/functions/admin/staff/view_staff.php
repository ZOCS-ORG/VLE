<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$staff_id = $_GET['id'];

?>
<hr />
<?php
$query = "SELECT * from users where id = '$staff_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    $images_dir = "../../../utils/images/users/";

    while ($row = mysqli_fetch_assoc($result)) {
        $picname = $row['img'];
?>
        <main>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="text-">Staff Info</h3>
                    <div class="text-right">
                        <a href="update_staff.php?id=<?php echo $staff_id ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="../../../config/admin_server.php?id=<?php echo $staff_id; ?>&delete_staff=true" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </div>

                <div class="card-body" style="overflow-x: auto;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <div class="card-body text-right">
                                    <h5 style="color:lightblue; text-align:left;"> Personal Info </h5>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td>Staff ID</td>
                                            <td><?php echo $row['id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo $row['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td><?php echo $row['username']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?php echo $row['sex']; ?></td>
                                        </tr>
                                    </table>
                                    <h5 style="color:lightblue; text-align:left;"> Contact Info </h5>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $row['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td><?php echo $row['phone']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td><?php echo $row['address']; ?></td>
                                        </tr>
                                    </table>
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