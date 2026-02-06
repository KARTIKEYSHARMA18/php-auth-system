<?php
session_start();
//auth guard
if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit;
}
    require_once __DIR__ . '/db.php';

    //fetch loggedin user data
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT name, email FROM users WHERE id = '$user_id'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result)==0){
        session_destroy();
        header("Location: auth/login.php");
        exit;
    }
    $user = mysqli_fetch_assoc($result);
    mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel= "stylesheet" href = "style.css">
</head>
<body>
    <div class=" container">
        <h1>welcome, <?= htmlspecialchars($user['name'])?></h1>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email'])?></p>
        <br>
        <a href = "logout.php">Logout</a>
    </div>
    
</body>
</html>