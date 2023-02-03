<?php    
session_start();
if(! (isset($_SESSION['agentID'])||isset($_SESSION['admin']))){
    header("location: ../login.php");
	exit;
}

// require "input.php";   
require "../connection.php";

if(isset($_POST['submit'])){
	$pn=$_POST['policyNo'];
	// $sql = "select * from policydata where agentID='$pn'";
	if(mysqli_num_rows(mysqli_query($conn,"select * from policydata where agentID='$pn'")) == 0){
	$cn=$_POST['customerID'];
	if(isset($_SESSION['agentID'])){
		$ac=$_SESSION['agentID'];
	} else{
		$ac=$_POST['agentID'];
	}
	$d=date('Y-m-d');
	$p=$_POST['schemeID'];
	$sa=$_POST['Sum_assured'];
	$pp=$_POST['Payment_period'];
	$ip=$_POST['Ins_period'];
	$mode=$_POST['mode'];
	if ($mode=='MLY'){
		$pre = $sa/($ip*12);
		$ld = date('Y-m-d', strtotime($d. ' + 1 months'));
	}
	else if ($mode=='QLY'){
		$pre = $sa/($ip*4);
		$ld = date('Y-m-d', strtotime($d. ' + 3 months'));	
	}
	else if ($mode=='YLY'){
		$pre = $sa/($ip);
		$ld = date('Y-m-d', strtotime($d. ' +  1 years'));
	}
	else if ($mode=='SSS'){
		$pre = $sa;
		$ld = $d;
	}
	
	$query="insert into PolicyData(policyNo,customerID,agentID,schemeID,Sum_Assured,Pay_Period,Ins_Period) values($pn,$cn,'$ac',$p,$sa,$pp,$ip)";
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	$query2="insert into Premium(policyNo,Premium,Mode,Last_date) values($pn,$pre,'$mode','$ld')";
	mysqli_query($conn,$query2) or die($query2."Can't Connect to Query...");
	unset($_POST['submit']);
}else{
	$_SESSION['duplicate'] = "true";
	unset($_POST['submit']);
	header("location: policy.php");
	exit;
}
}

if(isset($_POST['update'])&&isset($_SESSION['admin'])){
	$pn=$_POST['policyNo'];
	$cn=$_POST['customerID'];
	$ac=$_POST['agentID'];
	$d=$_POST['DOC'];
	$p=$_POST['schemeID'];
	$sa=$_POST['Sum_assured'];
	$pp=$_POST['Payment_period'];
	$ip=$_POST['Ins_period'];
	$mode=$_POST['mode'];
	if ($mode=='MLY'){
		$pre = $sa/($ip*12);
		$ld = date('Y-m-d', strtotime($d. ' + 1 months'));
	}
	else if ($mode=='QLY'){
		$pre = $sa/($ip*4);
		$ld = date('Y-m-d', strtotime($d. ' + 3 months'));	
	}
	else if ($mode=='YLY'){
		$pre = $sa/($ip);
		$ld = date('Y-m-d', strtotime($d. ' +  1 years'));
	}
	else if ($mode=='SSS'){
		$pre = $sa;
		$ld = $d;
	}
	
	$query="update PolicyData set Sum_Assured=$sa,Pay_Period=$pp,Ins_Period=$ip where policyNo=$pn";
	// customerID=$cn,agentID='$ac',schemeID=$p,
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	$query2="update Premium set Premium=$pre,Mode='$mode',Last_date='$ld' where policyNo=$pn";
	mysqli_query($conn,$query2) or die($query2."Can't Connect to Query...");
	unset($_POST['update']);
}

if(isset($_SESSION['empty'])){
	echo "<script>alert('No premium data available');</script>";
	unset($_SESSION['empty']);
}

if(isset($_GET['delpol'])){
	if(is_numeric($_GET['delpol'])){
		$pol=$_GET['delpol'];
		unset($_GET['delpol']);
		$sql = "delete from policydata where policyNo =$pol";    
		$result = mysqli_query($conn,$sql);    
	}    
}
if(isset($_SESSION['agentID'])){
	$aid=$_SESSION['agentID'];
	$sql = "select * from policydata where agentID='$aid'";
}else{
	$sql = "select * from policydata";
}
$result = mysqli_query($conn,$sql);
?>    
<html>   
	<head>
	<title>Policy Data</title>
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
			<link rel="stylesheet" href="../css/bootstrap.css">
	    <link rel="stylesheet" href="../style/login.css">
		<!-- <link href = "../css/style.css" type = "text/css" rel = "stylesheet" />    
		<link href = "../css/registration.css" type = "text/css" rel = "stylesheet" /> -->
	</head>
    <body>
	<nav>
            <div class="logo">
            <p>Insurance Management System</p>
            </div>
            <ul>
			<?php if(isset($_SESSION['agentID'])){
			echo '<li><a href="../index.php">Back</a></li>';
        } else{
            echo '<li><a href="../admin.php">Back</a></li>';
        }?>
            </ul>
        </nav>
		<div class="container-fluid" style="padding-top: 12vh;">
	<div class="login" style="width:100%; height:85%; overflow-y: scroll;">
		<h2 class="text-center mb-3">Policy Data</h2>   
	   <table class="table table-bordered border-success table-striped table-hover align-middle">
	   <thead class="table-dark align-middle">
            <tr>    
                <td>Policy Number</td>    
                <td>Customer ID</td>    
                <td>Agent ID</td>    
                <td>scheme ID</td>    
                <td>DOC</td>    
                <td>Sum Assured</td>    
                <td>Payment Period</td>    
                <td>Installmet period</td>    
				<td>Premium Data</td>
                <td>Action</td>    
            </tr>  
			<tbody>
	<?php    
    
		while($row = mysqli_fetch_object($result)){    
    
    
	?>  
			<tr>  
				<td>  
					<?php echo $row->policyNo;?>  
				</td>  
				<td>  
					<?php echo $row->customerID;?>  
				</td>  
				<td>  
					<?php echo $row->agentID;?>  
				</td>  
				<td>  
					<?php echo $row->schemeID;?>  
				</td>  
				<td>  
					<?php echo $row->DOC;?>  
				</td>  
				<td>  
					<?php echo $row->Sum_Assured;?>  
				</td>  
				<td>  
					<?php echo $row->Pay_Period;?>  
				</td>  
				<td>  
					<?php echo $row->Ins_Period;?>  
				</td>
				<td>  
					<a class="btn btn-success w-100" href="../premium/modified.php?polno=<?php echo $row->policyNo;?>">Premium</a>
				</td>
				<?php if(isset($_SESSION['admin'])) { ?>
				<td><a class="btn btn-primary w-100 mb-1" href="update.php?editpol=<?php echo $row->policyNo;?>">Edit</a>
				<a class="btn btn-danger w-100" href="modified.php?delpol=<?php echo $row->policyNo;?>" onclick="return confirm('Are You Sure')">Delete</a></td>
				<?php } ?>
			</tr>  
		<?php } ?>  			
		</tbody>
        </table>   		
    </body>    
</html>