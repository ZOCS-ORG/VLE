<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['id'])) {
  // header("location: login.php");
}
$id = $_SESSION['id'];
?>
<?php include_once "header.php"; ?>

<!-- ============================ -->
<?php
//set to false if you don't want the sidebar to show
$add_side_bar = true;
require_once('../layouts/head_to_wrapper.php');
?>
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <?php include_once('../layouts/topbar.php') ?>
  <!-- End of Topbar -->

  <?php
  $user_id = mysqli_real_escape_string($db, $_GET['user_id']);
  $sql = mysqli_query($db, "SELECT * FROM users WHERE id = '$user_id' ");
  if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
  } else {
    header("location: users.php");
  }
  ?>
  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Feeds Heading -->
    <div style="background-color: green" class="card d-sm-flex align-items-center justify-content-between mb-4 py-2 h5">
      <h5 class=" ">
        <!--  -->
        <div class="details">
          <span>Messeging <strong class="b"><?php echo " " . $row['name'] ?></strong></span>
        </div>
      </h5>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Content Column -->

      <div class="col-lg-6 mb-4">
        <!-- ========================== -->

        <div class="wrapper">
          <section class="chat-area">
            <header>
              <?php
              $user_id = mysqli_real_escape_string($db, $_GET['user_id']);
              $sql = mysqli_query($db, "SELECT * FROM users WHERE id = '$user_id' ");
              if (mysqli_num_rows($sql) > 0) {
                $row = mysqli_fetch_assoc($sql);
              } else {
                header("location: users.php");
              }
              ?>
              <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
              <img src="../../../utils/chats/images/user2.jpg" alt="im">
              <div class="details">
                <span><?php echo $row['name'] . " " . $row['username'] ?></span>
                <p><?php echo $row['status']; ?></p>
              </div>
            </header>
            <div class="chat-box">

            </div>
            <button id="clear-attachment" style="display:none"> x </button>

            <div id="file-preview"></div>

            <form action="#" class="typing-area" enctype="multipart/form-data">

              <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>

              <label for="file-upload">
                <img src="../../../utils/chats/images/attached.png" style="width: 30px;border-radius: 8px;" alt="Add Image">
              </label>
              <input type="file" name="attachment" id="file-upload" style="display: none;">


              <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off" required>
              <button><i class="fab fa-telegram-plane"></i></button>
            </form>
          </section>
        </div>

        <script src="javascript/chat.js"></script>


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

<!-- //Image styles// -->
<style>
  label {
    display: inline-block;
    cursor: pointer;
    /* Indicate interactivity */
    padding: 10px;
    /* Optional border */
    border-radius: 5px;
    /* Optional rounded corners */
  }

  /* Hide the default file input button */
  input[type="file"] {
    display: none;
  }

  input[type="file"]::file-selector-button {
    display: none;
    /* Hide the default button */
  }

  input[type="file"]::before {
    content: "";
    display: inline-block;
    width: 24px;
    /* Adjust for icon size */
    height: 24px;
    background-size: contain;
    cursor: pointer;
  }

  /* //?Preview */
  .preview {
    border-radius: 8px;
    height: 100px;
    width: 200px;
    background-color: #D3D3D3 !important;
    background: url("../../../utils/chats//images/attachment.png") no-repeat center;
    background-size: contain;
    padding: 10px;
    position: relative;
    text-orientation: upright !important;

    font-weight: 800;
  }
  .clear-btn{
    /* position: relative; */
    right: 10px;
    top: 10px;
    font-size: 10px;
    font-weight:900;
    color: red;
    cursor: pointer;
    border-radius: 5px;
    display: block!important;
  }
</style>


<script>
  const fileInput = document.getElementById('file-upload');
  const filePreview = document.getElementById('file-preview');
  const clearButton = document.getElementById('clear-attachment');

  
  fileInput.addEventListener('change', (event) => {
    // Display filename(s)
    const files = event.target.files;
    const fileNames = Array.from(files).map(file => file.name);
    filePreview.textContent = fileNames.join(', ');
    filePreview.classList.add("preview");
    clearButton.classList.add("clear-btn");
    clearButton.style.display = "display";
    
    // Clear selection on button click
    clearButton.addEventListener('click', () => {
      fileInput.value = '';
      filePreview.textContent = '';
      filePreview.classList.remove("preview");
      clearButton.classList.remove("clear-btn");
    });
  });
</script> 
