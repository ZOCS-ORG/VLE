<?php
require_once('header.php');
require '../includes/profile_navbar.php';
$notice_id = $_GET['notice_id'];
?>

<body>
    <br>
    <div class="container">

        <div id="test2" class="col s12 m8">
            <div class="card">
                <div class="container left-align ">
                    <?php require '../includes/ass_submit_validation.php'; ?>

                    <?php
                    $sub_query = $db->query("SELECT * FROM notices WHERE id = $notice_id");
                    while ($row = $sub_query->fetch_array()) {
                        $notice_id = $row['id'];
                        $title = $row['title'];
                        $name = $row['name'];
                        $file = $row['file'];
                        $subject_id = $row['subject_id'];
                        $teacher_id = $row['teacher_id'];
                        $date = $row['date'];
                        $video = $row['video'];

                        $sub_query2 = $db->query("SELECT * FROM teachers WHERE id='$teacher_id'");
                        while ($row = $sub_query2->fetch_assoc()) {
                            $tName = $row['name'];
                        }
                        $sub_query3 = $db->query("SELECT * FROM subjects WHERE id='$subject_id'");
                        while ($row = $sub_query3->fetch_assoc()) {
                            $subject_name = $row['name'];
                        }

                        $file_path = "../files/noticefiles/" . $file;
                        /**File location */
                    ?>
                        <div class="col s12 m6">
                            <div class="row">
                                <div class="col s6 m6 card-panel darken-2"> <b>Title:</b>
                                    <p> <?php echo $title ?> </p>
                                </div>
                                <div class="col s6 m6 card-panel darken-2"> <b>Announcement:</b>
                                    <p> <?php echo $name ?> </p>
                                </div>
                                <div class="col s6 m6 card-panel darken-2"> <b>Suporting Document:</b>
                                    <p> <?php if(!empty($video)){ ?>
                                        <a href="<?php echo $file_path ?>"> Download </a>
                                        <?php }else{ echo "N/A"; } ?>
                                    </p>
                                </div>
                                <div class="col s6 m6 card-panel darken-2"> <b>Teacher:</b>
                                    <p> <?php echo $tName ?> </p>
                                </div>
                                <div class="col s6 m6 card-panel darken-2"> <b>Date Created:</b>
                                    <p> <?php echo $date ?> </p>
                                </div>
                                <div class="col s6 m6 card-panel darken-2"> <b>Suporting Video:</b>
                                    <p> <?php if(!empty($video)){ ?>
                                        <video width="100%" height="240" controls>
                                            <source src="../files/noticefiles/videos/<?php echo $video ?>">
                                        </video>
                                        <?php }else{ echo "N/A"; } ?>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <br><br>
                    <?php } ?>

                    <div class="card blue center">
                        <span class="card-title white-text"><b> Comments </b></span>
                    </div>
                    <br><br />


                    <div id="disqus_thread"></div>
                    <script>
                        /**
                         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document,
                                s = d.createElement('script');
                            s.src = 'https://chesco-lms-1.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


                </div>

            </div>
        </div>
    </div>

    <?php  ?>

    <?php require '../includes/footer.php' ?>
    <!--  Scripts -->

    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <!-- <script src="../js/materialize.js"></script> -->
    <script src="../js/init.js"></script>
    <script src="../js/script.js"></script>

</body>

</html>

<?php  ?>