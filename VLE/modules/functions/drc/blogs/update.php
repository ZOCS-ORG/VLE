<?php
require_once('../../../config/manager_server.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');

$anno_id = $_GET['id'];
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
</style>

<?php
$query = "SELECT * from blogs where id = '$anno_id' ";

$result = mysqli_query($db, $query) or die(mysqli_error($db));
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-s border-0 rounded-lg mt-1">

                        <div class="card-header">
                            <h5 class="text-center my-2">Update Blog </h5>
                        </div>
                        <div class="card-body">
                            <form action="#" method="post" enctype="multipart/form-data">

                                <!-- <table class="table" id="dataTable" width="100%" cellspacing="9"> -->
                                    <tr>
                                        <td>Title:</td>
                                        <td class="text-right"><input type="text" name="title" value="<?php echo $row['title']; ?>" required></td>
                                    </tr> <br>
                                    <tr>
                                        <td>Blog:</td>
                                        <td class="text-right"><textarea id="tinymce" rows="4" name="blog" required><?php echo $row['blog']; ?></textarea></td>
                                    </tr>

                                    <tr>
                                        <td>File Attachment:</td>
                                        <td class="text-right">
                                            <input type="file" name="file" value="<?php echo $row['file']; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> <input type="hidden" name="created_by" value="<?php echo $id ?>"> </td>
                                        <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update" value="Submit"></td>
                                    </tr>
                                <!-- </table> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
} else {
    echo 'No Records Found!';
}
?>

<?php


if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $blog = mysqli_real_escape_string($db, $_POST['blog']);
    $created_by = $_POST['created_by'];

    // upload file to ../../../utils/blogs
    if (isset($_FILES['file'])) {
        $file = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], "../../../utils/blogs/" . $file);

        //delete previous file from server
        $query = "SELECT * from blogs where id = '$anno_id' ";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $filename = $row['file'];
                $path = "../../../../utils/blogs/" . $filename;
                unlink($path);
            }
        }
        $file_query = ", `file` = '$file_query'";
    }
    $file_query = " ";

    $sql = " UPDATE `blogs` SET `title` = '$title', `blog` = '$blog' '$file_query' WHERE id = '$anno_id' ";

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));

    if ($success) {
        echo "<script> window.location = './index.php?updated=true' </script>";
    }
}
require_once('../layouts/footer_to_end.php');
?>