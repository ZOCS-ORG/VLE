<?php 
    require_once('../../../config/teacher_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $class_id = $_GET['class'];
    $get_class = "SELECT name FROM classes WHERE id = '$class_id' ";
    $class_res = mysqli_query($db,$get_class);
    $row = mysqli_fetch_assoc($class_res);
    $class_name = $row['name'];

    $subject_id = $_GET['subject'];
    $get_subject = "SELECT name FROM subjects WHERE id = '$subject_id' ";
    $subject_res = mysqli_query($db,$get_subject);
    $row = mysqli_fetch_assoc($subject_res);
    $subject_name = $row['name'];

?>
 <hr/>

<main>
    <div class="container-fluid col-md-9">
        <div class=" mb-4">
            <div class="card-header text-center">
                <h4> <?php echo $class_name." ".$subject_name; ?> Results</h4>
            </div>

    <div class="card mb-4">

        <div class="card-header">
            <div class="text-right text-light col-md-12">
                <a class="btn btn-sm btn-success" onClick="window.print()">Print Results <i class="fas fa-print "></i> </a>
            </div>
        </div>
        <div class="card-body" id="print_it">
            <div class="table-responsive print-conten">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                    <thead>
                        <tr>
                            <th>Results</th>
                            <th>Date Recorded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                $query = "SELECT  name, id,date FROM results WHERE class_id = '$class_id' AND subject_id = '$subject_id' GROUP BY name ";

                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($result) > 0){                   
                                    while($row = mysqli_fetch_assoc($result)){        
                            ?>

                                <!-- Results grouped by name -->
                                <td>
                                    <?php
                                        $name = $row['name'];
                                        echo "<div class='text-center'>
                                            <a href='../results/view_results.php?subject=$subject_id&class=$class_id&name=$name'>".$name."</a></div>";
                                    ?> 
                                </td>
                                <!-- Fomart date  -->
                                <td>
                                        <?php 
                                        $date = strtotime($row['date']);
                                        $date_fmtd = date('D - d M,Y',$date); 
                                        echo $date_fmtd;
                                        
                                        ?> 
                                </td>
                        </tr>

                            <?php
                                    }
                                } else {
                                echo 'Results not found for this class';
                                }
                            ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    </div>
</main>


<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    } );
</script>

<style>
    /* Print the form, only */
    @media print {
        body * {
            visibility: hidden;
        }
        #print_it, #print_it * {
            visibility: visible;
        }
        #print_it {
            position: absolute;
            left: 0;
            top: 0;
        }
    }


   
</style>

<script>

</script>

<?php require_once('../layouts/footer_to_end.php'); ?>
