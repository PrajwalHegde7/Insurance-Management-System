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
        <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" /> -->
        <link rel="stylesheet" href="../fontawesome-free-6.2.1-web/css/all.css">
        <!-- <link href = "../css/registration.css" type = "text/css" rel = "stylesheet" />
        <link href = "../css/style.css" type = "text/css" rel = "stylesheet" />  -->
        <!-- <style>
            #pswd_info {
	background: #dfdfdf none repeat scroll 0 0;
	color: #fff;
	left: 20px;
	position: absolute;
	top: 115px;
}
#pswd_info h4{
    background: black none repeat scroll 0 0;
    display: block;
    font-size: 14px;
    letter-spacing: 0;
    padding: 17px 0;
    text-align: center;
    text-transform: uppercase;
}
#pswd_info ul {
    list-style: outside none none;
}
#pswd_info ul li {
   padding: 10px 45px;
}
#pswd_info::before {
    background: #dfdfdf none repeat scroll 0 0;
    content: "";
    height: 25px;
    left: -13px;
    margin-top: -12.5px;
    position: absolute;
    top: 50%;
    transform: rotate(45deg);
    width: 25px;
}
#pswd_info {
    display:none;
}
        </style> -->
    </head>    
    <body>
        <nav>
            <div class="logo">
                <p>Insurance Management System</p>
            </div>
            <ul>
            <?php if(isset($_SESSION['admin'])){
                echo '<li><a href="../admin.php">Back</a></li>';
            } else{
                echo '<li><a href="../login.php">Back</a></li>';
        }?>
            </ul>
        </nav>
        <div class="container pt-5">
            <div class="login mt-4 pt-2">
                <h2 class="text-center pb-2">Agent</h2>    
                <form action='modified.php' method = 'POST' enctype = "multipart/form-data">    
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
                <div class = "form-group input-group">    
                    <!-- <label>Password: </label>     -->
                    <input class="form-control" type = "password" name = "password" id="password" value = "" placeholder="Password" pattern=".{8,}" required /> <!-- ^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\d a-zA-Z]).{8,}$ -->
                    <span class="input-group-text" onclick="password_show_hide();"><i class="fas fa-eye" id="show_eye"></i><i class="fas fa-eye-slash d-none" id="hide_eye"></i></span>
                    <!-- <small id="passwordHelpBlock" class="form-text text-muted fs-6">Password must be 8 or more characters.<br>Should contain upper and lower letters, numbers, special characters.</small> -->
                </div>
				<div class = "form-group">    
                    <input class="btn btn-primary w-100" type = "submit" name="submit" value = "Submit"/>    
                </div>
				<div class = "form-group">
                    <input class="btn btn-secondary w-100" type = "reset" value = "Reset"/>    
                </div>   

			<!-- <div class="aro-pswd_info">
				<div id="pswd_info">
					<h4>Password must be requirements</h4>
					<ul>
						<li id="letter" class="invalid">At least <strong>one letter</strong></li>
						<li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
						<li id="number" class="invalid">At least <strong>one number</strong></li>
						<li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
						<li id="space" class="invalid">be<strong> use [~,!,@,#,$,%,^,&,*,-,=,.,;,']</strong></li>
					</ul>
				</div>
		</div>      -->
            <!-- </div>     -->
        </form>    
    </div>
    </div>
    <script>
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        };

        // $(document).ready(function(){
        //     $('input[type=password]').focus(function() {
        //         $('#pswd_info').show();
        //     }).blur(function() {
        //         $('#pswd_info').hide();
        //     });
        // });
    </script>
    </body>    
</html>    