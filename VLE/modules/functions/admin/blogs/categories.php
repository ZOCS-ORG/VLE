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
                                <td class="text-left"><input class="btn btn-sm btn-primary" type="submit" name="create" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card-header">
                <h5 class="text-center my-2">Categories</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM blog_categories";
                            $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td> <?php echo $row['name']; ?> </td>
                                    <th class="btn-group">
                                        <a class="btn btn-danger btn-sm text-light" href="?id=<?php echo $row['id'] ?>&delete=true">Delete </a>
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

<?php

if (isset($_POST['create'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    
    $sql = " INSERT INTO `blog_categories` (`name`) VALUES ('$name')";

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = '?created=true' </script>";
    }
}

if (isset($_GET['delete'])) {
    $del = mysqli_real_escape_string($db, $_GET['id']);
    
    $success = mysqli_query($db, "DELETE FROM `blog_categories` WHERE id = '$del' ") or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = '?created=true' </script>";
    }
}
require_once('../layouts/footer_to_end.php');

?>