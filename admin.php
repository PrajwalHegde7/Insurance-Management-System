<?php
session_start();
//check if user is logged in
if(! isset($_SESSION['admin'])){
	//user not logged in
	header("location: admin_login.php");
	exit;
}
?>
<html>
<head>
	<title>Life Insurance</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="style/login.css">
	<!-- <link href = "css/registration.css" type = "text/css" rel = "stylesheet" />  
	<link href = "css/style.css" type = "text/css" rel = "stylesheet" />   -->
</head>
<body>

<nav> 
	<div class="logo">
		<p>Insurance Management System</p>
	</div>
	<ul>
		<!-- <li><a href="about.html">About Us</a></li> -->
		<li><a href="logout.php">Logout</a></li>
	</ul>
</nav> 
<!-- <div class="title">
	<h1><center>Life Insurance Corporation</center></h1>
</div> -->
<div class="container gap-5">
	<div class="login">
		<h2><center>Links to<br>Registration pages</center></h2>
		<div class="d-grid gap-2">
			<a class="btn btn-outline-success text-decoration-none" href="agent/agent.php">Agent Registration</a>
			<a class="btn btn-outline-success text-decoration-none" href="client/client.php">Customer Registration</a>
			<a class="btn btn-outline-success text-decoration-none" href="nominee/nominee.php">Add Nominee</a>
			<a class="btn btn-outline-success text-decoration-none" href="scheme/scheme.php">Add Policy Scheme</a>
			<a class="btn btn-outline-success text-decoration-none" href="policy/policy.php">Policy Registration</a>
			<a class="btn btn-outline-success text-decoration-none" href="premium/premium.php">Premium Payment</a>
		</div>
	</div>
	<div class="login">
		<div class="d-grid gap-2">
			<h2><center>Links to<br>Data pages</center></h2>
			<a class="btn btn-outline-primary text-decoration-none" href="agent/modified.php">Agents Data</a>
			<a class="btn btn-outline-primary text-decoration-none" href="client/modified.php">Customers Data</a>
			<!-- <a class="btn btn-outline-primary text-decoration-none" href="nominee/modified.php">Nominee Data</a> -->
			<a class="btn btn-outline-primary text-decoration-none" href="scheme/modified.php">Scheme Data</a>
			<a class="btn btn-outline-primary text-decoration-none" href="policy/modified.php">Policies Data</a>
			<!-- <a class="btn btn-outline-primary text-decoration-none" href="premium/modified.php">Premiums Data</a> -->
	</div>
	</div>
</div>
</body>
</html>