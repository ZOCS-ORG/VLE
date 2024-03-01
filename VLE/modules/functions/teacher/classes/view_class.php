<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file here -->
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            th, td {
                display: block;
                width: 100%;
            }
            th {
                text-align: center;
            }
            td:before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>


<body>
    <!-- Your PHP code and HTML structure -->
    <?php
    require_once('../../../config/admin_server.php');
    $add_side_bar = true;
    include_once('../layouts/head_to_wrapper.php');
    include_once('../layouts/topbar.php');

    $id = $_GET['id'];

    $query = "SELECT  t.name AS teacher, t.id AS teacher_id, c.name, c.id
                , u.name AS monitor, s.id AS monitor_id
                FROM classes c
                INNER JOIN users t ON t.id = c.teacher_id
                LEFT JOIN students s ON s.id = c.monitor_id
                LEFT JOIN users u ON u.id = s.user_id
                where c.id = '$id'";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $count = 1;

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>

            <main>
                <div class="container-fluid col-md-9">
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            <h3> Class <?php echo $row['name']; ?></h3>
                        </div>

                        <div class="card-body">

                            <table>
                                <tbody>
                                    <tr>
                                        <td data-label="Class Teacher">Class Teacher</td> 
                                        <td>
                                            <p><a href='../lecturers/view_lecturer.php?id=<?php echo $row['teacher_id'] ?>'> <?php echo $row['teacher'] ?> </a></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td data-label="Class Monitor">Class Monitor</td>
                                        <td>
                                            <p><a href='../students/view_student.php?id=<?php echo $row['monitor_id'] ?>'> <?php echo $row['monitor'] ?> </a></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td data-label="Learners">Learners</td>
                                        <td>
                                            <ol>
                                                <?php
                                                $query = "SELECT students.*
                                                    FROM students
                                                    WHERE class_id = '$id' ";
                                                $resultss = mysqli_query($db, $query) or die('Error getting students: ' . mysqli_error($db));
                                                while ($res_student = mysqli_fetch_array($resultss)) {
                                                    $student_name = $res_student['name'];
                                                    $student_id = $res_student['id'];
                                                ?>
                                                    <li>
                                                        <a class='text-primary' href='../students/view_student.php?id=<?php echo $student_id ?>'> <u><?php echo $student_name ?> </u> </a>
                                                    </li>
                                                <?php } ?>
                                            </ol>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
            </main>
    <?php
        }
    } else {
        echo 'No Records Found!';
    }
    ?>

    <?php require_once('../layouts/footer_to_end.php'); ?>
</body>

</html>
