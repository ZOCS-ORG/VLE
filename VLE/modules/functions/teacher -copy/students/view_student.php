<?php 
    require_once('../../../config/admin_server.php');   //contains db connection so we good 🤦🏾‍♂️
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $student_id = $_GET['id'];

?>
    <hr/>
    <?php 
        $query = "SELECT  * from students where id = '$student_id' ";

        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $count = 1;
        if (mysqli_num_rows($result) > 0){
            $images_dir = "../../../utils/images/students/";
                
            while($row = mysqli_fetch_assoc($result)){ 
                $picname = $row['img'];
    ?>

    <main>
        <div class="container-fluid col-md-9">
            <div class="card mb-4">
                <div class="card-header text-center">
                    <h3>Students Info</h3>
                    <?php echo "<img src='".$images_dir.$picname."' alt='".$picname."' width='140' height='140'> "?>
                </div>
                
                <div class="">
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Name</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p><?php echo $row['name']; ?></p>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Gender.</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">
                                <p> <?php echo $row['sex']; ?> </p>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Class</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                        <div class="">
                                <?php 
                                    $class_id = $row['class_id'];
                                    $q_class = "SELECT name, id FROM classes WHERE id = '$class_id' ";
                                    $res_class = mysqli_query($db,$q_class);
                                    $r_class = mysqli_fetch_assoc($res_class);
                                ?>
                                <p><a href="../classes/view_class.php?id=<?php echo $class_id ?>"><?php echo $r_class['name']; ?> </a></p>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class=" text-right">
                                <p>Subjects</p>
                            </div>
                        </div>
                        <div > </div>
                        <div class="col-lg-5">
                            <div class="">

                                <?php
                                    $query ="SELECT subjects.id, subjects.name
                                            FROM subjects
                                            INNER JOIN student_subjects ON subjects.id = student_subjects.subject_id
                                            WHERE student_id = '$student_id' ";
                                    $results = mysqli_query($db, $query)or die('Error getting data: '. mysqli_error($db));
                                    while($row_sub = mysqli_fetch_array($results)){
                                        $subject_name = $row_sub['name'];
                                        $subject_id = $row_sub['id'];
                                        echo "<span class='text-primary'>".$subject_name."</span> | ";
                                    }
                                ?>
                            </div>

                        </div>

                        <div class="col-lg-6">
                            <div class=" text-right">
                            </div>
                        </div>
                        <div > <hr style="width:1px; background-color:grey; "></div>


                    </div>
                    </div>



            </div>
        </div>
    </main>
    <?php
            }
        } else {
        echo 'Invalid ID';
        }
    ?>

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
    var btn = document.getElementById("parent_model");

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
