<?php    
session_start();

//check if user is logged in
if(! (isset($_SESSION['agentID'])||isset($_SESSION['admin']))){
	//user not logged in
	header("location: ../login.php");
    exit;
}

if(isset($_SESSION['empty'])){
    echo "<script>alert('No Premium available');</script>";
    unset($_SESSION['empty']);
}
?>
<html>    
    <head>    
        <title>Payment Form</title>    
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
			<li><a href="../login.php">Back</a></li>    
		</ul>
	</nav>
    <div class = "container">
        <div class="login">
                <h2 class="text-center">Premium</h2>
                <form name = "form1" action='payment.php' method = 'POST' enctype = "multipart/form-data" >    
                    <div class = "form-group">    
                        <!-- <label>Policy Number:</label>     -->
                        <input class="form-control" type = "text" name = "polno" value = "" placeholder="Policy Number" required pattern="[0-9]{9}" />
                        <font size = "2">Enter 9 digit number.</font>
                    </div>
                    <div class = "form-group">    
                        <input class="btn btn-primary w-100" type = "submit" value = "Fetch" name="submit"/>    
                    </div>
				<div class = "form-group">
                    <input class="btn btn-secondary w-100" type = "reset" value = "Reset"/>    
                </div>
            </div>
            
        </form>    
    </div>
    </div>    
    </body>    
</html>    