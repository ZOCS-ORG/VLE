<?php
require_once('header.php');
?>

<body>

    <?php require '../includes/profile_navbar.php'; ?>

    <div class="row">

        <!-- Notice starts here-->
        <div class="col s12 m4">
            <div class="card ">
                <?php require '../includes/upload_validation.php' ?>
                <div class="card-content ">
                    <span class="card-title">Upload file</span>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <div class="row">

                            <div class="input-field col s12">
                                <textarea id="textarea" class="materialize-textarea" name="name" required></textarea>
                                <label for="textarea">Name</label>
                            </div>

                            <div class="input-field col s12">
                                <textarea id="textarea" class="materialize-textarea" name="description" required></textarea>
                                <label for="question">Description</label>
                            </div>

                            <div class="input-field col s12">
                                <label for="question">FROM AGE</label><br>
                                <input id="number" type="number" name="from" required min="5">

                            </div>
                            <div class="input-field col s12">
                                <label for="question">TO AGE</label><br>
                                <input id="number" type="number" name="to" required min="5">
                            </div>

                            <!-- file input starts here -->
                            <div class="file-field input-field col s12">
                                <div class="btn ">
                                    <span>Book Cover</span>
                                    <input type="file" name="cover">
                                </div>
                                <div class="file-path-wrapper ">
                                    <input class="file-path validate " type="text">
                                </div>
                            </div>

                            <div class="file-field input-field col s12">
                                <div class="btn ">
                                    <span>File</span>
                                    <input type="file" name="nFile">
                                </div>
                                <div class="file-path-wrapper ">
                                    <input class="file-path validate " type="text">
                                </div>
                            </div>
                        </div>

                        <div class="card-action">
                            <button class="btn green waves-effect waves-light" type="submit" name="submit_ass_q">Send
                                <i class="material-icons right">send</i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <!-- Past Assignments -->
        <div class="col s12 m8">
            <div class="card-panel">
                <span class="">Uploaded documents </span>
            </div>

            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Cover</th>
                        <th>Age (From)</th>
                        <th>Age (To)</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Download</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = $db->query("SELECT * FROM upload_materials WHERE teacher_id='$t_id' ");

                    while ($row = $query->fetch_assoc()) {
                        $name = $row['name'];
                        $cover = $row['cover'];
                        $description = $row['description'];
                        $from = $row['from_age'];
                        $to = $row['to_age'];
                        $file = $row['file'];
                        $date = $row['date'];
                        $up_id = $row['id'];

                        $file_path = "../files/ass_notice/" . $file;
                        $cover_path = "../files/ass_notice/" . $cover;
                        /**File location */

                        // return var_dump($cover_path);

                        $sub_query2 = $db->query("SELECT * FROM classes WHERE id='$class' ");
                        while ($row = $sub_query2->fetch_assoc()) {
                            $class_name = $row['name'];
                        }
                        $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject' ");
                        while ($row = $sub_query3->fetch_assoc()) {
                            $sub_name = $row['name'];
                        }
                    ?>
                        <tr>
                            <td><?php echo $name ?></td>
                            <td>
                                <img src="<?php echo $cover_path ?>" alt="img" height="50" width="30" />
                            </td>
                            <td><?php echo $from ?></td>
                            <td><?php echo $to ?></td>
                            <td><?php echo $description ?></td>
                            <td><?php echo $date ?></td>
                            <td> <a href="<?php echo $file_path; ?>"> File </a> </td>
                            <td>
                                <a class="btn btn-sm green waves-effect waves-light" href="edit_upload.php?ass_id=<?php echo $up_id ?>"> Edit </a>
                                <a class="btn small red waves-effect waves-light" href="upload.php?delete_ass=true&ass_id=<?php echo $up_id ?>"> Delete </a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

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