<?php
session_start();
if(! (isset($_GET['editid'])&&isset($_SESSION['admin']))){
    header("location: modified.php");
    exit;
}
require "../connection.php";
$cid=$_GET['editid'];
unset($_GET['editid']);
$sql = "select * from customer where customerID='$cid'";
$result = mysqli_query($conn,$sql); 
if(!$result || mysqli_num_rows($result) <= 0){
    header("location: modified.php");
    exit;
}
$row = mysqli_fetch_object($result)
?>

<html>    
    <head>    
        <title>Client Registration</title>
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
                <li><a href="modified.php">Back</a></li>
            </ul>
        </nav>
        <div class="container" style="width: 500px; height: 100vh">
        <div class="login" style="margin-top: 75px; width: 500px; height: 88vh; overflow-y: scroll;">
		<h2 class="text-center">Customer</h2>    
        <form name = "form1" action='modified.php' method = 'POST' enctype = "multipart/form-data" >    
            <div class = "form-group">
                <!-- <label>First Name:</label>     -->
                <input class="form-control" type = "text" name = "customerID" value = "<?php echo $row->customerID ?>" placeholder="Customer ID" required readonly/>    
            </div>
            <div class = "row">
                <div class = "form-group col">    
                    <!-- <label>First Name:</label>     -->
                    <input class="form-control" type = "text" name = "First_Name" value = "<?php echo $row->First_Name ?>" placeholder="First Name" required/>    
                </div>    
                <div class = "form-group col">    
                    <!-- <label>Middle Name:</label>     -->
                    <input class="form-control" type = "text" name = "Middle_Name" value = "<?php echo $row->Middle_Name ?>" placeholder="Middle Name" />    
                </div>    
                <div class = "form-group col">    
                    <!-- <label>Last Name:</label>     -->
                    <input class="form-control" type = "text" name = "Last_Name" value = "<?php echo $row->Last_Name ?>" placeholder="Last Name" required/>    
                </div>  
            </div>    
				<div class = "form-group row">
                    <div class="col-3">
                        <label class="form-label" for="Gender">Gender :</label>
                    </div>
                        <div class="col-3">
                        <input class="form-check-input" id="male" type = "radio" name = "Gender" value = "M" required <?php if($row->Gender == 'M'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="col">
                        <input class="form-check-input" id="female" type = "radio" name = "Gender" value = "F" required <?php if($row->Gender == 'F'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
				<div class = "form-group">    
                    <!-- <label>Date of Birth:	</label> -->
                    <input class="form-control" type = "text" name = "DOB" value = "<?php echo $row->DOB ?>" placeholder="Date of Birth" onfocus="this.type='date'" onblur="if(!this.value) this.type='text'" required/>
                </div>
				<div class = "form-group">    
                    <!-- <label>Address:</label>     -->
                    <input class="form-control" type = "text" name = "Address" value = "<?php echo $row->Address ?>" placeholder="Address" required/>    
                </div>
				<div class = "form-group">    
                    <!-- <label>Contact Number: </label>     -->
                    <input class="form-control" type = "text" name = "contactNumber" value = "<?php echo $row->contactNumber ?>" placeholder="Contact Number"  required pattern="[0-9]{10}" />    
                </div>
				<div class = "form-group">    
                    <!-- <label>Mother Name: </label>     -->
                    <input class="form-control" type = "text" name = "Mother_Name" value = "<?php echo $row->Mother_Name ?>" placeholder="Mother Name"  required/>    
                </div>
				<div class = "form-group row">
                    <div class="col-5">
                        <label class="form-label">Mother Status:</label>
                    </div>    
                    <div class="col-3">
                        <input class="form-check-input" id="Malive" type = "radio" name = "Mother_Status" value = "A" required <?php if($row->Mother_Status == 'A'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="Malive">Alive</label>
                    </div>    
                    <div class="col">
                        <input class="form-check-input" id="Mdead" type = "radio" name = "Mother_Status" value = "D" required <?php if($row->Mother_Status == 'D'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="Mdead">Dead</label>
                    </div>    
                </div>
				<div class = "form-group">    
                    <!-- <label>Father Name: </label>     -->
                    <input class="form-control" type = "text" name = "Father_Name" value = "<?php echo $row->Father_Name ?>" placeholder="Father Name"  required/>    
                </div>
				<div class = "form-group row">
                    <div class="col-5">
                        <label class="form-label">Father Status:</label>
                    </div>
                    <div class="col-3">
                        <input class="form-check-input" id="Falive" type = "radio" name = "Father_Status" value = "A" required <?php if($row->Father_Status == 'A'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="Falive">Alive</label>
                    </div>
                    <div class="col">
                        <input class="form-check-input" id="Fdead" type = "radio" name = "Father_Status" value = "D" required <?php if($row->Father_Status == 'D'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="Fdead">Dead</label>
                    </div>
                </div>
				<div class = "form-group row">
                    <div class="col-5">
                        <label class="form-label">Marital Status:</label>    
                    </div>
                    <div class="col-3">
                        <input class="form-check-input" id="single" type = "radio" name = "Marital_Status" value = "S" required <?php if($row->Marital_status == 'S'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="single">Single</label>
                    </div>
                    <div class="col">
                        <input class="form-check-input" id="married" type = "radio" name = "Marital_Status" value = "M" required <?php if($row->Marital_status == 'M'){ echo "checked"; }?>/>
                        <label class="form-check-label" for="married">Married</label>
                    </div>
                </div>
				<div class = "form-group">
                    <!-- <label>Spouse Name: </label>     -->
                    <input class="form-control" type = "text" name = "Spouse" value = "<?php echo $row->Spouse ?>" placeholder="Spouse Name"  />    
                </div>
				<div class = "form-group">
                    <input class="btn btn-primary w-100" type = "submit" name="update" value = "Update"/>    
                </div>
				<div class = "form-group">    
                    <input class="btn btn-secondary w-100" type = "reset" value = "reset"/>    
                </div>
        </form>    
        </div>
        </div>
    </body>    
</html>    