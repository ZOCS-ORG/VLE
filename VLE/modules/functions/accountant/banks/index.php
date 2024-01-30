<?php 
    require_once('../../../config/accounts_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

?>
    <hr/>
    <main>
        <div class="container-fluid col-md-9">
            <div class=" mb-4">

            <!-- Add Bank Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                    <span class="close">&times;</span>

                    <div class="card-header"><h5 class="text-center my-2">Add Bank Information</h5></div>
                    <div class="card-body">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <table class="table" id="dataTable" width="100%" cellspacing="9">
                                <tr>
                                    <td>Name:</td>
                                    <td class="text-right"><input type="text" name="name" placeholder="Bank's name" required /></td>
                                </tr>
                                <tr>
                                    <td>Branch:</td>
                                    <td class="text-right"><input type="text" name="branch" placeholder="Name of branch" /></td>
                                </tr>
                                <tr>
                                    <td>Account Name:</td>
                                    <td class="text-right"><input type="text" name="account_name" placeholder="Name of account" /></td>
                                </tr>
                                <tr>
                                    <td>Account No.:</td>
                                    <td class="text-right"><input type="number" name="account_no" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td class="text-left"><input class="btn btn-sm btn-primary " type="submit" name="create_bank"value="Submit"></td>
                                </tr>
                            </table>
                        </form>
                    </div>

                    </div>
                </div>
            <!-- Add Bank Modal Ends -->

            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>Banks</h3>
                    <div class="text-right text-light">
                        <div class="btn-group"><button class="btn btn-sm btn-success" id="add_bank_model">Add new bank <i class="fas fa-plus "></i> </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="4">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Account Name</th>
                                    <th>Account Number</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $result = mysqli_query($db, "SELECT * FROM banks ")
                                                            or die("A error occured: ".mysqli_error($db));

                                        if (mysqli_num_rows($result) > 0){                   
                                            while($row = mysqli_fetch_assoc($result)){

                                                echo "<td>". $row['name']."</td>";
                                                echo "<td>".$row['branch']."</td>";
                                                echo "<td>". $row['account_name'] ."</td>";
                                                echo "<td>". $row['account_no'] ."</td>";
                                    ?>
                                    <th><div class="btn-group"><a class="btn btn-info btn-sm text-light" href="view_bank.php?id=<?php echo $row['id'];?>">View </a>
                                            <a class="btn btn-primary btn-sm text-light " href="update_bank.php?id=<?php echo $row['id']?>">Edit</a>
                                            <a class="btn btn-danger btn-sm text-light" href="../../../config/accounts_server.php?delete_bank=true&id=<?php echo $row['id'];?>">Delete </a>
                                        </div>
                                    </th>
                                </tr>

                                    <?php
                                            }
                                        } else {
                                        echo 'Add Bank Information';
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

<style>
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
    width: 40%;
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
    var btn = document.getElementById("add_bank_model");

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
