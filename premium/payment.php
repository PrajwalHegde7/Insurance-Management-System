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
    $pol=$_POST['polno'];
    // $sql="select * from policydata PD,premium P where P.policyNo=PD.policyNo and PD.policyNo=$pol";
    $sql="CALL pay_policy($pol)";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==0){
        $_SESSION['empty']="true";
        header("location: premium.php");
        exit;
    }
}else{
    header("location: premium.php");
    exit;
}
$row=mysqli_fetch_object($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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
			<li><a href="premium.php">Back</a></li>    
		</ul>
	</nav>
    <div class = "container" style="width: 500px; height: 100vh">
        <div class="login" style="margin-top: 75px; width: 500px; height: 88vh; overflow-y: scroll;">
                <h2 class="text-center">Payment</h2>
                <form name = "form1" action='modified.php' method = 'POST' enctype = "multipart/form-data" >    
            <!-- <div class = "container"> -->
				<div class = "form-group">    
                    <label>Policy Number:</label>    
                    <input class="form-control" type = "text" name = "policyNo" value = "<?php echo $row->policyNo; ?>" placeholder="Policy Number" required pattern="[0-9]{9}"readonly/>    
                </div>
                <div class = "form-group">    
                    <label>Customer Number:</label>    
                    <select class="form-control" name = "customerID" disabled>
						<option value = "<?php echo $row->customerID?>"><?php echo $row->customerID?></option>
						</select>
                </div>    
                <?php if(isset($_SESSION['admin']))
                {?>
                    <div class = "form-group">    
                    <label>Agent Code:</label>    
                    <select class="form-control" name = "agentID" disabled>
						<option value = "<?php echo $row->agentID?>"><?php echo $row->agentID?></option>
					</select>
                </div>  <?php }?>
				<div class = "form-group">    
					<label>Scheme:</label>    
                    <select class="form-control" name = "schemeID" disabled>
						<option value = "<?php echo $row->schemeID?>"><?php echo $row->schemeID?></option>
					</select>
                </div>
				<div class = "form-group">    
					<label>Date of Commence:</label>    
					<input class="form-control" type = "date" name = "DOC" value = "<?php echo $row->DOC ?>" placeholder="Date of Commencement" required readonly/>    
				</div>  
				<div class = "form-group">    
                    <label>Sum Assured: </label>    
                    <input class="form-control" type = "text" name = "Sum_assured" value = "<?php echo $row->Sum_Assured ?>" placeholder="Sum Assured"  required readonly/>    
                </div>
				<div class = "form-group">    
                    <label>Payment Period: </label>    
                    <input class="form-control" type = "text" name = "Payment_period" value = "<?php echo $row->Pay_Period ?>" placeholder="Payment Period"  required readonly/>    
                </div>
				<div class = "form-group">    
                    <label>Insurance Period: </label>    
                    <input class="form-control" type = "text" name = "Ins_period" value = "<?php echo $row->Ins_Period ?>" placeholder="Insurance Period"  required readonly/>    
                </div>
				<div class = "form-group">    
                    <label class="form-label">Premium mode: </label><br>
                    <input class="form-check-input" id="mly" type = "radio" name = "mode" value = "MLY" required <?php if($row->Mode == 'MLY'){ echo "checked"; }else{echo "onclick='return false;'";}?>/>
					<label class="form-check-label" for="mly">Monthly</label>
					<input class="form-check-input" id="yly" type = "radio" name = "mode" value = "YLY" required <?php if($row->Mode == 'YLY'){ echo "checked"; }else{echo "onclick='return false;'";}?>/>
					<label class="form-check-label" for="yly">Yearly</label>
					<input class="form-check-input" id="qly" type = "radio" name = "mode" value = "QLY" required <?php if($row->Mode == 'QLY'){ echo "checked"; }else{echo "onclick='return false;'";}?>/>
					<label class="form-check-label" for="qly">Quarterly</label>
					<input class="form-check-input" id="sss" type = "radio" name = "mode" value = "SSS" required <?php if($row->Mode == 'SSS'){ echo "checked"; }else{echo "onclick='return false;'";}?>/>
					<label class="form-check-label" for="sss">Single</label>
				</div>
                <div class = "form-group">    
                    <label>Premium: </label>    
                    <input class="form-control" type = "text" name = "premium" value = "<?php echo $row->Premium ?>" placeholder="Premium"  required readonly/>    
                </div>
                <!-- <label>Insurance Period: </label>     -->
                <!-- <div class = "form-group">    
                    <input class="form-control" type = "text" name = "Receipt" value = "" placeholder="Receipt Number"  required/>    
                </div> -->
				<div class = "form-group">    
                    <input class="btn btn-primary w-100" type = "submit" name="pay" value = "Mark Paid"/>    
                </div>
</div>
</div>
</body>
</html>