<?php

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
if(isset($_POST['adminlogin'])){
	//get user input
	$username = $_POST['username'];
	$password = $_POST['passwd'];
	
	if($username == "admin" && $password == "Admin@123"){
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
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" /> -->
	<link rel="stylesheet" href="fontawesome-free-6.2.1-web/css/all.css">
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
	<form class="needs-validation" action="admin_login.php" method="post" novalidate>
		<div class="form-group">
			<!-- <label class="form-label" for="username">Username:</label> -->
			<!-- <span class="input-group-text">@</span> -->
			<input class="form-control" type="text" id="username" name="username" value="" placeholder="Username" required>
			<div class="invalid-feedback">
				Please enter Admin Username
			</div>
		</div>
		<div class="form-group input-group">
			<!-- <label class="form-label" for="password">Password:</label> -->
			<input class="form-control" type="password" id="password" name="passwd" value="" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\d a-zA-Z]).{8,}$" required>
			<span class="input-group-text" onclick="password_show_hide();"><i class="fas fa-eye" id="show_eye"></i><i class="fas fa-eye-slash d-none" id="hide_eye"></i></span>
			<div class="invalid-feedback">
				Please enter Admin password
			</div>
		</div>
		<div class="form-group">
			<input class="btn btn-success w-100" type="submit" value="Login" name="adminlogin">
		</div>
		<div class = "form-group">
			<input class="btn btn-secondary w-100" type="reset" value="Clear">
		</div>
		<?php if(isset($_POST['adminlogin'])){ ?>
		<span class="error"><?php echo $errorMsg; unset($_POST['adminlogin']);?></span>
		<?php } ?>
	</form>
	</div>
</div>
<script>
	(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

function password_show_hide() {
	var x = document.getElementById("password");
	var show_eye = document.getElementById("show_eye");
	var hide_eye = document.getElementById("hide_eye");
	hide_eye.classList.remove("d-none");
	if (x.type === "password") {
		x.type = "text";
		show_eye.style.display = "none";
		hide_eye.style.display = "block";
	} else {
		x.type = "password";
		show_eye.style.display = "block";
		hide_eye.style.display = "none";
	}
}
</script>
</body>
</html>