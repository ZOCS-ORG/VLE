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
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header">
                    <h5 class="text-center my-2">Create Blog Post </h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <table class="table" id="dataTable" width="100%" cellspacing="9">
                            <tr>
                                <td>Title:</td>
                                <td class="text-right"><input type="text" name="title" required></td>
                            </tr>
                            <tr>
                                <td>Blog:</td>
                                <td class="text-right"><textarea rows="4" name="blog" required></textarea></td>
                            </tr>

                            <tr>
                                <td>File Attachment:</td>
                                <td class="text-right">
                                    <input type="file" name="file" id="">
                                </td>
                            </tr>
                            <tr>
                                <td> <input type="hidden" name="created_by" value="<?php echo $id ?>"> </td>
                                <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create" value="Submit"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.multiselect('#testSelect1');
    document.multiselect('#testSelect2');
</script>

<?php
require_once('../layouts/footer_to_end.php');

if (isset($_POST['create'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $blog = mysqli_real_escape_string($db, $_POST['blog']);
    $created_by = $_POST['created_by'];

    // upload file to ../../../utils/blogs
    if (isset($_FILES['file'])) {
        $file = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], "../../../utils/blogs/" . $file);
    }


    $sql = " INSERT INTO `blogs`
                    (`title`, `blog`,`file`, `created_by`) 
            VALUES ('$title','$blog', '$file', '$created_by' ) ";

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = './index.php?created=true' </script>";
    }
}
?>