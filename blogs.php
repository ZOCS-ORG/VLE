<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zocs blogs</title>
    <link rel="stylesheet" href="blogs.css">

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-..." />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ebbc1aa60f.js" crossorigin="anonymous"></script>
    <script src="blogs.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
</head>

<body>
    <?php include('./nav.php') ?>

    <section class="news" id="news">
        <div class="titletext">
            <h1>Blogs <span>Feed</span></h1>
        </div>
        <div class="container">

            <?php

            function limitTxt($str, $max, $print)
            {
                if (strlen($str) > $max) {
                    $str = substr($str, 0, $print) . '...';
                }
                return $str;
            }

            $q = mysqli_query($db, "SELECT b.*, u.name FROM blogs b 
                        JOIN users u ON u.id = b.created_by
                        ORDER BY id DESC ") or die("Connection error: " . mysqli_error($db));

            while ($row = mysqli_fetch_array($q)) {
            ?>
                <div class="card" onclick="window.location = 'view_blog.php?id=<?php echo $row['id']; ?>'" style="onhover:pointer" onhover="point">
                    <div class="card__header">
                        <img src="vle/modules/utils/blogs/<?php echo $row['file']; ?>" alt="card__image" class="card__image" width="600" height="240px">
                    </div>
                    <div class="card__body">
                        <!-- <span class="tag">News</span> -->
                        <h4><?php echo limitTxt($row['title'], 200, 150); ?></h4>
                        <p> <?php echo limitTxt($row['blog'], 200, 150); ?> </p>
                    </div>
                    <div class="card__footer">
                        <div class="user">
                            <div class="user__info">
                                <h5> By <?php echo $row['name']; ?> </h5>
                                <small><?php echo date_format(date_create($row['timestamp']), "d M, Y"); ?> </small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>

    <footer>
        <p>&copy; 2024 ZOCS. All rights reserved.</p>
        <p>Address: P.O Box 50429 | Lusaka</p>
        <p>Contact: Phone: (+260) 211-253641 / 211-253656</p>
        <p>Powered by Chesco tech-ltd</p>
    </footer>
</body>

</html>