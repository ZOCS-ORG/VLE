<?php
include '../teacher/header.php';
?>

<body>
  <?php require '../includes/profile_navbar.php'; ?>

  <!-- facebook comments -->

  <!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->

  <!-- facebook comments -->

  <div class="row">
    <div class="col s12 m3">
      <div class="card-panel ">
      </div><br>
      <div class="card horizontal">
        <div class="card-stacked">
          <a class="card-conten btn small text -text" href="forum.php">
            <span class="cardtitle">Discussions</span>
          </a>
          <br>
          <a class="card-conten btn small text -text" href="../../modules/functions/<?php echo $_SESSION['role'] ?>/">
            <span class="cardtitle">Back to Dashboard</span>
          </a>
        </div>
      </div>
    </div>
    <div class="col s12 m1"></div>
    <div class="col s12 m6">

      <?php
      $role = $_SESSION['role'];
      $forum_id = $_GET['forum_id'];
      if (!isset($forum_id)) {
        //?no forum selected;
        echo "<script> window.location = 'forums.php' </script>";
      }
      // $query = $db->query("SELECT * FROM discussions WHERE audience = '$role' OR  audience = 'All' OR created_by = '$logged_id' ORDER BY id DESC  ");
      $query = $db->query("SELECT * FROM discussions WHERE id = '$forum_id' ");

      while ($row = $query->fetch_assoc()) {
        $topic = $row['topic'];
        $forum_id = $row['id'];
        $created_by = $row['user_id'];
        $file = $row['file'];
        $video = $row['video'];
        $audience = $row['audience'];
        $timestamp = $row['timestamp'];

        $file_path = "../files/forums/" . $file;
        $video_path = "../files/forums/" . $video;
        /**File location */

        $sub_query2 = $db->query("SELECT * FROM users WHERE id='$created_by' ");
        while ($row = $sub_query2->fetch_assoc()) {
          $user = $row['name'];
        }
      ?>
        <div class="card-panel">
          <h5>Discussion <small>by <?php echo $user ?>: </small> </h5>
          Posted on <span><?php echo date_format(date_create($timestamp), "d M, Y") ?></span>
        </div>

        <div class="card-panel"><?php echo $topic ?></div>

        Attachments: <a href="<?php echo $file_path ?>"> File </a> | <a href="<?php echo $video_path ?>"> Video </a>


      <?php } ?>



      <!-- <div class="fb-comments " data-href="http://127.0.0.1/nicks_crap/battle/pages/forum.php" data-numposts="5"></div> -->

      <br>
      <br>
      <hr>

      <div></div>
      <!-- disqus comments -->
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
          s.src = 'https://chesco-lms.disqus.com/embed.js';
          s.setAttribute('data-timestamp', +new Date());
          (d.head || d.body).appendChild(s);
        })();
      </script>
      <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript"></a></noscript>
      <!-- disqus comments ends -->

    </div>
    <div class="col s12 m2"></div>
  </div>
  <?php require '../includes/footer.php'; ?>
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>   -->
  <script src="../js/materialize.min.js"></script>
  <script src="../js/init.js"></script>
  <script src="../js/script.js"></script>
  <script id="dsq-count-scr" src="//chesco-lms.disqus.com/count.js" async></script>
</body>

</html>

<?php ?>