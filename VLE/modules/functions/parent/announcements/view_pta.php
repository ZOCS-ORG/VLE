<?php
// require_once('../scripts/program_validation.php');
require_once('../../../config/manager_server.php');   //contains db connection so we good 🤦🏾‍♂️
$add_side_bar = true;
include_once('../layouts/head_to_wrapper.php');

include_once('../layouts/topbar.php');
$user_id = $_SESSION['id'];
$users_sql = "SELECT created_by AS school FROM users WHERE id ='$user_id'";
$users_result = mysqli_query($db, $users_sql) or die('An error occurred while fetching schools: ' . mysqli_error($db));

// Check if the query returned any rows
if (mysqli_num_rows($users_result) > 0) {
    // Fetch the row as an associative array
    $user_row = mysqli_fetch_assoc($users_result);

    // Access the 'school' column from the fetched row
    $school_pta = $user_row['school'];

    // Output the school
    // ech o $school_pta;
} else {
    // Handle the case when no rows are returned
    // echo "No school found for the user with ID: $user_id";
}
?>

<style>
    .message-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .message {
        width: calc(50% - 20px);
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        background-color: #f0f8ea;
    }

    @media (max-width: 768px) {
        .message {
            width: 100%;
        }
    }
</style>

<hr />
<main>
    <div class="container-fluid col-md-12">


        <div class="card mb-4">
            <div class="card-header text-center">
                <h3>PTA</h3>
                <div class="text-right text-light">
                    <!-- <a class="btn btn-sm btn-success" href="create_pta.php">Add new PTA <i class="fas fa-plus "></i> </a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="message-container">
                    <?php
                    $sql = "SELECT p.*, u.name AS creater_name 
                        FROM pta_notices p 
                        left JOIN users u ON u.id = p.created_by 
                        left JOIN school_teachers st ON st.teacher_id = p.created_by 
                        left JOIN schools s ON s.school_id = st.school_id 
                        WHERE st.teacher_id = '$school_pta' 
                        ORDER BY p.id DESC;
        ";
                    $res = mysqli_query($db, $sql) or die('An error occured: ' . mysqli_error($db));

                    while ($row = mysqli_fetch_array($res)) {
                    ?>
                        <div class="message">
                            <div class="message-header">
                                <h5 class="message-title"><b><?php echo $row['title']; ?></b></h5>
                                <span class="message-date">Date:<?php echo $row['date']; ?></span>
                            </div>
                            <div class="message-body">
                                <p><?php echo $row['name']; ?></p>
                                <p>From: <?php echo $row['creater_name']; ?></p>
                            </div>
                            <!-- <div class="message-actions">
            <a class="btn btn-primary btn-sm text-light" href="update_pta.php?id=<?php echo $row['id'] ?>">Edit</a> 
            <a class="btn btn-danger btn-sm text-light" href="../../../config/manager_server.php?id=<?php echo $row['id'] ?>&delete_Notice=true">Delete</a>
        </div> -->
                        </div>
                    <?php
                    }
                    ?>
                </div>


            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>


    </div>
</main>


<?php require_once('../layouts/footer_to_end.php'); ?>