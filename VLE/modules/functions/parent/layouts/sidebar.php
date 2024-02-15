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
      <div class="sidebar-brand-text mx-3"> <img src="../../../assets/vle.png" height="70px" width="200px"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <br>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="../index.php">
        <i class="fa-"></i>
        <i class="fa fas fa-fw fa-tachometer"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item text-color-dark">
      <a class="nav-link" href="../students/index.php">
        <i class="fa fas fa-fw fa-child"></i>
        <span>Our Kids</span></a>
    </li>


    <li class="nav-item text-color-dark">
      <a class="nav-link" href="../chat">
        <i class="fa fas fa-fw fa-comments"></i>
        <?php
        //? count messeges
        $myID = $_SESSION['id'];
        $q = mysqli_query($db, "SELECT COUNT(msg) FROM messages WHERE incoming_msg_id = '$myID' AND status = 'Unread' ") or die('Fetch Failed: ' . mysqli_error($db));
        $fetch = mysqli_fetch_array($q);

        if ($fetch[0] > 0) {
          echo '<span class="badge badge-danger badge-counter badge-pill">' . $fetch[0] . '</span>';
        }
        ?>
        <span>Message Teacher </span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0 fas fa-fw fa fa-window-minimize " id="sidebarToggle"> </button>
    </div>

  </ul>