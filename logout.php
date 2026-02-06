<?php session_start();
session_unset();//remove all session variables
session_destroy();//destroy
header("location: auth/login.php");
exit;