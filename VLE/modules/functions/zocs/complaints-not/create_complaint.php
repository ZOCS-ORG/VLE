<?php 
    // require_once('../scripts/parent_validation.php');
    require_once('../../../config/teacher_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');
    $teacher_id = $_SESSION['id'];

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

    input{
        width: 90%;
        border-radius: 8px;
        border: 1px inset black;
    }
    textarea{
        width: 90%;
        border-radius: 8px
    }
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-s border-0 rounded-lg mt-1">

                    <div class="card-header"><h5 class="text-center my-2">Create new Complaint</h5></div>
                    <div class="card-body">
                        <form action="#" method="post" onsubmit="return parent_validation();" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                            <input id="id" type="hidden" name="id" value="<?php echo $teacher_id ?>">
                                <tr>
                                    <td>Complaint:</td>
                                    <td class="text-right"> <textarea name="complaint" id="" cols="30" rows="4" required></textarea> </td>
                                </tr>
                                <tr>
                                    <td>File Attachment: (optional)</td>
                                    <td class="text-right"><input type="file" name="file" ></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="submit_complaint"value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('../layouts/footer_to_end.php'); ?>
