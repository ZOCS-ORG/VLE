<?php
require_once('../../../config/config.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

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
<?php
$user_id = $_SESSION['id'];
$dist = "SELECT district_id FROM users WHERE id = '$user_id'";
$dist_result = mysqli_query($db, $dist);

if (!$dist_result) {
    die("Error: " . mysqli_error($db));
}
$dist_row = mysqli_fetch_array($dist_result);

$dist_id = $dist_row["district_id"];
// echo $dist_id;
?>
<div class="container">
    <div class="row justify-content-">
        <div class="col-lg-1">
            <div class="text-left text-light">
                <br>
                <div class="btn btn-sm btn-success" href="" onclick="history.back()"><i class="fa fa-arrow-left "></i> Back </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header">
                    <h5 class="text-center my-2">Create New </h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <table class="table" id="dataTable" width="100%" cellspacing="9">
                            <tr>
                                <td>Name:</td>
                                <td class="text-right"><input class="form-control" type="text" name="name" required></td>
                            </tr>
                            <tr>
                                <td >District:</td>
                                <td class="text-right form-control">
                                    <?php
                                    $q = mysqli_query($db, "SELECT * FROM districts WHERE district_id ='$dist_id'");
                                    if (!$q) {
                                        die('Could not enter data: ' . mysqli_error($db));
                                    }
                                    $row = mysqli_fetch_assoc($q);
                                    $district_id = $row['district_id'];
                                    $district_name = $row['district_name'];
                                    ?>

                                    <input class="form-control" type="text" name="district" value="<?php echo $district_name; ?>" readonly>
                                    <input type="hidden" name="district_id" value="<?php echo $district_id; ?>">

                                </td>
                            </tr>
                            <tr>
                                <td class="text-left"><input class="btn btn-sm btn-primary" type="submit" name="create" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card-header">
                <h5 class="text-center my-2">Zones</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>District</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // typeof
                            $sql = "SELECT z.*, d.district_name FROM zones z
                                        LEFT JOIN districts d ON d.district_id = z.district_id
                                        WHERE z.district_id = '$dist_id'";

                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['zone']; ?> </td>
                                    <td> <?php echo $row['district_name']; ?> </td>
                                    <th class="btn-group">
                                        <a class="btn btn-danger btn-sm text-light" href="?id=<?php echo $row['zone_id'] ?>&delete=true">Delete </a>
                                    </th>
                                </tr>
                            <?php

                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Multi-Select suport -->
<link rel="stylesheet" href="../../../assets/select_box/vanillaSelectBox.css">
<script src="../../../assets/select_box/vanillaSelectBox.js"></script>
<script>
    let mySelect = new vanillaSelectBox("#select", {
        maxWidth: 500,
        maxHeight: 400,
        minWidth: -1,
        search: true,
        disableSelectAll: true,
        placeHolder: "",
    });
</script>
<!-- End multi-select support  -->
<?php

if (isset($_POST['create'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $district = mysqli_real_escape_string($db, $_POST['district']);

    $sql = " INSERT INTO `zones` (`zone`, `district_id`) VALUES ('$name', '$district')";

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = '?created=true' </script>";
    }
}

if (isset($_GET['delete'])) {
    $del = mysqli_real_escape_string($db, $_GET['id']);

    $success = mysqli_query($db, "DELETE FROM `zones` WHERE zone_id = '$del' ") or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = '?deleted=true' </script>";
    }
}
require_once('../layouts/footer_to_end.php');

?>