<?php 
	session_start();

	include '../../assets/config.php';

	// variable declaration
	$password = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	
	$role = "";
	$url = "";
	$newUrl = "";

	//func that sends user to respective page
	function takeUserHome(){
		//good code
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		//header('location: ../nurse/index.php');

		$url = header('Location:'.$r['url']);

		return var_dump($url);
		//good code
		
	}

	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);

		$role = mysqli_real_escape_string($db, $_POST['roles']);

		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


		//Get user specific url
        function checkUserRole(){
        	   global $role;
	          if ($role == 'Nurse') {
	             return "../nurse/index.php";
	          }elseif ($role == 'House Parent') {
	            return "../houseparent/index.php";
	          }elseif ($role == "Administrator") {
	            return "../admin/index.php";
	          }

        }

        $url = 'checkUserRole';
        $url();   	                



		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {

			$newUrl = $url();


			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (name, email, password, role, url) 
					  VALUES('$username', '$email', '$password', '$role', '$newUrl')";
			mysqli_query($db, $query);

			//send new user to their respective dashbord
			$createdId = mysqli_insert_id($db);

			$getLoggedInUser = "SELECT * FROM users WHERE id = '$createdId'";

			$loggedInUser = mysqli_query($db, $getLoggedInUser);			

			$user = mysqli_fetch_assoc($loggedInUser);
			if (mysqli_num_rows($loggedInUser) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "Logged in successfully";
				$url = $user['url'];
				$_SESSION['id'] = $createdId;
				header('Location: ../admin/users.php');
			}
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			//$password = md5($password);

			$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

			$results = mysqli_query($db, $query)or die("An error occured: ".mysqli_error($db));
			
			$r = mysqli_fetch_assoc($results);
			
			if (mysqli_num_rows($results) > 0) {
				$role = $r['role_id'];

				//Send the user to 
				switch ($role) {
					case '3': //System admin
						header('Location: ../admin/index.php');
						break;
					case '4': //School manager
						header('Location: ../functions/manager/index.php');
						break;
					default:
						echo "No Option selected!!";
						break;
				}
				$_SESSION['id'] = $r['id'];
				$_SESSION['success'] = "You are now logged in";

				//header('Location:'.$r['url']);

			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}


		// UPDATE USER
	if (isset($_POST['update_user'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$id= $_POST['id'];
		//$role = mysqli_real_escape_string($db, $_POST['roles']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {

			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "UPDATE users SET name='$username', email='$email', password='$password' WHERE id='$id' "; 
				mysqli_query($db, $query)or die(mysql_error('$db'));

			$q = "SELECT url FROM users WHERE id='$id' ";
			$r = mysqli_query($db, $q)or die(mysql_error('$db'));

			$link = mysqli_fetch_assoc($r);
			//if (mysqli_num_rows($r) == 1) {
			//return print_r($url);


				$_SESSION['username'] = $username;
				$_SESSION['id'] = $id;
				$_SESSION['success'] = "User updated successfully";
				header('Location:'.$link['url']);
			//}
		}

	}


?>