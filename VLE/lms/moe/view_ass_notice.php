<?php
	require_once('header.php');
?>

<body>

    <?php 
      error_reporting(0);
      require '../includes/profile_navbar.php'; 
      $ass_id = $_GET['ass_id'];
      $class_id = $_GET['class_id'];
      $subject_id= $_GET['sub_id'];

      $ass_query = $db->query("SELECT * FROM ass_notice WHERE id='$ass_id' ");
      while($row1 = $ass_query->fetch_assoc()){    
        $ass_name = $row1['name'];  
      }
      
    ?>


<br>
	<div class="container">

	    <div id="test2" class="col s12 m8">
		    <div class="card">
		        <div class="container left-align ">
				      <?php require '../includes/ass_submit_validation.php'; ?>

                    <?php  
                        $sub_query = $db->query("SELECT * FROM ass_notice WHERE id = $ass_id");
                        while($row=$sub_query->fetch_array()){
                            $question_id = $row['id'];
                            $name = $row['name'];
                            $question = $row['question'];
                            $teacher_id = $row['teacher_id'];
                            $file = $row['assFile'];
                            $dueDate = $row['date_due'];
                            $assDate = $row['date'];
                            $marks = $row['marks'];
                            $subject_id = $row['subject_id'];

                            $file_path = "../files/ass_notice/".$file; /**File location */
                    ?>
                    <div class="col s12 m6">

                        <!-- column starts here -->
                            <?php if (isset($_GET['created'])) { ?>
                              <div class="card-alert card center green lighten-5">
                                  <div class="card-content green white-text">
                                      <strong>Graded Successfully</strong>
                                  </div>
                                  <button type="button" class="close red-text" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">X</span>
                                  </button>
                              </div>                              
                            <?php }  ?>
                        <!-- column ends here -->



                        <div class="row">
                            <div class="col s6 m6 card-panel darken-2"> <b>Name:</b> <p> <?php echo $name ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Question:</b> <p> <?php echo $question ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>File:</b> <p> <a href="<?php echo $file_path ?>"> File </a>  </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Total Marks:</b> <p> <?php echo $marks ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Date Created:</b> <p> <?php echo $assDate ?> </p></div>
                            <div class="col s6 m6 card-panel darken-2"> <b>Date Due:</b> <p> <?php echo $dueDate ?> </p></div>
                        </div>
                    </div>

                    <?php } ?>

                    <!-- Tabs -->
                    <div class="col s12 m8" style="margin-top: 1em;">
                      <ul class="tabs">
                        <li class="tab col s3"><a href="#submissions">Submmissions</a></li>
                        <li class="tab col s3"><a href="#graded">Graded</a></li>
                      </ul>
                    </div>

                    <!-- First Tab - Submmissions -->
                    <div id="submissions" class="col s12 m8" >
                        <div class="card-panel blue">
                          <span class="white-text"> Recently Recieved Assignments </span>
                        </div><br>
                        <div class="row">
                          <table id="table1" class="responsive-table striped">
                            <thead>
                              <tr>
                                <th>Student Name</th>
                                <th>Date Submmited</th>
                                <th>Late</th>
                                <th>File</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $query = $db->query("SELECT * FROM assignments WHERE
                                              question_id = '$question_id' && subject_id = '$subject_id' && graded != 'yes' ")
                                              or die("An error occured: ".mysqli_error($db));

                                while($row=$query->fetch_assoc()){ 
                                  $student_id = $row['student_id'];
                                  $date_submmited = $row['date'];
                                  $late = $row['late'];
                                  $file = $row['assFile'];

                                  $file_path = "../files/assignment/".$file; /**File location */

                                  $stud_query = $db->query("SELECT * FROM students WHERE id='$student_id' ");
                                  while($stud_row = $stud_query->fetch_assoc()){    
                                    $student_name = $stud_row['name'];  
                                  } 
                                  $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject' ");
                                  while($row=$sub_query3->fetch_assoc()){    
                                    $sub_name = $row['name'];  
                                  } 
                                ?>
                              <tr>
                                <td><?php echo $student_name ?></td>
                                <td><?php echo $date_submmited ?></td>
                                <td><?php echo $late ?></td>
                                <td> <a href="<?php echo $file_path ?>" download> File </a>  </td>
                                <td><a class="btn blue waves-effect waves-light" 
                                  href="grade_ass.php?ass_id=<?php echo $ass_id."&class_id=".$class_id."&sub_id=".$subject_id."&stud_id=".$student_id; ?>">
                                  Grade<i class="material-icons right">grade</i></a>
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>  
                    </div>

                    <!-- Second Tab - Graded -->
                    <div id="graded" class="col s12 m8" >
                        <div class="card-panel blue">
                          <span class="white-text"> Graded Assignments </span>
                        </div><br>
                        <div class="row">
                          <table id="table2" class="responsive-table striped">
                            <thead>
                              <tr>
                                <th>Student Name</th>
                                <th>Marks</th>
                                <th>Comment</th>
                                <th>Date Graded</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $query = $db->query("SELECT * FROM results WHERE
                                              name = '$ass_name' && subject_id = '$subject_id' ")
                                              or die("An error occured: ".mysqli_error($db));
                                while($row=$query->fetch_assoc()){ 
                                  $student_id = $row['student_id'];
                                  $marks = $row['marks'];
                                  $commemt = $row['comment'];
                                  $date = $row['date'];

                                  $stud_query = $db->query("SELECT * FROM students WHERE id='$student_id' ");
                                  while($stud_row = $stud_query->fetch_assoc()){    
                                    $student_name = $stud_row['name'];  
                                  }  
                                ?>
                              <tr>
                                <td><?php echo $student_name ?></td>
                                <td><?php echo $marks ?></td>
                                <td><?php echo $commemt ?></td>
                                <td> <?php echo $date ?> </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>  
                    </div>


				    </div>
				    
		    </div>
		  </div>
	</div>






<script>
  // Alert Lines below
  $(document).ready(function() {
      $('.card-alert > button').on('click', function(){
          $(this).closest('div.card-alert').fadeOut('slow');
      })
  })
  // Datatable scripts below
  $(document).ready(function (){
      var table = $('#table1').DataTable({
          "order": [],
          "dom": 'Bfrtip', 
      });
  }); 
  $(document).ready(function (){
      var table = $('#table2').DataTable({
          "order": [],
          "dom": 'Bfrtip', 
      });
  }); 
</script>
    <?php require '../includes/footer.php'; ?>

  <!--  Scripts-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

  <!-- <script src="../js/materialize.js"></script> -->

  <script src="../js/init.js"></script>

  <script src="../js/script.js"></script>

</body>

</html>


<?php  ?>