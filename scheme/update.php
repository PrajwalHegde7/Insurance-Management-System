<?php
session_start();
if(! (isset($_GET['editid'])&&isset($_SESSION['admin']))){
    header("location: modified.php");
	exit;
}
require "../connection.php";
$id=$_GET['editid'];
unset($_GET['editid']);
$sql = "select * from scheme where schemeID='$id'";    
$result = mysqli_query($conn,$sql);
if(!$result || mysqli_num_rows($result) <= 0){
    header("location: modified.php");
    exit;
}
$row = mysqli_fetch_object($result)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Scheme Registration</title>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../style/login.css">
	<!-- <link href = "css/registration.css" type = "text/css" rel = "stylesheet" />  
	<link href = "css/style.css" type = "text/css" rel = "stylesheet" /> -->
</head>
<body>
<nav>
		<div class="logo">
			<p>Insurance Management System</p>
		</div>
		<ul>
			<li><a href="modified.php">Back</a></li>    
		</ul>
	</nav>
<div class="container">	
	<div class="login">
		<h2 class="text-center">Policy Scheme</h2>
		<form action="scheme.php" method="post">
				<div class = "form-group">
					<!-- <label>SchemeID:</label> -->
				<input class="form-control" type="text" name="schemeID" value="<?php echo $row->schemeID ?>" placeholder="Scheme ID" required readonly>
			</div>
			<div class = "form-group">
				<!-- <label>Name:</label> -->
			<input class="form-control" type="text" name="name" value="<?php echo $row->Name ?>" placeholder="Scheme Name" required>
		</div>
			<div class = "form-group">
			<!-- <label>Max Age:</label> -->
			<input class="form-control" type="text" name="maxAge" value="<?php echo $row->MaxAge ?>" placeholder="Maximum Age" required>
		</div>
			<div class = "form-group">
			<!-- <label>Min Amount:</label> -->
			<input class="form-control" type="text" name="minAmnt" value="<?php echo $row->MinAmount ?>" placeholder="Minimum Amount" required>
		</div>
		<div class = "form-group">
			<input class="btn btn-primary w-100" type="submit" value="Update" name="update"></p>
		</div>
		<div class = "form-group">
			<input class="btn btn-secondary w-100" type="reset" value="Reset"></p>
		</div>
	</div>
</form>
</div>
</div>
</body>
</html>