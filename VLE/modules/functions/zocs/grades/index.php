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
            <div class="card-header text-center">
                <h4> Grades</h4>
            </div>

    <div class="card mb-4">

        <!-- Add Grade Modal -->
            <form method="POST" action="#">
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <!-- <span class="close">&times;</span> -->

                    <!-- Modal body -->
                    <div class="modal-body">

                        <div class="form-group">
                            <h4 class="col-md-12 text-center"> Add new grade </h4>
                        </div>
                        <br>

                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table" id="dataTable" width="100%" cellspacing="9">
                                    <input id="id" type="hidden" name="id">
                                    <tr>
                                        <td>Name:</td>
                                        <td class="text-right"><input id="name" type="text" name="name" placeholder="Name"></td>
                                    </tr>
                                    <tr>
                                        <td>Min percentage:</td>
                                        <td class="text-right"><input type="number" name="min" placeholder="Min"></td>
                                    </tr>
                                    <tr>
                                        <td>Max percentage:</td>
                                        <td class="text-right"><input type="number" name="max" placeholder="Max"></td>
                                    </tr>
                                </table>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <!-- Other Hidden data and Submit -->
                        <input class="btn btn-sm btn-primary " type="submit" name="create_grade"value="Submit">
                        <span  class="close btn btn-sm btn-danger btn-sm">Close</span>
                    </div>




                </div>
            </div>
            </form>
        <!-- Add Grade Model Ends -->

        <div class="card-header">
            <div class="text-right text-light col-md-12">
                <a class="btn btn-sm btn-success" id="create_grade_model"> Add new grade  <i class="fas fa-percentage "></i> </a>
            </div>
        </div>
        <div class="card-body" id="print_it">
            <div class="table-responsive print-conten">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Minimum Percentage</th>
                            <th>Maximum Percentage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                $query = "SELECT  * FROM grades ";
                                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                $count = 1;
                                if (mysqli_num_rows($result) > 0){                   
                                    while($row = mysqli_fetch_assoc($result)){        
                            ?>

                            <td>
                                <p> <?php echo $row['name']; ?> </p>
                            </td>
                            <td>
                                <p> <?php echo $row['min_value']; ?> </p>
                            </td>
                            <td>
                                <p> <?php echo $row['max_value']; ?> </p>
                            </td>
                            <th class="btn-group"><a class="btn btn-primary btn-sm text-light" href="update_grade.php?id=<?php echo $row['id']?>" >Edit</a> 
                                <a class="btn btn-danger btn-sm text-light" href="../../../config/admin_server.php?delete_grade=true&id=<?php echo $row['id'] ?>">Delete </a>
                            </th>
                        </tr>

                            <?php
                                    }
                                } else {
                                echo 'No results created for this class. Create a new entry';
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


    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 3px solid lightblue;
    width: 45%;
    }

    /* The Close Button */
    .close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    }

    .close:hover,
    .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
    }
</style>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("create_grade_model");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
</script>

<?php require_once('../layouts/footer_to_end.php'); ?>
