<?php
require_once('../../../config/config.php');
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');
?>

<style>
    .table-width {
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 768px) {
        .table-width {
            width: 90%;
        }
    }

    @media (min-width: 992px) {
        .table-width {
            width: 80%;
        }
    }

    @media (min-width: 1200px) {
        .table-width {
            width: 70%;
        }
    }

    input,
    select,
    textarea {
        width: 100%;
        margin-bottom: 10px;
    }

    [type=radio] {
        width: auto;
        margin-right: 10px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-s border-0 rounded-lg mt-1">

                <div class="card-header">
                    <h5 class="text-center my-2">Create Blog Post</h5>
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="table-width">
                            <table class="table" id="dataTable">
                                <tr>
                                    <td>Title:</td>
                                    <td class="text-right"><input type="text" name="title" required></td>
                                </tr>
                                <tr>
                                    <td>Category:</td>
                                    <td class="text-right">
                                        <select name="cat_id" id="select">
                                            <?php
                                            $q = mysqli_query($db, "SELECT * FROM blog_categories");
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
                                    <td>Blog:</td>
                                    <td class="text-right"><textarea rows="4" name="blog"></textarea></td>
                                </tr>
                                <tr>
                                    <td>File Attachment:</td>
                                    <td class="text-right">
                                        <input type="file" name="file" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td> <input type="hidden" name="created_by" value="<?php echo $id ?>"> </td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary" type="submit" name="create" value="Submit."></td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['create'])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $blog = mysqli_real_escape_string($db, $_POST['blog']);
    $created_by = $_POST['created_by'];
    $cat_id = $_POST['cat_id'];

    // upload file to ../../../utils/blogs
    if (isset($_FILES['file'])) {
        $file = $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], "../../../utils/blogs/" . $file);
    }


    $sql = " INSERT INTO `blogs`
                    (`title`, `blog`,`file`, `created_by`, `cat_id`) 
            VALUES ('$title','$blog', '$file', '$created_by', '$cat_id' ) ";

    $success = mysqli_query($db, $sql) or die('Could not enter data: ' . mysqli_error($db));
    if ($success) {
        echo "<script> window.location = './index.php?created=true' </script>";
    }
}
require_once('../layouts/footer_to_end.php');

?>
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
