<?php
session_start();

if(! (isset($_SESSION['admin']) || isset($_SESSION['agentID']))){
    header("location: ../login.php");
	exit;
}

require "../connection.php";

if(! isset($_SESSION['admin'])){
    if(isset($_POST['submit'])){
        $sid=$_POST['schemeID'];
        $an=$_POST['name'];
        $m=$_POST['maxAge'];
        $a=$_POST['minAmnt'];
        $query="insert into scheme(schemeID,Name,MaxAge, MinAmount) values('$sid','$an',$m,$a)";
        mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
        unset($_POST['submit']);
    }
    
    if(isset($_POST['update'])){
        $sid=$_POST['schemeID'];
        $an=$_POST['name'];
        $m=$_POST['maxAge'];
        $a=$_POST['minAmnt'];
        $query="update scheme set Name='$an',MaxAge=$m, MinAmount=$a where schemeID='$sid'";
        mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
        unset($_POST['update']);
    }

    if(isset($_GET['delid'])){
        if(is_numeric($_GET['delid'])){    
            $sql = "delete from customer where customerID = '".$_GET['delid']."'";    
            $result = mysqli_query($conn,$sql);    
        }
    }
}
    
$sql = "select * from scheme";
$result = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheme Data</title>
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
			<li><a href="../login.php">Back</a></li>    
		</ul>
	</nav>
<div class="container-fluid" style="padding-top: 12vh;">
	<div class="login" style="width:100%; height:85%; overflow-y: scroll;">
		<h2 class="text-center mb-3">Customer Data</h2>
		<table class="table table-bordered border-success table-striped table-hover align-middle">    
			<thead class="table-dark align-middle">
				<tr>    
					<td>Scheme ID</td>    
					<td>Scheme Name</td>    
					<td>Maximum Age</td>    
					<td>Minimum Amount</td>
					<td>Action</td>
				</tr>  
			</thead>
			<tbody>

				<?php    
    
		while($row = mysqli_fetch_object($result)){    
			
    
	?>  
			<tr>  
				<td>  
					<?php echo $row->schemeID;?>  
				</td>  
				<td>  
					<?php echo $row->Name;?>  
				</td>  
				<td>  
					<?php echo $row->MaxAge;?>  
				</td>  
				<td>  
					<?php echo $row->MinAmount;?>  
				</td>
				<td><?php if(isset($_SESSION['admin'])) { ?>
                    <a class="btn btn-primary w-100 mb-1" href="update.php?editid=<?php echo $row->schemeID;?>">Edit</a>
				<a class="btn btn-danger w-100" href="modified.php?delid=<?php echo $row->schemeID;?>" onclick="return confirm('Are You Sure')">Delete</a><?php } ?></td>
			</tr>  
		<?php } ?>  			
	</tbody>
        </table>
</body>
</html>