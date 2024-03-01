<?php
//Include - core files
    include_once("modules/utils/vars.php");
    require_once('modules/config/config.php');
    include_once('modules/utils/vars.php');

    //for login
    include_once('modules/assets/errors.php');
    //for admin
    // include_once('modules/functions/admin/layouts/head_to_wrapper.php');
    // include_once('modules/functions/admin/layouts/topbar.php');
    // include_once('modules/functions/admin/layouts/sidebar.php');
// include_once('modules/functions/admin/layouts/footer_to_end.php');

$request = $_SERVER['REQUEST_URI'];

/**
 * Router: This is a router switch that checks for the requested rout and does its thing.
 */
switch ($request) {
    // Home/index
    case '/srms/' :
    case '':
        require __DIR__ . '/modules/functions/base_user/login.php';
        break;
    // Base user login
    case '/srms/login_user' :
        require __DIR__ . '/modules/config/user_server.php';
        break;
    // When logong fails return with an error
    case '/srms/login-failed':
        require __DIR__ . '/modules/functions/base_user/login.php'.$login=false;
    break;
    // Admin
    case '/srms/administrator' :
        require __DIR__ . '/modules/functions/admin/index.php';
        break;
    case '/srms/add-student' :
        require __DIR__ . '/modules/functions/admin/students/add_student.php';
        break;
    case '/srms/add-student-success' :
        require __DIR__ . '/modules/functions/admin/index.php'.$success=false;
        break;

    default:
        //http_response_code(404);
        echo "use your brain Gift. \n This is not the case. check url: ".$request;//require __DIR__ . '/modules/functions/admin/index.php';
        break;
}

me();

?>