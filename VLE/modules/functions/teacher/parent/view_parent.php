<?php
// require_once('../scripts/parent_validation.php');
// require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$parent_id = $_GET['id'];

?>

<hr />
<style>
    @media (max-width: 768px) {
        .card-body.text-right,
        .text-right.text-white {
            text-align: left !important;
        }
    }
    .card-body {
        padding: 1rem; /* Added padding */
    }
    .card-body table {
        width: 100%; /* Table takes full width */
    }
    .card-body table td:first-child {
        width: 50%; /* First column takes 50% width */
    }
</style>

<?php
$query = "SELECT  * from users where id = '$parent_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
$count = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

<main>
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-">Parents Info</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <div class="card-body text-right">
                                <h5 style="color: lightblue; text-align: left;"> Personal Info </h5>
                                <hr>
                                <table>
                                    <tr>
                                        <td>Parents ID</td>
                                        <td><?php echo $row['id']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><?php echo $row['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mother's Name</td>
                                        <td><?php echo $row['par_mothername']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Father's Name</td>
                                        <td><?php echo $row['par_fathername']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mother's Phone Number</td>
                                        <td><?php echo $row['par_motherphone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Father's Phone Number</td>
                                        <td><?php echo $row['par_fatherphone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?php echo $row['address']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-4">
                            <div class="card-body">
                                <div class="text-right text-white">
                                    <a href="update_parent.php?id=<?php echo $parent_id ?>" class="btn btn-info btn-sm">Edit</a>
                                    <a href="?id=<?php echo $parent_id; ?>&delete_parent=true" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
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



<?php
require_once('../layouts/footer_to_end.php');

//Update Parent
if (!empty($_POST['update_parent'])) {
    $id = $_POST['id'];
    if (!empty($_POST['password'])) {
        $pw = $_POST['password'];
        $password = md5($pw);
    }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fathername = $_POST['fathername'];
    $mothername = $_POST['mothername'];
    $fatherphone = $_POST['fatherphone'];
    $motherphone = $_POST['motherphone'];
    $address = $_POST['address'];

    $sql = "UPDATE parents SET";
    //Check to see that value is not empty so we don't replace already existing value with null😋..
    if (!empty($username)) {
        $sql .= " username = '$username',";
    }
    if (!empty($email)) {
        $sql .= " email = '$email',";
    }
    if (!empty($password)) {
        $sql .= " password = '$password',";
    }
    if (!empty($fathername)) {
        $sql .= " fathername = '$fathername',";
    }
    if (!empty($mothername)) {
        $sql .= " mothername = '$mothername',";
    }
    if (!empty($fatherphone)) {
        $sql .= " fatherphone = '$fatherphone',";
    }
    if (!empty($motherphone)) {
        $sql .= " motherphone = '$motherphone',";
    }
    if (!empty($address)) {
        $sql .= " address = '$address',";
    }

    $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE `id` = '$id' ";
    $success = mysqli_query($db, $sql) or die('Error: Could not Update data: ' . mysqli_error($db));
    // Update users table too
    $userid = "pa_" . $id;
    $sql_user = "UPDATE users SET";
    if (!empty($password)) {
        $sql_user .= " password = '$password',";
    }
    if (!empty($mothername)) {
        $sql_user .= " name = '$mothername',";
    }
    if (!empty($username)) {
        $sql_user .= " username = '$username',";
    }
    $sql_user = substr($sql_user, 0, strlen($sql_user)) . " userid = '$userid', user_role = 'parent' WHERE `userid` = '$userid' ";
    $success = mysqli_query($db, $sql_user) or die('Error: Could not Update data: ' . mysqli_error($db));

    header('Location: ../parent/view_parent.php?id=' . $id . "&" . $updated = true);
}

// Delete Parent
if (isset($_GET['id']) && isset($_GET['delete_parent'])) {
    if ($_GET['delete_parent'] == true) {
        $id = $_GET['id'];
        $sql = "DELETE FROM parents WHERE id = '$id';";
        $success = mysqli_query($db, $sql);
        $userid = "pa_" . $id;
        $sql = "DELETE FROM users WHERE userid = '$userid';";
        $success = mysqli_query($db, $sql);
        if (!$success) {
            die('Could not Delete data: ' . mysqli_error($db));
        }
        echo "<script> window.location = 'all_parents.php?deleted=true' </script>";
    }
}
?>
