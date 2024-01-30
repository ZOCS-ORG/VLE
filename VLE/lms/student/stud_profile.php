<?php
	require_once('header.php');
?>

<body class="">

<?php 
      require '../includes/profile_navbar.php';
      $_query = $db->query("SELECT * FROM students WHERE id='$id' ");
      $row3 = $_query->fetch_assoc();
      $class_id = $row3['class_id'];      
?>

<style>
  .tabs_center {
    display:flex;
    align-items: center;
    justify-content: center;
  }
</style>
<!-- <div class="container"> -->
<div class="row">
    <div class="col s12 m4">
      <!-- <div class="">
        <div class=""> -->

            <div class="col s12 ">
              <ul class="tabs blue-text">
                <li class="tab col s6"><a href="#pracs" class="active">Assignments</a></li>
                <li class="tab col s6"><a href="#assgs">Announcements</a></li>
              </ul>
            </div>
            <div id="pracs" class="col s12">
              <div class="col s12">
                <div class="card-panel blue">
                  <span class="white-text">
                      Assignments
                  </span>
                </div>
                <table id="table1" class="striped highlight responsive-table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Subject</th>
                      <th>Due Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                      <?php
                          $query = $db->query("SELECT * FROM ass_notice WHERE class_id = '$class' ORDER BY date_due DESC ")
                                    or die("Error: ".mysqli_error($db));

                          while($row=$query->fetch_assoc()){ 
                            $ass_id = $row['id'];
                            $name = $row['name'];
                            $subject=$row['subject_id'];
                            $dueDate=$row['date_due'];

                            $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject' ");
                            while($row=$sub_query3->fetch_assoc()){    
                              $sub_name=$row['name'];  
                            }
  
                      ?>
                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $sub_name ?></td>
                                <td><?php echo $dueDate ?></td>
                                <td><a class="btn blue waves-effect waves-light" 
                                  href="view_assignment.php?ass_id=<?php echo $ass_id; ?>">
                                  View<i class="material-icons right">send</i></a>
                                </td>
                            </tr>

                        <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div id="assgs" class="col s12">
              <div class="col s12 ">
                <div class="card-panel blue">
                  <span class="white-text">
                    Announcements
                  </span>
                </div>
                <table id="table2" class="striped highlight responsive-table">

                  <thead>
                    <tr>
                        <th>Name</th>
                        <th>Notice</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                  </thead>

                  <tbody>

                  <?php $sub_query = $db->query("SELECT * FROM notices WHERE class = '$class_id' ORDER BY id DESC");
                      while($row=$sub_query->fetch_assoc()){
                        $notice_id = $row['id'];
                        $title = $row['title'];
                        $name = $row['name'];
                        $date = $row['date'];
                    ?>

                    <tr>
                        <td><?php echo $title ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $date ?></td>
                        <td><a class="btn blue waves-effect waves-light" 
                          href="view_notices.php?notice_id=<?php echo $notice_id; ?>">
                          View<i class="material-icons right">send</i></a>
                        </td>
                    </tr>

                    <?php // }
                    }?>
                  </tbody>
                </table>
              </div>
            </div>
 
        <!-- </div>
      </div> -->
    </div>

    <div class="tabs_center">
      <div class="row col s12 " style="margin-top: 10px;">
        <div class="row m4">
          
          <?php
              $all_sub_query = "SELECT subjects.id, subjects.name
              FROM subjects
              INNER JOIN student_subjects ON subjects.id = student_subjects.subject_id
              WHERE student_id = '$id' ";
              $results = mysqli_query($db, $all_sub_query)or die('Error getting data: '. mysqli_error($db));
              if (mysqli_num_rows($results) > 0 ) {
                while($row_sub = mysqli_fetch_array($results)){
                    $subject_name = $row_sub['name'];
          ?>
            <div class="col s6 m3">
              <div class="card  blue">
                <div class="card-content white-text">
                  <span class="card-title bold"><?php echo $subject_name; ?> </span>
                  <!-- <p>Subject description and some notes</p> -->
                </div>
                <div class="card-action blue-text">
                  <a href="assignments.php?subject_id=<?php echo $row_sub['id']; ?>">Assignment</a>
                  <a href="notifications.php?subject_id=<?php echo $row_sub['id']; ?>">Notification</a>
                </div>
              </div>
            </div>  
          <?php
                }
              }
          ?>
        </div>
      </div>

    </div>
</div>


<script>
  // DataTables Lines Bellow
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
  <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>  
  <!-- <script src="../js/materialize.min.js"></script> -->
  <script src="../js/init.js"></script>
  <script src="../js/script.js"></script>
</body>
</html>

