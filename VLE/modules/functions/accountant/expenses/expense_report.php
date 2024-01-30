<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

?>
        <hr/>
        <main>
            <div class="container-fluid col-md-9">
                <div class=" mb-4">

            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>Manage Expenses</h3>
                    <div class="text-right text-light">
                        <div class="btn-group"><a class="btn btn-sm btn-success" href="add_expense.php">Add expense <i class="fas fa-plus "></i> </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>Paid By</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date Paid</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <?php 
                                        $result = mysqli_query($db, "SELECT * FROM expenses ")
                                                            or die("A error occured: ".mysqli_error($db));

                                        if (mysqli_num_rows($result) > 0){                   
                                            while($row = mysqli_fetch_assoc($result)){
                                                
                                            /**Get student */
                                            $paid_by = $row['paid_by'];
                                            $q = "SELECT name, id
                                            FROM students
                                            WHERE id = $paid_by";

                                            $date_raw = strtotime($row['date_paid']);
                                            $date = date('d F, Y', $date_raw);
    
                                            $res = mysqli_query($db, $q) or die(mysqli_error($db));
    
                                            if (mysqli_num_rows($res) > 0){
                                                while($r = mysqli_fetch_assoc($res)){ 
                                                    $student_name = $r['name'];
                                                    echo "<td><a  href='../students/view_student.php?id=".$r['id']."'>".$student_name."</a></td>";
                                                }
                                            }

                                            echo "<td>". number_format($row['amount'],2) ."</td>";
                                            echo "<td><div class='text-uppercase'>". $row['description'] ."</div></td>";
                                            echo "<td>".$date."</td>";
                                    ?>
                                    <td><div class="btn-group"><a class="btn btn-primary btn-sm text-light " href="view_expense.php?id=<?php echo $row['id']?>">View</a>  
                                        </div>
                                    </td>
                                </tr>

                                    <?php
                                            }
                                        } else {
                                        echo 'No Records Found!';
                                        }
                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  


            <script>
                $(document).ready(function() {
                    $('#dataTable').DataTable();
                } );
            </script>








            </div>
        </main>


<?php require_once('../layouts/footer_to_end.php'); ?>
