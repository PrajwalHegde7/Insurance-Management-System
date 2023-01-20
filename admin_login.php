<?php

//start session
session_start();


//check if user is already logged in
if(isset($_SESSION['agentID'])){
	//user already logged in
	header("location: index.php");
}

if(isset($_SESSION['admin'])){
	header("location: admin.php");
}

//check for login form submission
if(isset($_POST['adminlogin'])){
	//get user input
	$username = $_POST['username'];
	$password = $_POST['passwd'];
	
	if($username == "admin" && $password == "admin@123"){
		//start session and store user information
		$_SESSION['admin'] = $username;
		echo "<script>alert(\"Login Success\")</script>";
		//redirect user to main page
		header("location: admin.php");
	}
	else{
		//invalid credentials
		$errorMsg = "Invalid username or password!";
	}
	
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
		.error {color:red;}
	</style>
</head>
<body>
<nav>
<div class="logo">
		<p>Insurance Management System</p>
	</div>
	<ul>
		<li><a href="login.php">Agent Login</a></li>
		<!-- <li><a href="about.html">About Us</a></li> -->
	</ul>	
</nav>
	<!-- <h1>Insurance Management System</h1> -->
<div class="container">
	<div class="login">
	<h2 class="text-center">Admin Login</h2>
	<form calss="needs-validation" action="admin_login.php" method="post">
		<div class="form-group was-validated">
			<!-- <label class="form-label" for="username">Username:</label> -->
			<input class="form-control" type="text" id="username" name="username" value="admin" placeholder="Username" required>
			<div class="invalid-feedback">
				Please enter your agent ID
			</div>
		</div>
		<div class="form-group was-validated">
			<!-- <label class="form-label" for="password">Password:</label> -->
			<input class="form-control" type="password" id="password" name="passwd" value="admin@123" placeholder="Password" required>
			<div class="invalid-feedback">
				Please enter your password
			</div>
		</div>
		<div class="form-group">
			<input class="btn btn-success w-100" type="submit" value="Login" name="adminlogin">
		</div>
		<div class = "form-group">
			<input class="btn btn-secondary w-100" type="reset" value="Clear">
		</div>
		<?php if(isset($_POST['adminlogin'])){ ?>
		<span class="error"><?php echo $errorMsg; ?></span>
		<?php } ?>
	</form>
	</div>
</div>
</body>
</html>