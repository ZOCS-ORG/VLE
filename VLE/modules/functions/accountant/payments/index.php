<?php
    include_once('../layouts/head_to_wrapper.php');
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/topbar.php');

?>
    <hr/>
    <script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables_themeroller.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table_jui.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_page.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
    <link data-require="jqueryui@*" data-semver="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
    <script data-require="jqueryui@*" data-semver="1.10.0" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.js" data-semver="1.9.4" data-require="datatables@*"></script>


    <div class="container-fluid col-md-9">
        <div class="card mb-4">

            <div class="card-header text-center">
                <h3>Manage Payments</h3>
                <div class="text-right text-light">
                    <div class="btn-group"><a class="btn btn-sm btn-success" href="add_payment.php">Add payment <i class="fas fa-plus "></i> </a>
                    </div>
                </div>
            </div>

            <p id="date_filter">
                <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
                <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />
            </p>
            <table width="100%" class="display" id="datatable">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Paid By</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php 
                            $result = mysqli_query($db, "SELECT * FROM payments ")
                                                or die("A error occured: ".mysqli_error($db));

                            if (mysqli_num_rows($result) > 0){                   
                                while($row = mysqli_fetch_assoc($result)){
                                $date_raw = strtotime($row['date_paid']);
                                $date = date('d F, Y', $date_raw);
                                echo "<td>".$date."</td>";
                                echo "<td>".$row['paid_by']."</a></td>";
                                echo "<td>". number_format($row['amount'],2) ."</td>";
                                echo "<td><div class='text-uppercase'>". $row['description'] ."</div></td>";
                        ?>
                        <td><div class="btn-group"><a class="btn btn-primary btn-sm text-light " href="view_payment.php?id=<?php echo $row['id']?>">View</a>  
                            </div>
                        </td>
                
                    </tr>

                    <?php
                            }
                        } else {
                        echo 'No recorded expenses';
                        }
                    ?>

                </tbody>
            </table>

        </div>
    </div>

    <script>

        $(function() {
        var oTable = $('#datatable').DataTable({
            "oLanguage": {
            "sSearch": "Search"
            },
            "iDisplayLength": -1,
            "sPaginationType": "full_numbers",

        });




        $("#datepicker_from").datepicker({
            showOn: "button",
            buttonImageOnly: false,
            "onSelect": function(date) {
            minDateFilter = new Date(date).getTime();
            oTable.fnDraw();
            }
        }).keyup(function() {
            minDateFilter = new Date(this.value).getTime();
            oTable.fnDraw();
        });

        $("#datepicker_to").datepicker({
            showOn: "button",
            buttonImageOnly: false,
            "onSelect": function(date) {
            maxDateFilter = new Date(date).getTime();
            oTable.fnDraw();
            }
        }).keyup(function() {
            maxDateFilter = new Date(this.value).getTime();
            oTable.fnDraw();
        });

        });

        // Date range filter
        minDateFilter = "";
        maxDateFilter = "";

        $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
            if (typeof aData._date == 'undefined') {
            aData._date = new Date(aData[0]).getTime();
            }

            if (minDateFilter && !isNaN(minDateFilter)) {
            if (aData._date < minDateFilter) {
                return false;
            }
            }

            if (maxDateFilter && !isNaN(maxDateFilter)) {
            if (aData._date > maxDateFilter) {
                return false;
            }
            }

            return true;
        }
        );

    </script>
  

    </div>
    </div>

    <!-- Footer -->
    <footer class="sticky-footer sidebar_new_bg">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span style="color:#ffffff">Powered by <?php echo $app_name.".  &copy; ".date('Y') ?>. </span>
        </div>
    </div>
    </footer>
    <!-- End of Footer -->

    </div>

</body>

</html>


