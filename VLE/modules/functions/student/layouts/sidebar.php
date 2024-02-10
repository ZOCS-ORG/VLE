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
      ?>
      <div class="sidebar-brand-text mx-3"> <img src="../../../assets/vle.png" height="80px" width="230px"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="../index.php">
        <i class="fa fas fa-fw fa-tachometer"></i>
        <span>Dashboard</span></a>
    </li>

    <li class="nav-item text-color-dark">
      <a class="nav-link" href="../classes/index.php">
        <i class="fa fas fa-fw fa-address-book-o"></i>
        <span>My Class</span></a>
    </li>

    <li class="nav-item text-color-dark">
      <a class="nav-link" href="../subjects/index.php">
        <i class="fa fas fa-fw fa-book"></i>
        <span>My Subjects</span></a>
    </li>

    <li class="nav-item text-color-dark">
      <a class="nav-link" href="../../../../lms/student">
        <i class="fa fas fa-fw fa-etsy"></i>

        <span>E-Learning </span></a>
    </li>



  </ul>