<?php 
    require_once('../scripts/parent_validation.php');
    require_once('../../../config/admin_server.php');
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
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-s border-0 rounded-lg mt-1">

                    <div class="card-header"><h5 class="text-center my-2">Add new Parent</h5></div>
                    <div class="card-body">
                        <form action="#" method="post" onsubmit="return parent_validation();" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id"type="hidden" name="id" placeholder="Enter Id">
                                <tr>
                                    <td>Username:</td>
                                    <td class="text-right"><input type="text" name="username" placeholder="Username.." required></td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td class="text-right"><input type="email" name="email" placeholder="Email" required></td>
                                </tr>
                                <tr>
                                    <td>Mother's Name:</td>
                                    <td class="text-right"><input type="text" name="mothername" placeholder="Mother's Name"></td>
                                </tr>
                                <tr>
                                    <td>Father's Name:</td>
                                    <td class="text-right"><input type="text" name="fathername" placeholder="Father's Name"></td>
                                </tr>
                                <tr>
                                    <td>Password:</td>
                                    <td class="text-right"><input type="password" name="password" placeholder="Enter Password" required></td>
                                </tr>
                                <tr>
                                    <td>Mother's Number:</td>
                                    <td class="text-right"><input type="number" name="motherphone" placeholder="Mother's Phone Number"></td>
                                </tr>
                                <tr>
                                    <td>Father's Number:</td>
                                    <td class="text-right"><input type="number" name="fatherphone" placeholder="Father's Phone Number"></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="text-right"><input id="address" type="text" name="address" placeholder="Enter Address"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="submit_parent"value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('../layouts/footer_to_end.php'); ?>

