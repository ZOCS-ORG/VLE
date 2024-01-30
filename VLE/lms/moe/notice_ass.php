<?php
require_once('header.php');
?>

<body>

    <?php require '../includes/profile_navbar.php'; ?>

    <div class="row">

        <!-- Notice starts here-->
        <div class="col s12 m4">
            <div class="card ">
                <?php require '../includes/ass_validation.php' ?>
                <div class="card-content ">Add New Document</span>
                    <form action="#" method="post" enctype="multipart/form-data">

                        <div class="row">

                            <div class="input-field col s12">
                                <textarea id="textarea" class="materialize-textarea" name="title" required></textarea>
                                <label for="textarea">Document Title</label>
                            </div>

                            <div class="input-field col s12">
                                <textarea id="textarea" class="materialize-textarea" name="description" required></textarea>
                                <label for="question">Document Details / Info</label>
                            </div>

                            <div class="input-field col s12">
                                <textarea id="textarea" class="materialize-textarea" name="url" required></textarea>
                                <label for="question">URL to Material</label>
                            </div>

                            <!-- file input starts here -->
                            <div class="file-field input-field col s12">
                                <div class="btn ">
                                    <span>File</span>
                                    <input type="file" name="nFile" >
                                </div>
                                <div class="file-path-wrapper ">
                                    <input class="file-path validate " type="text">
                                </div>
                            </div>
                            <!-- file input ends here -->

                        </div>

                        <div class="card-action">
                            <button class="btn blue waves-effect waves-light" type="submit" name="upload_doc">Upload
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
                <span class="">My Uploads</span>
            </div>

            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th data-field="ass_no">Name of Upload</th>
                        <th class="txt_limit" data-field="q">Document Details / Info</th>
                        <th data-field="subject">URL</th>
                        <th data-field="file">File</th>
                        <th data-field="date">Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $query = $db->query("SELECT * FROM moe_uploads ");

                    while ($row = $query->fetch_assoc()) {
                        $name = $row['title'];
                        $question = $row['description'];
                        $url = $row['url'];

                        $file = $row['file'];
                        $dueDate = $row['date_added'];
                        $assDate = $row['date'];
                        $ass_id = $row['upload_id'];

                        $file_path = "../files/moe_uploads/" . $file;
                        ?>
                        <tr>
                            <td><?php echo $name ?></td>
                            <td><?php echo $question ?></td>

                            <td> <a href="<?php echo $url ?>"> Go to URL </a>  </td>
                            <td> <a href="<?php echo $file_path ?>"> File </a>  </td>
                            <td><?php echo $dueDate ?></td>

                            <td>                                 
                                <a class="btn small red waves-effect waves-light" href="notice_ass.php?delete_upload=true&ass_id=<?php echo $ass_id ?>"> Delete </a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

        <!-- Notice ends here -->

    </div>

    <?php; ?>

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