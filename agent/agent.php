<?php
session_start();
if(isset($_SESSION['duplicate'])){
    echo "<script>alert('Duplicate Entry');</script>";
    unset($_SESSION['duplicate']);
}
?>
<html>    
    <head>    
        <title>Agent Registration</title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
	        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
	    <link rel="stylesheet" href="../css/bootstrap.css">
	    <link rel="stylesheet" href="../style/login.css">
        <!-- <link href = "../css/registration.css" type = "text/css" rel = "stylesheet" />
        <link href = "../css/style.css" type = "text/css" rel = "stylesheet" />  -->
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
        <div class="container pt-5">
            <div class="login mt-4 pt-2">
                <h2 class="text-center pb-2">Agent</h2>    
                <form action='modified.php' method = 'POST' enctype = "multipart/form-data" >    
            <!-- <div class = "container"> -->
				<div class = "form-group">    
                    <!-- <label class="form-label" for="agentID">Agent ID:</label>     -->
                    <input class="form-control font-family-arial" id="agentID" type = "text" name = "agentID" placeholder="Agent ID" required pattern="[0-9]{3}[A-Za-z]{3}[0-9]{3}" aria-describedby="agentID-Hint"/>
                    <p class="fs-6 pt-1 ps-1" style="font-family: 'Lucida Console', 'Courier New', monospace;" id="agentID-Hint">Format: 123ABC123</p>
                </div>
                <div class = "form-group">
                    <!-- <label>Name:</label>     -->
                    <input class="form-control" type = "text" name = "agentName" value = "" placeholder="Name" required />    
                </div>
                <div class = "form-group">    
                    <!-- <label>Date of Birth:</label> -->
                    <input class="form-control" type = "text" name = "DOB" placeholder="Date of Birth" onfocus="this.type='date'" onblur="if(!this.value) this.type='text'" required/>
                </div>
				<div class = "form-group">
                    <!-- <label>Address:</label>     -->
                    <input class="form-control" type = "text" name = "Address" value = "" placeholder="Address" required />    
                </div>
				<div class = "form-group">    
                    <!-- <label>Branch: </label>     -->
                    <input class="form-control" type = "text" name = "Branch" value = "" placeholder="Branch" required />    
                </div>
				<div class = "form-group">    
                    <!-- <label>Contact Number: </label>     -->
                    <input class="form-control" type = "tel" name = "contactNumber" value = "" placeholder="Contact Number" required pattern="[0-9]{10}" />    
                </div>
                <div class = "form-group">    
                    <!-- <label>Password: </label>     -->
                    <input class="form-control" type = "password" name = "password" value = "" placeholder="Password" required />    
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