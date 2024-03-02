<?php
require_once('../../../config/admin_server.php'); //contains db connection so we good 🤦🏾‍♂️

// Retrieve the selected school ID from the AJAX request
$schoolId = $_POST['schoolId'];
// echo  $schoolId;
// Prepare SQL query to fetch data for the selected school
$sql = "SELECT u.name, u.id, u.dob, u.sex,u.address, u.img, s.name AS school 
        FROM users u 
        INNER JOIN school_teachers st ON st.teacher_id = u.created_by 
        INNER JOIN schools s ON s.school_id = st.school_id 
        WHERE user_role ='student' AND s.school_id = '$schoolId'
        GROUP BY u.id";

$res = mysqli_query($db, $sql) or die('An error occurred while fetching report data: ' . mysqli_error($db));
$images_dir = "../../../utils/images/users/";

// Initialize variables to store the count and report HTML
$count = mysqli_num_rows($res);
$reportHTML = "";


while ($row = mysqli_fetch_array($res)) {
    $picname = $row['img'];
    $dob = new DateTime($row['dob']);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
    // If age is 0, display 'N/A'
    $ageDisplay = ($age == 0) ? 'N/A' : $age;
    
    // Append row to the report HTML
    $reportHTML .= "<tr>";
    $reportHTML .= "<td>{$row['name']}</td>";
    $reportHTML .= "<td>{$ageDisplay}</td>";
    $reportHTML .= "<td>{$row['sex']}</td>";
    $reportHTML .= "<td>{$row['address']}</td>";
    $reportHTML .= "</tr>";
}

// Send the generated report HTML back as the response
echo $reportHTML;
?>
