<?php
//set to false if you don't want the sidebar to show
$add_side_bar = true;
require_once('../layouts/head_to_wrapper.php');
?>

<style>
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
    }
</style>


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

    .box {
        width: 2.5em;
        height: 36px;
        border: 1px solid #009952;
        /* background: #009952; */
        text-align: center;
        color: #000;
        border-radius: 5px;
        cursor: pointer;
        font-size: 20px;
        margin-right: 5px;
    }
    a{
        all: unset;
        color: #000;
    }


    .pagination {
        width: 30%;
        position: absolute;
        /* top: 5%; */
        left: 50%;
        bottom: -50%;
        transform: translate(-50%, -50%);
    }
</style>
<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <?php include('../layouts/topbar.php') ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="col-md-12 container-fluid">
        <br>
        <!-- Page Heading -->
        <div class="col-md-12 d-sm-flex align-items-center justify-content-between mb-4">
            <div class="">
                <form method="post" action="#">
                    <div class="wrap">
                        <div class="search">
                            <input type="text" name="query" class="searchTerm" placeholder="Search from study materials">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <br>

        <div class="row">
            <?php

            //? Pagination stuff
            $items_per_page = 5; // Number of items per page
            $page_range = 5; // Number of page links displayed (adjust as needed)

            // Get the current page number (use $_GET if applicable)
            $current_page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

            $total_items_sql = "SELECT COUNT(*) FROM upload_materials";
            $result = $db->query($total_items_sql);
            $total_items = (int)$result->fetch_array()[0];
            $total_pages = ceil($total_items / $items_per_page);

            // Validate current page to avoid out-of-bounds errors
            $current_page = (int)max(1, min($current_page, $total_pages));

            // Calculate offset for the current page
            $offset = ($current_page - 1) * $items_per_page;

            $query = $db->query("SELECT um.*, u.name AS teacher_name, s.name AS school_name
                    FROM upload_materials um
                    LEFT JOIN users u ON um.teacher_id = u.id
                    LEFT JOIN school_teachers st ON st.teacher_id = um.teacher_id
                    LEFT JOIN schools s ON s.school_id = st.school_id
                    GROUP BY um.name
                    LIMIT $items_per_page OFFSET $offset
                    ");
                // echo mysqli_num_rows($query);

            while ($row = $query->fetch_assoc()) {
                $name = $row['name'];
                $cover = $row['cover'];
                $description = $row['description'];
                $from = $row['from_age'];
                $to = $row['to_age'];
                $file = $row['file'];
                $cover = $row['cover'];
                $date = $row['date'];
                $from_name = $row['teacher_name'];
                $school_name = $row['school_name'];



                $file_path = "../../../../lms/files/ass_notice/" . $file;
                $cover_path = "../../../../lms/files/ass_notice/" . $cover;
            ?>
                <div class="col-md-2 mb-4">
                    <div class="card border-success" style="padding: 1rem; height: 400px; width: 100%">
                        <div class="card-image center mb-2" style="height: 60%;">
                            <img style="width: 100%; height: 100%; object-fit: cover;" src="<?php echo $cover_path; ?>" alt="Cover Photo">
                        </div>
                        <div class="card-content mb-2" style="height: 50%; overflow-y: auto;">
                            <b class="card-title"><?php echo $name ?></b>
                            <p>Description: <?php echo $description ?></p>
                            <p>Date: <?php echo $date ?></p>
                            <p>From: <?php echo $from_name ?></p>
                            <p>School: <?php echo $school_name ?></p>
                            <p>Age Group: <?php echo $from ?> To <?php echo $to ?></p>
                        </div>
                        <div class="card-action">
                            <a href="<?php echo $file_path; ?>" class="btn btn-sm btn-success">Download</a>
                        </div>
                    </div>
                </div>


            <?php } ?>
        </div>


        <?php

        if ($total_pages != 0) {
            echo '<div class="pagination">';
            echo '<span class="box"> <a href="' . $_SERVER['PHP_SELF'] . '?page=1">First</a></span>';

            // Show page links around the current page
            $start_page = max(1, $current_page - $page_range);
            $end_page = min($total_pages, $current_page + $page_range);
            for ($i = $start_page; $i <= $end_page; $i++) {
                $class = ($i == $current_page) ? 'active' : '';
                echo '<a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '" class="box ' . $class . '">' . $i . '</a>';
            }

            echo '<span class="box"> <a href="' . $_SERVER['PHP_SELF'] . '?page=' . $total_pages . '">Last</a> </span>';
            echo '</div>';
        }
        ?>
    </div>
    <!-- /.container-fluid -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</div>
<!-- End of Main Content -->
<?php
require_once('../layouts/footer_to_end.php');
?>