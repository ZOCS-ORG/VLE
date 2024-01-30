<?php
require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');
include_once('../layouts/topbar.php');
?>


<script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables_themeroller.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/jquery.dataTables.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table_jui.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_table.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/css/demo_page.css" rel="stylesheet" data-semver="1.9.4" data-require="datatables@*" />
<link data-require="jqueryui@*" data-semver="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />
<script data-require="jqueryui@*" data-semver="1.10.0" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.9.4/jquery.dataTables.js" data-semver="1.9.4" data-require="datatables@*"></script> -->
<!-- Export to PDF DATATables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">


<div class="container-fluid col-md-9">
    <div class="card mb-6">

        <div class="card-header text-center">
            <h3>School Management Report</h3>
        </div>

        <p id="date_filter">
            <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="datepicker_from" />
            <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="datepicker_to" />               
                <span id="date-label-to" class="date-label">EMIS Number :<input class="date_range_filter date" type="text" id="" />
                    </p>
                    <table width="100%" class="display" id="datatable">
                        <thead>
                            <tr>
                                <th>Name of School</th>
                                <th>Number of pupils</th>
                                <th>Authorised By</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $result = mysqli_query($db, "SELECT * FROM expenses ")
                                        or die("A error occured: " . mysqli_error($db));

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $date_raw = strtotime($row['date']);
                                        $date = date('F d, Y', $date_raw);
                                        $total += $row['amount'];

                                        echo "<td>" . $date . "</td>";
                                        echo "<td><div class='text-uppercase'>" . $row['description'] . "</div></td>";
                                        echo "<td>" . $row['paid_by'] . "</a></td>";
                                        echo "<td>" . number_format($row['amount'], 2) . "</td>";
                                        ?>
                                    </tr>

                                    <?php
                                }
                            } else {
                                echo 'No Records Found!';
                            }
                            ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td><?php echo number_format($total, 2) ?></td>
                            </tr>
                        </tfoot>
                    </table>

                    </div>
                    </div>

                    <script>
                        $(function () {
                            var oTable11 = $('#').DataTable({
                                "oLanguage": {
                                    "sSearch": "Search"
                                },
                                "iDisplayLength": -1,
                                "sPaginationType": "full_numbers",

                            });
                            var oTable = $('#datatable').DataTable({
                                dom: 'Bfrtip',
                                buttons: [
                                    'copyHtml5',
                                    'excelHtml5',
                                    'csvHtml5',
                                    'pdfHtml5'
                                ]
                            });

                            $("#datepicker_from").datepicker({
                                showOn: "button",
                                buttonImageOnly: false,
                                "onSelect": function (date) {
                                    minDateFilter = new Date(date).getTime();
                                    oTable.fnDraw();
                                }
                            }).keyup(function () {
                                minDateFilter = new Date(this.value).getTime();
                                oTable.fnDraw();
                            });

                            $("#datepicker_to").datepicker({
                                showOn: "button",
                                buttonImageOnly: false,
                                "onSelect": function (date) {
                                    maxDateFilter = new Date(date).getTime();
                                    oTable.fnDraw();
                                }
                            }).keyup(function () {
                                maxDateFilter = new Date(this.value).getTime();
                                oTable.fnDraw();
                            });

                        });

                        // Date range filter
                        minDateFilter = "";
                        maxDateFilter = "";

                        $.fn.dataTableExt.afnFiltering.push(
                                function (oSettings, aData, iDataIndex) {
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

                    <!-- Export to PDF - Datatable -->
                    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script> -->
                    <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>



                    </div>
                    </div>

                    <!-- Footer -->
                    <footer class="sticky-footer sidebar_new_bg">
                        <div class="container my-auto">
                            <div class="copyright text-center my-auto">
                                <span style="color:#ffffff">Powered by <?php echo $app_name . ".  &copy; " . date('Y') ?>. </span>
                            </div>
                        </div>
                    </footer>
                    <!-- End of Footer -->

                    </div>

                    </body>

                    </html>


                    </div>
                    </div>

                    </div>
                    <!-- End of Content Wrapper -->

                    </div>
                    <!-- End of Page Wrapper -->

                    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

                    <!-- Bootstrap core JavaScript-->
                    <!-- <script src="../../../assets/vendor/jquery/jquery.min.js"></script> -->
                    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

                    <script src="../../../assets/sb-admin-2.min.js"></script>

                    <!-- DataTables -->
                    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
                    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>


                    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
