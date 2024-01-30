<?php
	require_once('header.php');
  $subject_id = $_GET['subject_id'];
?>
<body>
<?php require '../includes/profile_navbar.php'; 

$sub_query1 = $db->query("SELECT name FROM subjects WHERE id = '$subject_id' ")or die(mysqli_error($db));
while($row1 = $sub_query1->fetch_assoc()){
  $subJ = $row1['name'];
}

?>


  <div class="row">

      <div class="">

        <div class="col s12 m6 offset-m3">
            <div class="card-panel blue">
              <span class="white-text"><?php echo $subJ; ?> Notofications</span>
              <span class="right"> <a class="waves-effect waves-light btn-small btn" href="my_notifications.php?subject_id=<?php echo $subject_id; ?>">View My Notifications<i class="material-icons right">add</i></a>
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
                <?php
                  $sub_query = $db->query("SELECT * FROM notices WHERE class = '$class' && subject_id = '$subject_id' ORDER BY date DESC");
                      while($row=$sub_query->fetch_assoc()){
                        $notice_id = $row['id'];
                        $notice = $row['name'];   
                        $date = $row['date'];  
                        $title = $row['title'];
                        $teacher_id = $row['teacher_id'];

                        $sub_query2 = $db->query("SELECT * FROM teachers WHERE id='$teacher_id'");
                        while($row=$sub_query2->fetch_assoc()){    
                          $tName=$row['name'];
                        }       
                ?>
                <tr>
                    <td><?php echo $title ?></td>
                    <td><?php echo $notice ?></td>
                    <td><?php echo $date ?></td>
                    <td><a class="btn blue waves-effect waves-light" 
                      href="view_notices.php?notice_id=<?php echo $notice_id; ?>">
                      View<i class="material-icons right">send</i></a>
                    </td>
                </tr>
                  
                <?php } ?>
              </tbody>
          </table>
        </div>

        </div>

  </div>

  <?php require '../includes/footer.php'; ?>
  <!--  Scripts-->



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

  <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
  <!-- <script src="../js/materialize.js"></script> -->
  <script src="../js/init.js"></script>
  <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>

<?php  ?>