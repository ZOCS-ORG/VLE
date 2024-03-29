<?php 
    require_once('../scripts/hostel_validation.php');
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

                    <div class="card-header"><h5 class="text-center my-2">Add new Hostel</h5></div>
                    <div class="card-body">
                        <form action="#" method="post" onsubmit="return hostel_validation();" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id"type="hidden" name="id" placeholder="Enter Id">
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input id="name" type="text" name="name" placeholder="Name"></td>
                                </tr>
                                <tr>
                                    <td>Bed Capacity:</td>
                                    <td class="text-right"><input id="beds" type="number" name="beds" placeholder="Bed capacity"></td>
                                </tr>
                                <tr>
                                    <td>Patron's ID:</td>
                                    <td class="text-right"><input id="patreon" type="text" name="patreon" placeholder="Patron's ID"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="add_hostel"value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once('../layouts/footer_to_end.php'); ?>

