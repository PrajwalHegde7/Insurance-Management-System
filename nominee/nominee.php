<?php
session_start();
if(! (isset($_SESSION['agentID'])||isset($_SESSION['admin']))){
    header("location: ../login.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nominee</title>
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
                <li><a href="../index.php">Back</a></li>
            </ul>
        </nav>
        <div class="container" style="width: 500px; height: 100vh">
        <div class="login" style="margin-top: 75px; width: 500px; height: 88vh;">
		<h2 class="text-center">Nominee</h2>    
        <form name = "form1" action='modified.php' method = 'POST' enctype = "multipart/form-data" >
        <div class = "form-group">    
                    <!-- <label>Customer Number:</label>     -->
                    <!-- <input class="form-control" list="cust">  -->
                    <select class="form-control" name = "customerID" required>
                        <option value="">Select Customer</option>
                        <!-- <datalist id="cust"> -->
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
                        <!-- </datalist> -->
						</select>
                </div>    
            <div class = "row">
                <div class = "form-group col">    
                    <!-- <label>First Name:</label>     -->
                    <input class="form-control" type = "text" name = "First_Name" value = "" placeholder="First Name" required/>    
                </div>    
                <div class = "form-group col">    
                    <!-- <label>Middle Name:</label>     -->
                    <input class="form-control" type = "text" name = "Middle_Name" value = "" placeholder="Middle Name" />    
                </div>    
                <div class = "form-group col">    
                    <!-- <label>Last Name:</label>     -->
                    <input class="form-control" type = "text" name = "Last_Name" value = "" placeholder="Last Name" required/>    
                </div>  
            </div>    
				<div class = "form-group row">
                    <div class="col-3">
                        <label class="form-label" for="Gender">Gender :</label>
                    </div>
                        <div class="col-3">
                        <input class="form-check-input" id="male" type = "radio" name = "Gender" value = "M" required/>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="col">
                        <input class="form-check-input" id="female" type = "radio" name = "Gender" value = "F" required/>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
                <div class = "form-group">    
                    <!-- <label>Address:</label>     -->
                    <input class="form-control" type = "text" name = "Relation" value = "" placeholder="Relation" required/>    
                </div>
				<div class = "form-group">    
                    <!-- <label>Date of Birth:	</label> -->
                    <input class="form-control" type = "text" name = "DOB" value = "" placeholder="Date of Birth" onfocus="this.type='date'" onblur="if(!this.value) this.type='text'" required/>
                </div>
				<div class = "form-group">    
                    <!-- <label>Address:</label>     -->
                    <input class="form-control" type = "text" name = "Address" value = "" placeholder="Address" required/>    
                </div>
				<div class = "form-group">    
                    <!-- <label>Contact Number: </label>     -->
                    <input class="form-control" type = "text" name = "contactNumber" value = "" placeholder="Contact Number"  required pattern="[0-9]{10}" />    
                </div>
				<div class = "form-group">    
                    <input class="btn btn-primary w-100" type = "submit" name="submit" value = "Submit"/>    
                </div>
				<div class = "form-group">
                    <input class="btn btn-secondary w-100" type = "reset" value = "Reset"/>    
                </div>        
            <!-- </div>     -->
        </form>    
    </div>
    </div>
</body>
</html>