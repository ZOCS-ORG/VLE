<?php 
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

                    <div class="card-header"><h5 class="text-center my-2">Create School Profile</h5></div>
                    <div class="card-body">
                        <form action="#" method="post" onsubmit="return librarian_validation();" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" name="id">
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input id="name" type="text" name="name" placeholder="Name"></td>
                                </tr>
                                <tr>
                                    <td>Tagline:</td>
                                    <td class="text-right"><input id="text"type="text" name="tag" placeholder="Tagline/Moto"></td>
                                </tr>
                                <tr>
                                    <td>School Display Name:</td>
                                    <td class="text-right"><?php if(isset($dn_error)){echo "<p style='color:red'>".$dn_error."</p>";} ?>
                                    <input type="text" name="dn" placeholder="Name to be used in school text and other commnication purposes" maxlength="10" required></td>
                                </tr>
                                <tr>
                                    <td>Contact Number:</td>
                                    <td class="text-right"><input id="phone"type="number" name="phone" placeholder="Phone Number"></td>
                                </tr>
                                <tr>
                                    <td>School Email:</td>
                                    <td class="text-right"><input id="email"type="email" name="email" placeholder="Email"></td>
                                </tr>
                                <tr>
                                    <td>Established:</td>
                                    <td class="text-right">
                                    <input type="text" name="est" id="est" alt="date" class="IP_calendar" title="Y-m-d">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Location:</td>
                                    <td class="text-right"><input type="text" id="location" name="location" placeholder="City/Town"></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td class="text-right"><input id="address" type="text" name="address" placeholder="Address"></td>
                                </tr>
                                <tr>
                                    <td>Logo:</td>
                                    <td class="text-right"><input id="file"type="file" name="file"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create_school"value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once('../layouts/footer_to_end.php'); ?>

