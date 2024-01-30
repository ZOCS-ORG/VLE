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

                    <div class="card-header"><h5 class="text-center h4 my-2">Create Settings</h5></div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" name="id">
                                <tr>
                                    <td class="text-right h5 text-primary col-md-7">Accounts</td>
                                    <td class="text-left h5 text-primary">Settings</td>
                                </tr>
                                <tr>
                                    <td>Total tuition fees per term:</td>
                                    <td class="text-right"><input type="number" name="total_term_fees" placeholder="eg. 1500"></td>
                                </tr>
                                <tr>
                                    <td>Term 1 tuition payments due:</td>
                                    <td class="">
                                        <label >Day</label>
                                        <select name="date_due_1_day" >
                                            <?php
                                                for ($d1=1; $d1 <=30 ; $d1++) { 
                                                    echo "<option value=".$d1.">".$d1."</option>";
                                                }
                                            ?>     
                                        </select> <br>
                                        <label for="m1">Month</label>
                                        <select name="date_due_1_month" >
                                            <?php

                                                $start = $month = strtotime('2021-12-01');
                                                $end = strtotime('2022-12-01');
                                                while($month < $end)
                                                {
                                                    $month = strtotime("+1 month", $month);
                                                    echo "<option value=". date('m', $month), PHP_EOL.">". date('F', $month), PHP_EOL."</option>";
                                                }
                                            ?>     
                                        </select>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Term 2 tuition payments due:</td>
                                    <td class="">
                                        <label >Day</label>
                                        <select name="date_due_2_day" >
                                            <?php
                                                for ($d1=1; $d1 <=30 ; $d1++) { 
                                                    echo "<option value=".$d1.">".$d1."</option>";
                                                }
                                            ?>     
                                        </select> <br>
                                        <label for="m1">Month</label>
                                        <select name="date_due_2_month" >
                                            <?php

                                                $start = $month = strtotime('2021-12-01');
                                                $end = strtotime('2022-12-01');
                                                while($month < $end)
                                                {
                                                    $month = strtotime("+1 month", $month);
                                                    echo "<option value=". date('m', $month), PHP_EOL.">". date('F', $month), PHP_EOL."</option>";
                                                }
                                            ?>     
                                        </select>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Term 3 tuition payments due:</td>
                                    <td class="">
                                        <label >Day</label>
                                        <select name="date_due_3_day" >
                                            <?php
                                                for ($d1=1; $d1 <=30 ; $d1++) { 
                                                    echo "<option value=".$d1.">".$d1."</option>";
                                                }
                                            ?>     
                                        </select> <br>
                                        <label for="m1">Month</label>
                                        <select name="date_due_3_month" >
                                            <?php

                                                $start = $month = strtotime('2021-12-01');
                                                $end = strtotime('2022-12-01');
                                                while($month < $end)
                                                {
                                                    $month = strtotime("+1 month", $month);
                                                    echo "<option value=". date('m', $month), PHP_EOL.">". date('F', $month), PHP_EOL."</option>";
                                                }
                                            ?>     
                                        </select>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Currency:</td>
                                    <td class="text-right"><input type="text" name="currency" placeholder="eg. ZMK"></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-right h5 text-primary col-md-6">Other</td>
                                    <td class="text-left h5 text-primary">Settings</td>
                                </tr> -->
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create_settings"value="Submit"></td>
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

