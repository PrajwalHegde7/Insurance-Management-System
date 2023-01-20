<?php
session_start();
if(! (isset($_SESSION['agentID'])||isset($_SESSION['admin']))){
    header("location: ../login.php");
	exit;
}
if(isset($_SESSION['duplicate'])){
    echo "<script>alert('Duplicate Entry')</script>";
    unset($_SESSION['duplicate']);
}
?>
<html>    
		<head>    
        <title>Registration Form</title>
		<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
			<link rel="stylesheet" href="../css/bootstrap.css">
	    <link rel="stylesheet" href="../style/login.css">	    
		<!-- <link href = "../css/registration.css" type = "text/css" rel = "stylesheet" />    
		<link href = "../css/style.css" type = "text/css" rel = "stylesheet" /> 	 -->
    </head>    
    <body>
	<nav>
            <div class="logo">
            <p>Insurance Management System</p>
            </div>
            <ul>
                <li><a href="../index.php">Back</a></li>
            </ul>
        </nav>
		<div class="container" style="width: 500px; height: 100vh">
        <div class="login" style="margin-top: 75px; width: 500px; height: 88vh; overflow-y: scroll;">
		<h2 class="text-center">Policy</h2>
        <form name = "form1" action='modified.php' method = 'POST' enctype = "multipart/form-data" >    
            <!-- <div class = "container"> -->
				<div class = "form-group">    
                    <!-- <label>Policy Number:</label>     -->
                    <input class="form-control" type = "text" name = "policyNo" value = "" placeholder="Policy Number" required pattern="[0-9]{9}"/>    
					<font size = "2">Enter 9 digit number.</font>
                </div>
                <div class = "form-group">    
                    <!-- <label>Customer Number:</label>     -->
                    <select class="form-control" name = "customerID" required>
						<option value="">Select Customer</option>
					<?php 
						require "../connection.php";
						$sql="select * from customer";
						$result = mysqli_query($conn,$sql);
						$i=0;
						while($row=mysqli_fetch_object($result)){
							$i++;
					?>
						<option value = "<?php echo $row->customerID?>"><?php echo $row->customerID.' - '.$row->First_Name.' '.$row->Middle_Name.' '.$row->Last_Name?></option>
						<?php } ?>
						</select>
                </div>    
                <?php if(isset($_SESSION['admin']))
                {?>
                    <div class = "form-group">    
                    <!-- <label>Agent Code:</label>     -->
                    <select class="form-control" name = "agentID" required>
						<option value="">Select Agent</option>
					<?php 
						require "../connection.php";
						$sql="select * from agent";
						$result = mysqli_query($conn,$sql);
						$i=0;
						while($row=mysqli_fetch_object($result)){
							$i++;
					?>
						<option value = "<?php echo $row->agentID?>"><?php echo $row->agentID.' - '.$row->agentName?></option>
						<?php } ?>
					</select>
                </div>  <?php }?>
				<div class = "form-group">    
					<!-- <label>Scheme:</label>     -->
                    <select class="form-control" name = "schemeID" required>
						<option value="">Select Scheme</option>
						<?php 
						require "../connection.php";
						$sql="select * from Scheme";
						$result = mysqli_query($conn,$sql);
						$i=0;
						while($row=mysqli_fetch_object($result)){
							$i++;
							?>
						<option value = "<?php echo $row->schemeID?>"><?php echo $row->schemeID.' - '.$row->Name?></option>
						<?php } ?>
					</select>
                </div>
				<!-- <div class = "form-group">    
					<label>Date of Commence:</label>    
					<input class="form-control" type = "text" name = "DOC" value = "" placeholder="Date of Commencement" required />    
				</div>   -->
				<div class = "form-group">    
                    <!-- <label>Sum Assured: </label>     -->
                    <input class="form-control" type = "text" name = "Sum_assured" value = "" placeholder="Sum Assured"  required />    
                </div>
				<div class = "form-group">    
                    <!-- <label>Payment Period: </label>     -->
                    <input class="form-control" type = "text" name = "Payment_period" value = "" placeholder="Payment Period"  required />    
                </div>
				<div class = "form-group">    
                    <!-- <label>Insurance Period: </label>     -->
                    <input class="form-control" type = "text" name = "Ins_period" value = "" placeholder="Insurance Period"  required />    
                </div>
				<div class = "form-group">    
                    <label class="form-label">Premium mode: </label><br>
                    <input class="form-check-input" id="mly" type = "radio" name = "mode" value = "MLY" required />
					<label class="form-check-label" for="mly">Monthly</label>
					<input class="form-check-input" id="yly" type = "radio" name = "mode" value = "YLY" required />
					<label class="form-check-label" for="yly">Yearly</label>
					<input class="form-check-input" id="qly" type = "radio" name = "mode" value = "QLY" required />
					<label class="form-check-label" for="qly">Quarterly</label>
					<input class="form-check-input" id="sss" type = "radio" name = "mode" value = "SSS" required />
					<label class="form-check-label" for="sss">Single</label>
				</div>
				<div class = "form-group">    
                    <input class="btn btn-primary w-100" type = "submit" name="submit" value = "Submit"/>    
                </div>
				<div class = "form-group">    
                    <input class="btn btn-secondary w-100" type = "reset" value = "Reset"/>    
                </div>
				
            </div>    
        </form>    
    </body>    
</html>    