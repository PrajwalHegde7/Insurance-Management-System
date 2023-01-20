<?php    
session_start();

if(! (isset($_SESSION['agentID'])||isset($_SESSION['admin']))){
	//user not logged in
	header("location: ../login.php");
    exit;
}

require "../connection.php";

// if($_POST['agentID']){
	// require "input.php"; 
// }

if(isset($_POST['pay'])){
	$pn=$_POST['policyNo'];
	$m=$_POST['mode'];
	$pre=$_POST['premium'];
	$d=date("Y-m-d");
	$r=time()%(100000000000);
	if ($m=='MLY'){
		$ld = date('Y-m-d', strtotime($d. ' + 1 months'));
	}
	else if ($m=='QLY'){
		$ld = date('Y-m-d', strtotime($d. ' + 3 months'));
	}
	else if ($m=='YLY'){
		$ld = date('Y-m-d', strtotime($d. ' +  1 years'));
	}
	$query="update premium set ReceiptNO=$r where policyNo=$pn and ReceiptNO=0";
	mysqli_query($conn,$query) or die($query."Can't Connect to Query...");
	$query2="insert into Premium(policyNo,Premium,Mode,Last_date) values($pn,$pre,'$m','$ld')";
	mysqli_query($conn,$query2) or die($query2."Can't Connect to Query...");
	unset($_POST['pay']);
	$_GET['polno']=$pn;
}

if(isset($_GET['polno'])){
	$pol=$_GET['polno'];
	$sql = "select * from premium where policyNo=$pol";    
	// $sql = "select * from premium where";    
	$result = mysqli_query($conn,$sql);  
	if(mysqli_num_rows($result)<=1){
		$_SESSION['empty']="true";
		header("location: ../policy/modified.php");
		exit;
	}  
	// $sql1 = "select * from unpaid_premium";
	// $result1 = mysqli_query($conn,$sql1);  
}
?>    
<html> 
	<head>
		<title>Premium Data</title>
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
			<li><a href="../policy/modified.php">Back</a></li>    
		</ul>
	</nav>
	<div class="container-fluid" style="padding-top: 12vh;">
	<div class="login" style="width:100%; height:85%; overflow-y: scroll;">
	<h2 class="text-center mb-3">Premium details</h2>
        <table class="table table-bordered border-success table-striped table-hover align-middle">
			<thead class="table-dark align-middle">
				<tr>
					<td>policyNo</td>    
					<td>Premium</td>    
					<td>Mode</td>    
					<td>Receipt Number</td>    
					<td>Receipt Date</td>    
					<td>Last Date</td>    
				</tr>  
			</thead>
			<tbody>

				<?php    
	while($row = mysqli_fetch_object($result)){    
		if($row->ReceiptNo == 0){
			continue;
		}
		?>  
			<tr>  
				<td>  
					<?php echo $row->policyNo;?>  
				</td>  
				<td>  
					<?php echo $row->Premium;?>  
				</td>  
				<td>  
					<?php echo $row->Mode;?>  
				</td>  
				<td>  
					<?php echo $row->ReceiptNo;?>  
				</td>  
				<td>  
					<?php echo $row->ReceiptDate;?>  
				</td>  
				<td>  
					<?php echo $row->Last_date;?>  
				</td>  
			</tr> 
		<?php }?>
	</tbody>
        </table>
	</div>
	</div>
    </body>    
</html>