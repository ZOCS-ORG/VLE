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



    <style>
        .search {
            width: 100%;
            position: relative;
            display: flex;
        }

        .searchTerm {
            width: 100%;
            border: 3px solid #009952;
            border-right: none;
            padding: 5px;
            height: 36px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
        }

        .searchTerm:focus {
            color: #009952;
        }

        .searchButton {
            width: 40px;
            height: 36px;
            border: 1px solid #009952;
            background: #009952;
            text-align: center;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 20px;
        }

        /*Resize the wrap to see the search bar change!*/
        .wrap {
            width: 30%;
            position: absolute;
            /* top: 5%; */
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <?php include('./nav.php') ?>

    <section class="news" id="news">
        <div class="titletext">
            <h1>Blogs <span>Feed</span></h1>
        </div>


        <div class="">
            <form method="post" action="#">
                <div class="wrap">
                    <div class="search">
                        <input type="text" name="query" class="searchTerm" placeholder="Search article">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>


        <div class="container">

            <?php

            // get blogs withe query results
            if (isset($_POST['query'])) {
                $query = mysqli_real_escape_string($db, $_POST['query']);
                $sql = "SELECT b.*, u.name FROM blogs b 
                    JOIN users u ON u.id = b.created_by
                    WHERE b.title LIKE '%$query%' OR blog LIKE '%$query%'
                    ORDER BY id DESC     
                ";
            } else {
                $sql = "SELECT b.*, u.name FROM blogs b 
                    JOIN users u ON u.id = b.created_by
                    ORDER BY id DESC ";
            }

            function limitTxt($str, $max, $print)
            {
                if (strlen($str) > $max) {
                    $str = substr($str, 0, $print) . '...';
                }
                return $str;
            }

            $q = mysqli_query($db, $sql) or die("Connection error: " . mysqli_error($db));

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
                                <small><?php echo date_format(date_create($row['timestamp']), "d M, Y"); ?> </small><br>
                                <span class="tag" style="margin:20px">News</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <footer>
        <p>&copy; 2024 ZOCS. All rights reserved.</p>
        <p>Address: P.O Box 50429 | Lusaka</p>
        <p>Contact: Phone: (+260) 211-253641 / 211-253656</p>
        <p>Powered by Chesco tech-ltd</p>
    </footer>
</body>

</html>