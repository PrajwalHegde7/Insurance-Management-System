<?php    
session_start();

require "../connection.php";

if(isset($_POST['submit'])){
	// require "input.php"; 
	$ac=$_POST['agentID'];
	// $sql = "select * from agent where agentID='$ac'";
	if(mysqli_num_rows(mysqli_query($conn,"select * from agent where agentID='$ac'")) == 0){
		$an=$_POST['agentName'];
		$d=$_POST['DOB'];
		$a=$_POST['Address'];
		$p=$_POST['password'];
		$con=$_POST['contactNumber'];
		$br=$_POST['Branch'];
		$query="insert into agent(agentID,agentName,DOB, Address, passwd, Branch, contactNum) values('$ac','$an','$d','$a','$p','$br',$con)";
		mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
		unset($_POST['submit']);
	} else {
		// echo "<script>alert('Duplicate Entry')</script>";
		$_SESSION['duplicate'] = "true";
		unset($_POST['submit']);
		header("location: agent.php");
		exit;
	}
}   

//check if user is logged in
if(! isset($_SESSION['admin'])){
	//user not logged in
	header("location: ../login.php");
	exit;
}

if(isset($_POST['update'])){
	// require "input.php"; 
	$ac=$_POST['agentID'];
	$an=$_POST['agentName'];
	$d=$_POST['DOB'];
	$a=$_POST['Address'];
	$p=$_POST['password'];
	$con=$_POST['contactNumber'];
	$br=$_POST['Branch'];
	$query="update agent set agentName='$an',DOB='$d', Address='$a', passwd='$p', Branch='$br', contactNum=$con where agentID='$ac'";
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	unset($_POST['update']);
}

if(isset($_GET['delid'])){
	$sql = "delete from agent where agentID = '".$_GET['delid']."'";    
	$result = mysqli_query($conn,$sql);
}

$sql = "select * from agent";    
$result = mysqli_query($conn,$sql);    
?>    
<html>    
	<head>
		<Title>Agent's Data</Title>
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../style/login.css">
		<!-- <link href = "../css/style.css" type = "text/css" rel = "stylesheet" />    
		<link href = "../css/registration.css" type = "text/css" rel = "stylesheet" />     -->
	</head>
    <body>
		
	<nav>
		<div class="logo">
			<p>Insurance Management System</p>
            </div>
            <ul>
                <li><a href="../admin.php">Back</a></li>    
            </ul>
        </nav>   
		<div class="container-fluid" style="padding-top: 12vh;">
	<div class="login" style="width:100%; height:85%; overflow-y: scroll;">
		<h2 class="text-center mb-3">Agent Data</h2>
		<table class="table table-bordered border-success table-striped table-hover align-middle">    
			<thead class="table-dark align-middle">
				<tr>    
					<td>Agent ID</td>    
					<td>Agent Name</td>    
					<td>DOB</td>    
					<td>Address</td>
					<td>Branch</td>    
					<td>Contact Number</td>
					<td>Action</td>    
				</tr>  
			</thead>
			<tbody>

				<?php    
    
		while($row = mysqli_fetch_object($result)){    
			
    
	?>  
			<tr>  
				<td>  
					<?php echo $row->agentID;?>  
				</td>  
				<td>  
					<?php echo $row->agentName;?>  
				</td>  
				<td>  
					<?php echo $row->DOB;?>  
				</td>  
				<td>  
					<?php echo $row->Address;?>  
				</td>
				<td>  
					<?php echo $row->Branch;?>  
				</td>  
				<td> 
					<?php echo $row->contactNum;?>  
				</td>  
				<td><a class="btn btn-primary w-100 mb-1" href="update.php?editid=<?php echo $row->agentID;?>">Edit</a>
				<a class="btn btn-danger w-100" href="modified.php?delid=<?php echo $row->agentID;?>" onclick="return confirm('Are You Sure')">Delete</a></td>
			</tr>  
		<?php } ?>  			
	</tbody>
        </table>
    </body>    
	</html>