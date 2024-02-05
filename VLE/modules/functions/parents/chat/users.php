<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['id'])) {
  // header("location: login.php");
}
$userid = $_SESSION['id'];
 
 include_once "header.php"; 

?>

<!-- ============================ -->
<?php
//set to false if you don't want the sidebar to show
$add_side_bar = true;
require_once('../layouts/head_to_wrapper.php');
// return var_dump($username);
?>
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <?php include_once('../layouts/topbar.php') ?>
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Feeds Heading -->
    <div style="background-color: green" class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5">
      <h5 class="h5 mb-0 text-info ">Chats </h5>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Content Column -->

      <div class="col-lg-6 mb-4">
        <!-- ========================== -->



        <body>
          <div class="wrapper">
            <section class="users">
              <header>
                <div class="content">
                  <?php
                  $sql = mysqli_query($db, "SELECT * FROM users WHERE userid = '$userid' ");
                  if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                  }
                  ?>
                  <img src="../../../utils/chats/images/user2.jpg" alt="">
                  <div class="details">
                    <span><?php echo $row['name'] ?> </span>
                    <p><?php echo $row['status']; ?></p>
                  </div>
                </div>
              </header>
              <div class="search">
                <span class="text">Search to start a new conversation</span>
                <input type="text" placeholder="Type to search...">
                <button style="background-color:#008000; color:#FFFFFF"><i class="fas fa-plus"></i></button>
              </div>
              <div class="users-list">

              </div>
            </section>
          </div>

          <script src="javascript/users.js"></script>



      </div>
    </div>

  </div>
  <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('../layouts/footer_to_end.php');
?>

</body>

</html>