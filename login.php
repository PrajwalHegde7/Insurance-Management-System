<?php
require "connection.php";
//connect to the database
// $conn = mysqli_connect("localhost","root","","insurance");

//check for connection errors
// if($conn->connect_error) {
// 	die("Connection failed: ".$conn->connect_error);
// }

//start session
session_start();


//check if user is already logged in
if(isset($_SESSION['agentID'])){
	//user already logged in
	// header("location: index.php");
	unset($_SESSION['agentID']);
	header("location: login.php");
	exit;
}

if(isset($_SESSION['admin'])){
	// header("location: admin.php");
	unset($_SESSION['admin']);
	header("location: admin_login.php");
	exit;
}

//check for login form submission
if(isset($_POST['login'])){
	//get user input
	$agentID = mysqli_real_escape_string($conn, $_POST['agentID']);
	$password = mysqli_real_escape_string($conn, $_POST['passwd']);
	
	//check if user exists in the database
	$query = "SELECT * FROM Agent WHERE agentID='$agentID' AND passwd='$password'";
	$result = mysqli_query($conn, $query);
	
	//if user exists
	if(mysqli_num_rows($result) == 1){
		//start session and store user information
		$_SESSION['agentID'] = $agentID;
		echo "<script>alert(\"Login Success\")</script>";
		//redirect user to main page
		header("location: index.php");
	}
	else{
		//invalid credentials
		$errorMsg = "Invalid agentID or password!";
	}
	unset($_POST['login']);
}

//close connection
// mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
	integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="style/login.css">
	<!-- <link href = "css/registration.css" type = "text/css" rel = "stylesheet" />  
	<link href = "css/style.css" type = "text/css" rel = "stylesheet" /> -->
	<style>
		/* .form-group {
			text-align:center;
			align-items:center;
		}
		label {
			text-align:right;
		} */
		.error {color:red;}
	</style>
</head>
<body>
<nav> 
	<div class="logo">
		<p>Insurance Management System</p>
	</div>
	<ul>
		<!-- <li><a href="agent/agent.php"> Agent Registration</a></li> -->
		<li><a href="admin_login.php">Admin Login</a></li>
		<!-- <li><a href="about.html">About Us</a></li> -->
	</ul>
</nav>
<!-- <div class="title">
	<h1><center>Insurance Management System</center></h1>
</div> -->
<div class="container">
<div class="login">
	<h2 class="text-center">Login</h2>
	
	<form calss="needs-validation" action="login.php" method="post">
		<!-- <div class="container"> -->
			<div class = "form-group was-validated">
				<!-- <label class="form-label" for="agentID">agentID:</label> -->
				<input class="form-control" type="text" id="agentID" name="agentID" value="" placeholder="Agent ID" required>
				<div class="invalid-feedback">
					Please enter your agent ID
				</div>
			</div>
			<div class = "form-group was-validated">
				<!-- <label class="form-label" for="pasword">Password:</label> -->
				<input class="form-control" type="password" id="pasword" name="passwd" value="" placeholder="Password" required>
				<div class="invalid-feedback">
					Please enter your password
				</div>
			</div>
			<div class = "form-group">
				<input class="btn btn-success w-100" type="submit" value="Login" name="login">
			</div>
			<div class = "form-group">
				<input class="btn btn-secondary w-100" type="reset" value="Clear">
			</div>
			<?php if(isset($_POST['login'])){ ?>
				<p class="error"><?php echo $errorMsg; ?></p>
			<?php } ?>
		<!-- </div> -->
	</form>
	<p class="mb-0 text-center">Not registered yet? <a href="agent/agent.php" class="text-decoration-none">SignUp Here!</a></p>
</div>
	</div>
	<script src="js/bootstrap.bundle.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script> -->
</body>
</html>