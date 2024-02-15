<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good on that😊😊🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $id = $_GET['id'];

?>

        <hr/>     
        
        <?php 
            $query = "SELECT  * from settings where id = '$id' ";

            $result = mysqli_query($db, $query) or die(mysqli_error($db));
            $count = 1;
            if (mysqli_num_rows($result) > 0){                   
                while($row = mysqli_fetch_assoc($result)){ 
        ?>
        <main>
            <div class="container-fluid col-md-9">
                <div class="card mb-4">
                    <div class="card-header text-center">
                        <h3>Update School Info</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <input id="id" type="hidden" value="<?php echo $id; ?>" name="id">
                                <tr>
                                    <td class="text-right h5 text-primary col-md-7">Accounts</td>
                                    <td class="text-left h5 text-primary">Settings</td>
                                </tr>
                                <tr>
                                    <td>Total tuition fees per term:</td>
                                    <td class="text-right"><input type="number" name="total_term_fees" placeholder="<?php echo $total_term_fees; ?>"></td>
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
                                    <td class="text-right"><input type="text" name="currency" placeholder="<?php echo $currency; ?>"></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-right h5 text-primary col-md-6">Other</td>
                                    <td class="text-left h5 text-primary">Settings</td>
                                </tr> -->
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="update_seetings"value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php
                }
            } else {
            echo 'No Records Found!';
            }
        ?>


</div>
</div>
</div> 
<?php 

require_once('../layouts/footer_to_end.php'); 

?>
