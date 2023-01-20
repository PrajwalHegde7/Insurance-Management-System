<?php
session_start();
if(isset($_SESSION['agentID'])){
session_unset();
session_destroy();
echo "<script>alert(\"Agent Logout Success\")</script>";
header('location: login.php');
}

if(isset($_SESSION['admin'])){
session_unset();
session_destroy();
echo "<script>alert(\"Admin Logout Success\")</script>";
header('location: admin_login.php');
}
?>