<?php
	require_once('header.php');
  require_once('server.php');
?>

<body>

    <?php 
      error_reporting(0);
      require '../includes/profile_navbar.php';
      $ass_id = $_GET['ass_id'];
      $class_id = $_GET['class_id'];
      $subject_id= $_GET['sub_id'];
      $student_id = $_GET['stud_id'];

      $ass_query = $db->query("SELECT * FROM ass_notice WHERE id='$ass_id' ");
      while($row1 = $ass_query->fetch_assoc()){    
        $ass_name = $row1['name'];  
      }
      $sub_query2 = $db->query("SELECT * FROM classes WHERE id='$class_id' ");
      while($row=$sub_query2->fetch_assoc()){    
        $class_name=$row['name'];  
      } 
      $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject_id' ");
      while($row1 = $sub_query3->fetch_assoc()){    
        $sub_name = $row1['name'];  
      }
    ?>

<div class="row">

    <!-- search column starts here -->
      <div class="col s12 m3">

      </div>
    <!-- search column ends here --> 
  
  <div class="row">
    <div class="col s12 m6">
      <div class="card blue darken-1">
        <div class="card-content white-text">
          <center> <span class="card-title">Grade Students Assignment</span> </center>
          <br>


        <!-- Add results  -->
          <form method="POST" action="#">
                <!--  body -->
                <div class="modal-body">

                    <div class="">
                        <div class="row">
                        <span class="col m4 white-text">Class & Subject</span>
                        <div class="col m8">
                            <?php 
                            echo '<span>'.$class_name.', '.$sub_name.'</span>';
                            ?>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <span class="col m4 white-text">Date </span>
                        <div class="col m8">
                            <input type="text" name="date" id="date1" alt="date" class="IP_calendar" title="Y-m-d" 
                                    readonly placeholder="<?php echo date('D, Y-m-d') ?>">
                            <span id="error_attendance_date" class="text-danger"></span>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                        <span class="col m4 white-text">Name of results being created </span>
                        <div class="col m8 col-lg-8">
                            <input type="text" name="name" value="<?php echo $ass_name ?>" placeholder="<?php echo $ass_name ?>" readonly />
                            <span id="error_attendance_date" class="text-danger"></span>
                        </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="student_register" width="100%" cellspacing="">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student Name</th>
                                        <th>Percentage</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            /**
                                             * @TODO: GET RESULTS OF ONLY THE STUDENTS IN A CLASS WHO TAKE A SPECIFIC
                                             *        SUBJECT BY DOING A KA JOIN🔗⏰⏰. NOT EVERYONE IN A CLASS
                                             */
                                            $query = "SELECT  name, id FROM students WHERE id = '$student_id'";
                                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                            $count = 1;
                                            if (mysqli_num_rows($result) > 0){                   
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $student_name = $row['name'];
                                                    $student_id = $row['id'];

                                                    //return var_dump($students);
                                                    echo "<td><input name='student_id' type='hidden' value='".$student_id."'>".$student_id." </input></td>";
                                                    echo "<td>".$student_name."</td>";
                                                    //echo "Check";
                                        ?>
                                        <td><input name="marks" class="custom-control-label" type="number" /></td>
                                        <td><input name="comment" type="text" placeholder="Comment" /></td>
                                    </tr>
                                        <?php
                                                }
                                            } else {
                                                echo 'Students Not found for this subject';
                                            }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>

                <!--  footer -->
                <div class="modal-footer">
                    <!-- Other Hidden data and Submit -->
                    <input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
                    <input type="hidden" name="subject_id" value="<?php echo $subject_id ?>" />
                    <input type="hidden" name="ass_id" value="<?php echo $ass_id ?>" />
                    <input type="submit" name="submmit_results" id="button_action" class="btn-small btn btn-success" value="Grade" />
                </div>


          </form>
        <!-- Add Results Model Ends -->




        </div>

      </div>
    </div>
  </div>







    <!-- reg srch column starts here -->

      <div class="col s12 m2">

      </div>

    <!-- reg srch column starts here   -->

</div>



    <?php ; ?>

    <?php require '../includes/footer.php'; ?>

  <!--  Scripts-->

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

  <!-- <script src="../js/materialize.js"></script> -->

  <script src="../js/init.js"></script>

  <script src="../js/script.js"></script>

</body>

</html>


<?php  ?>