<nav class="navbar navbar-expand navbar-light sidebar_new_bg topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>


<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

  

  <div class="topbar-divider d-none d-sm-block"></div>

  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-dark small">Logged in as <strong> <?php echo $name; ?></strong></span>
       
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

      <?php if(isset($id))  { // ADD EDIT PROFILE ON HOMEPAGE WHERE ID IS AVAILABLE ?>
        <a class="dropdown-item" href="../account/update_profile.php?id=<?php echo $id;?>">
        <i class="fa fas fa-fw fa-edit"></i>
          Edit profile
        </a>
      <?php } ?>

      <a class="dropdown-item" href="../account/myprofile.php">
      <i class="fa fas fa-fw fa-user-circle"></i>
        My profile
      </a>


      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="../../../assets/logout.php">
        <!-- <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> -->
        <i class="fa fas fa-fw fa-power-off"></i>
        Logout
      </a>
    </div>
  </li>

</ul>

</nav>