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
    $cid=$_POST['customerID'];
    $fn=$_POST['First_Name'];
	$mn=$_POST['Middle_Name'];
	$ln=$_POST['Last_Name'];
    $r=$_POST['Relation'];
	$d=$_POST['DOB'];
	$g=$_POST['Gender'];
	$a=$_POST['Address'];
	$con=$_POST['contactNumber'];
    $query="insert into nominee(customerID,Fname,Mname,Lname,Gender,Relation,DOB,Address,ContactNo) values($cid,'$fn','$mn','$ln','$g','$r','$d','$a',$con)";
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	unset($_POST['submit']);
}

if(isset($_POST['update'])){
    $nid=$_POST['nomineeID'];
    $cid=$_POST['customerID'];
    $fn=$_POST['First_Name'];
	$mn=$_POST['Middle_Name'];
	$ln=$_POST['Last_Name'];
    $r=$_POST['Relation'];
	$d=$_POST['DOB'];
	$g=$_POST['Gender'];
	$a=$_POST['Address'];
	$con=$_POST['contactNumber'];
    $query="update nominee set Fname='$fn',Mname='$mn',Lname='$ln',Gender='$g',Relation='$r',DOB='$d',Address='$a', ContactNo=$con where customerID=$cid and nomineeID=$nid";
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	unset($_POST['update']);
    $_GET['nomid']=$cid;
}
if(isset($_GET['delid'])){
	if(is_numeric($_GET['delid'])){    
		$sql = "delete from nominee where nomineeID = '".$_GET['delid']."'";    
		$result = mysqli_query($conn,$sql);    
	}
}
if(isset($_GET['nomid'])){
    $cid=$_GET['nomid'];
    $sql = "select * from nominee where customerID=$cid";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) == 0){
        $_SESSION['empty']="true";
        header("location: ../client/modified.php");
        exit;
    }
}else{
    header("location: ../client/modified.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nominee Data</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
<nav>
		<div class="logo">
			<p>Insurance Management System</p>
		</div>
		<ul>
			<li><a href="../client/modified.php">Back</a></li>    
		</ul>
	</nav>
    <div class="container-fluid" style="padding-top: 12vh;">
	<div class="login" style="width:100%; height:85%; overflow-y: scroll;">
		<h2 class="text-center mb-3">Nominee Data</h2>
		<table class="table table-bordered border-success table-striped table-hover align-middle">
			<!-- <table id="example" class="table table-striped" style="width:100%;"></table> -->
			<thead class="table-dark align-middle">
				<tr>
					<td>First Name</td>
					<td>Middle Name</td>
					<td>Last Name</td>
					<td>Gender</td>
                    <td>Relation</td>
					<td>DOB</td>
					<td>Address</td>
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
					<?php echo $row->Fname;?>  
				</td>  
				<td>  
					<?php echo $row->Mname;?>  
				</td>  
				<td>  
					<?php echo $row->Lname;?>  
				</td>  
                <td>  
                    <?php echo $row->Gender;?>  
                </td>  
                <td>  
                    <?php echo $row->Relation;?>  
                </td>  
				<td>  
					<?php echo $row->DOB;?>  
				</td>  
				<td>  
					<?php echo $row->Address;?>  
				</td>  
				<td> 
					<?php echo $row->ContactNo;?>  
				</td>
                <?php if(isset($_SESSION['admin'])) { ?>
				<td><a class="btn btn-primary w-100 mb-1" href="update.php?editid=<?php echo $row->nomineeID;?>" >Edit</a>
				<a class="btn btn-danger w-100" href="modified.php?delid=<?php echo $row->nomineeID;?>" onclick="return confirm('Are You Sure')">Delete</a></td><?php } ?>  
			</tr>  
			<?php } ?>  			
	</tbody>
        </table>
		</div>
		</div>

</body>
</html>