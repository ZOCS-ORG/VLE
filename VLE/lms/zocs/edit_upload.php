<?php
require_once('header.php');
?>

<body>

    <?php
    require '../includes/profile_navbar.php';
    $ass_id = $_GET['forum_id'];
    ?>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['ass_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['url']) && isset($_POST['visibility'])) {
            $ass_id = $_POST['ass_id'];
            $name = mysqli_real_escape_string($db, $_POST['name']);
            $description = mysqli_real_escape_string($db, $_POST['description']);
            $url = mysqli_real_escape_string($db, $_POST['url']);
            $visibility = mysqli_real_escape_string($db, $_POST['visibility']);

            if (isset($_POST['existing_file']) && !empty($_POST['existing_file'])) {
                $existing_file_name = $_POST['existing_file'];
            }

            if ($_FILES['file']['size'] > 0) {
                $file_name = $_FILES['file']['name'];
                $file_tmp = $_FILES['file']['tmp_name'];
                $file_type = $_FILES['file']['type'];
                $file_destination = "../files/ass_notice/" . $file_name;
                move_uploaded_file($file_tmp, $file_destination);
            } else {
                $file_name = $existing_file_name;
            }

            $update_query = "UPDATE moe_uploads SET title = '$name', description = '$description', url = '$url', visibility = '$visibility', file = '$file_name' WHERE upload_id = '$ass_id'";
            if (mysqli_query($db, $update_query)) {
                echo "<script>alert('Record updated successfully')</script>";
            } else {
                echo "Error updating record: " . mysqli_error($db);
            }
        } else {
            echo "All fields are required";
        }
    } else {
    }

    ?>


    <div class="row">

        <div class="col-md-8 s12 m8">
            <div class="card-panel" style="text-align:center;">

                <?php

                if (isset($_GET['forum_id'])) {

                    $ass_id = $_GET['forum_id'];

                    $query = $db->query("SELECT * FROM moe_uploads WHERE upload_id='$ass_id'");
                    $row = $query->fetch_assoc();

                    echo "<button class='btn waves-effect waves-light' onclick='window.history.back();' style='display: inline-block; margin-right: 10px;'>Back</button>";
                    echo "<br>";
                    echo "<br>";


                    echo "<span class='center'>Update " . $row['name'] . "</span>";

                    if ($row) {
                        $name = $row['title'];
                        $description = $row['description'];
                        $url = $row['url'];
                        $visibility = $row['visibility'];
                        $existing_file_name = $row['file'];
                        // $existing_video_name = $row['video'];


                ?>
                        <form method="POST" action="" enctype="multipart/form-data" style="width:60rem; margin-left:auto; margin-right:auto;">
                            <input type="hidden" name="ass_id" value="<?php echo $ass_id ?>">
                            <div class="input-field">
                                <input id="name" type="text" name="name" value="<?php echo $name ?>" required>
                                <label for="name">Name</label>
                            </div>

                            <div class="input-field">
                                <input id="description" type="text" name="description" value="<?php echo $description ?>">
                                <label for="description">Description</label>
                            </div>

                            <div class="input-field">
                                <input id="url" type="text" name="url" value="<?php echo $url ?>">
                                <label for="name">URL</label>
                            </div>

                            <div class="input-field">
                                <select name="visibility" id="select">
                                    <option value="Public" <?php if ($visibility == 'Public') echo 'selected'; ?>>Public</option>
                                    <option value="Private" <?php if ($visibility == 'Private') echo 'selected'; ?>>Private</option>
                                </select>
                                <label for="name">Visibility</label>
                            </div>


                            <!-- Existing file field for file -->
                            <div class="input-field">
                                <input id="existing_file" type="text" name="existing_file" value="<?php echo $existing_file_name; ?>" disabled>
                                <label for="existing_file">Existing File</label>
                            </div>

                            <!-- Allow user to upload a new file if needed -->
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Choose New File</span>
                                    <input type="file" name="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>

                            <button class="btn waves-effect waves-light" type="submit">Update</button>
                        </form>

                <?php
                    } else {
                        echo "No data found for this ID.";
                    }
                } else {
                    echo "No ass_id provided in the URL.";
                }
                ?>

            </div>



        </div>



    </div>

    <?php require '../includes/footer.php'; ?>

    <!--  Scripts-->

    <!-- <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>

    <!-- <script src="../js/materialize.js"></script> -->

    <script src="../js/init.js"></script>

    <script src="../js/script.js"></script>

</body>

</html>



<?php ?>