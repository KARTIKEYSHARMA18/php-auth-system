<?php 
$con = mysqli_connect("localhost", "root", "", "signup");
if(!$con){
    die("db connection failed: " .mysqli_connect_error());
}



// it best to not close php tag in pure php files.
// prevents stray whitespace
// Avoids “headers already sent” bugs