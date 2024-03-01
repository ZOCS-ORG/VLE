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
                                <td class="text-right"><input type="text" name="name" required></td>
                            </tr>
                            <tr>
                                <td>DEBS:</td>
                                <td class="text-right">
                                    <select name="debs" id="select">
                                        <?php
                                        $q = mysqli_query($db, "SELECT * FROM users WHERE user_role = 'drc' ");
                                        if (!$q) {
                                            die('Could not enter data: ' . mysqli_error($db));
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                        ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Province:</td>
                                <td class="text-right">
                                    <select name="province" id="select1">
                                        <?php
                                        $q = mysqli_query($db, "SELECT * FROM provinces ");
                                        if (!$q) {
                                            die('Could not enter data: ' . mysqli_error($db));
                                        }
                                        while ($row = mysqli_fetch_assoc($q)) {
                                        ?>
                                            <option value="<?php echo $row['province_id']; ?>"><?php echo $row['province_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
                <h5 class="text-center my-2">Districts</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>DEBS</th>
                                <th>Province</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT d.*, u.name, province_name FROM districts d
                                            LEFT JOIN users u ON u.id = d.debs
                                            LEFT JOIN provinces p ON p.province_id = d.province_id
                                            ";
                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['district_name']; ?> </td>
                                    <td> <?php echo $row['name']; ?> </td>
                                    <td> <?php echo $row['province_name']; ?> </td>
                                    <th class="btn-group">
                                        <a class="btn btn-danger btn-sm text-light" href="?id=<?php echo $row['district_id'] ?>&delete=true">Delete </a>
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
    let mySelect1 = new vanillaSelectBox("#select1", {
        maxWidth: 500,
        maxHeight: 400,
        search: true,
    });
</script>
<?php

if (isset($_POST['create'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $debs = mysqli_real_escape_string($db, $_POST['debs']);
    $province = mysqli_real_escape_string($db, $_POST['province']);

    $sql = " INSERT INTO `districts` (`district_name`, `province_id`, `debs`) VALUES ('$name', '$province', '$debs')";

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = '?created=true' </script>";
    }
}

if (isset($_GET['delete'])) {
    $del = mysqli_real_escape_string($db, $_GET['id']);

    $success = mysqli_query($db, "DELETE FROM `districts` WHERE district_id = '$del' ") or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = '?created=true' </script>";
    }
}
require_once('../layouts/footer_to_end.php');

?>