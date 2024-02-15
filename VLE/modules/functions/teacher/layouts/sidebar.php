<?php session_start(); 

$token = bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal token

// Set the token in the session for validation later
$_SESSION['auth_token'] = $token;

// Retrieve username and password from session
$s_user = $_SESSION['username'];
$s_pass = $_SESSION['password'];

?>

<!-- @Overide some fa styling -->
    <style>
      .navbar-nav i.fas {
        color: green !important;
        font-size: 190% !important;
      }

      .collapse-inner a {
        color: green ! important;
      }

      .collapse-inner a:hover {
        background-color: lightgreen !important;
        color: black !important;
      }

      li span {
        color: green;
        font-style: bold !important;
        font-size: 110% !important;
      }

      .sidebar-light .sidebar-brand {
        color: green;
        padding-bottom: 10px;
      }

      .sidebar_new_bg {
        background: white;
      }

      .sidebar-light .nav-item .nav-link[data-toggle="collapse"]::after {
        display: none;

      }
    </style>

    <ul class="navbar-nav sidebar_new_bg sidebar sidebar-light accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <br>
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <?php //Get Title..
        $query =  "SELECT name FROM school_info ";
        $results = mysqli_query($db, $query);
        $row = mysqli_fetch_array($results);
        $admin_acc_title = $row['name'];
        ?>
        <div class="sidebar-brand-text mx-3"> <img src="../../../assets/vle.png" height="80px" width="230px"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <br>

      <form id="loginForm" class="" action="http://MOODLE.test/login/index.php" method="post">
    <input type="hidden" name="username" value="<?php echo $s_user; ?>">
    <input type="hidden" name="password" value="<?php echo $s_pass; ?>">
    <input type="submit" class="btn btn-success nav-item ml-4" value="VLE-Learning" style="background: black; border: none; cursor: pointer;">
</form>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="../index.php">
        <i class="fa fas fa-fw fa-tachometer"></i>
          <span>Dashboard</span></a>
      </li>

      


      <!-- 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#students"
                    aria-expanded="true" aria-controls="students">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Students </span>
                </a>
                <div id="students" class="collapse" aria-labelledby="students" data-parent="#accordionSidebar">
                    <div class="bg-dark py-2 collapse-inner rounded">
                        <a class="collapse-item" href="classes/index.php.php">Add student</a>
                        <a class="collapse-item" href="students/all_students.php">View all students</a>
                      </div>
                </div>
            </li>
          -->
      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../classes/index.php">
        <i class="fa fas fa-fw fa-address-book-o"></i>
          <span>My Classes</span></a>
      </li>

      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../parent/index.php">
        <i class="fa fas fa-fw fa-user"></i>
          <span>Parents</span></a>
      </li>

      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../students/index.php">
        <i class="fa fas fa-fw fa-users"></i>
          <span>Students</span></a>
      </li>


      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../subjects/index.php">
        <i class="fa fas fa-fw fa-book"></i>
          <span>My Subjects</span></a>
      </li>
      
      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../complaints/index.php">
        <i class="fa fas fa-fw fa-frown-o"></i>
          <span>Queries </span></a>
      </li>

      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../chat">
        <i class="fa fas fa-fw fa-comments-o"></i>
          <span>Chat </span></a>
      </li>

      <li class="nav-item text-color-dark">
        <a class="nav-link" href="../../../../lms/teacher">
        <i class="fa fas fa-fw fa-etsy"></i>
          <span>E-Learning </span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>




    