<?php    
session_start();

//check if user is logged in
if(! (isset($_SESSION['agentID'])||isset($_SESSION['admin']))){
	//user not logged in
	header("location: ../login.php");
	exit;
}

require "../connection.php";

if(isset($_POST['submit'])){
	// require "input.php";
	$fn=$_POST['First_Name'];
	$mn=$_POST['Middle_Name'];
	$ln=$_POST['Last_Name'];
	$d=$_POST['DOB'];
	$g=$_POST['Gender'];
	$a=$_POST['Address'];
	$con=$_POST['contactNumber'];
	$mon=$_POST['Mother_Name'];
	$mos=$_POST['Mother_Status'];
	$fan=$_POST['Father_Name'];
	$fas=$_POST['Father_Status'];
	$ms=$_POST['Marital_Status'];
	$s=$_POST['Spouse'];
	$query="insert into Customer(First_Name,Middle_Name,Last_Name,Gender,DOB,Address,contactNumber, Mother_Name, Mother_Status,Father_Name, Father_Status, Marital_status, Spouse) values('$fn','$mn','$ln','$g','$d','$a',$con,'$mon','$mos','$fan','$fas','$ms','$s')";
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	unset($_POST['submit']);
}

if(isset($_POST['update'])){
	// require "input.php";
	$cid=$_POST['customerID'];
	$fn=$_POST['First_Name'];
	$mn=$_POST['Middle_Name'];
	$ln=$_POST['Last_Name'];
	$d=$_POST['DOB'];
	$g=$_POST['Gender'];
	$a=$_POST['Address'];
	$con=$_POST['contactNumber'];
	$mon=$_POST['Mother_Name'];
	$mos=$_POST['Mother_Status'];
	$fan=$_POST['Father_Name'];
	$fas=$_POST['Father_Status'];
	$ms=$_POST['Marital_Status'];
	$s=$_POST['Spouse'];
	$query="update Customer set First_Name='$fn',Middle_Name='$mn',Last_Name='$ln',Gender='$g',DOB='$d',Address='$a',contactNumber=$con, Mother_Name='$mon', Mother_Status='$mos',Father_Name='$fan', Father_Status='$fas', Marital_status='$ms', Spouse='$s' where customerID=$cid";
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	unset($_POST['update']);
}

if(isset($_GET['delid'])){
	if(is_numeric($_GET['delid'])){    
		$sql = "delete from customer where customerID = '".$_GET['delid']."'";    
		$result = mysqli_query($conn,$sql);    
	}
}

if(isset($_SESSION['empty'])){
	echo "<script>alert('No Nominee data')</script>";
	unset($_SESSION['empty']);
}

$sql = "select * from customer";    
$result = mysqli_query($conn,$sql);    
?>    
<html>
	<head>
		<title>Client's Data</title>
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="../css/bootstrap.css">
		<link rel="stylesheet" href="../style/login.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"> -->
		<!-- <link href = "../css/style.css" type = "text/css" rel = "stylesheet" />    
		<link href = "../css/registration.css" type = "text/css" rel = "stylesheet" />     -->
	</head>
    <body>
	<nav>
		<div class="logo">
			<p>Insurance Management System</p>
		</div>
		<ul>
			<li><a href="../login.php">Back</a></li>    
		</ul>
	</nav>
	<div class="container-fluid" style="padding-top: 12vh;">
	<div class="login" style="width:100%; height:85%; overflow-y: scroll;">
		<h2 class="text-center mb-3">Customer Data</h2>
		<table class="table table-bordered border-success table-striped table-hover align-middle">
			<!-- <table id="example" class="table table-striped" style="width:100%;"></table> -->
			<thead class="table-dark align-middle">
				<tr>
					<td>Customer Number</td>
					<td>First Name</td>
					<td>Middle Name</td>
					<td>Last Name</td>
					<td>Gender</td>
					<td>DOB</td>
					<td>Address</td>
					<td>Contact Number</td>
					<td>Mother Name</td>
					<td>Mother Status</td>
					<td>Father Name</td>
					<td>Father Status</td>
					<td>Marital Status</td>
					<td>Spouse</td>
					<td>Nominee</td>
					<td>Action</td>
            	</tr>
			</thead>
			<tbody>

				<?php    
	
	while($row = mysqli_fetch_object($result)){    
		
		
		?>  
		<tr>  
				<td>  
					<?php echo $row->customerID;?>  
				</td>  
				<td>  
					<?php echo $row->First_Name;?>  
				</td>  
				<td>  
					<?php echo $row->Middle_Name;?>  
				</td>  
				<td>  
					<?php echo $row->Last_Name;?>  
				</td>  
				<td>  
					<?php echo $row->Gender;?>  
				</td>  
				<td>  
					<?php echo $row->DOB;?>  
				</td>  
				<td>  
					<?php echo $row->Address;?>  
				</td>  
				<td> 
					<?php echo $row->contactNumber;?>  
				</td>  
				<td>  
					<?php echo $row->Mother_Name;?>  
				</td>  
				<td>  
					<?php if($row->Mother_Status == 'A')
							echo "Alive";
						  else
						  echo "Dead";?>  
				</td>  
				<td>  
					<?php echo $row->Father_Name;?>  
				</td>  
				<td>  
					<?php if($row->Father_Status == 'A')
							echo "Alive";
							else
							echo "Dead";?>  
				</td>  
				<td>  
					<?php if($row->Marital_status == 'S')
							echo "Single";
							else
							echo "Married";?>  
				</td>
				<td>  
					<?php echo $row->Spouse;?>  
				</td>
				<td><a class="btn btn-success w-100 mb-1" href="../nominee/modified.php?nomid=<?php echo $row->customerID;?>" >Nominee</a></td>
				<?php if(isset($_SESSION['admin'])) { ?>
				<td><a class="btn btn-primary w-100 mb-1" href="update.php?editid=<?php echo $row->customerID;?>" >Edit</a>
				<a class="btn btn-danger w-100" href="modified.php?delid=<?php echo $row->customerID;?>" onclick="return confirm('Are You Sure')">Delete</a><?php } ?></td>  
			</tr>  
		<?php } ?>  			
	</tbody>
        </table>
		</div>
		</div>
		<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script> -->
    </body>    
	</html>