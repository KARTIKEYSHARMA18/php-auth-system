<?php
$errors = [];

$email = $password = "";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $email =trim($_POST['email']) ?? '';
    $password=trim($_POST['password']) ?? '';
    //validation
    if($email === ''){
        $errors['email'] = 'email is req';
        
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "invalid email format";

    }
    if($password===''){
        $errors['password'] = 'password is req.. ';
    }
     $server = "localhost";
    $username = "root";
    $db_password = "";
    if(empty($errors)){
        $con = mysqli_connect($server, $username, $db_password, "signup");
            if(!$con){
                die("connection to this database failed due to." .  mysqli_connect_error());
            }
            $checkuser = "SELECT id, email, password FROM users WHERE email = '$email'";
            $result = mysqli_query($con, $checkuser);
            if(mysqli_num_rows($result)==0){
                //email not found.
                $errors['login'] = 'invalid email or password';
            
            }
            else{
                $user = mysqli_fetch_assoc($result);
                if(!password_verify($password, $user['password'])){
                    $errors['login'] = 'Invalid email or password';
                }
                else{
                    //success->start session
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    header("location: login.php");
                    exit();
                }
            }
            mysqli_close($con);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form </title>
    <link href="style.css" rel = "stylesheet" >
    <link href = "https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel = "stylesheet">
</head>
<body>
    <div class="container">
    <h1>Login</h1>
    <?php if (isset($errors['login'])): ?>
        <p style="color:red"><?= $errors['login'] ?></p>
    <?php endif; ?>
        <form action = "<?=  htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "post">
            <input type = "email" name = "email" value = "<?= htmlspecialchars($email) ?>" placeholder="enter your email..">
            <span style="color:red"><?= $errors['email'] ?? '' ?></span>
            
            <input type = "password" name = "password" placeholder="enter password">
            <span style="color:red"><?= $errors['password'] ?? '' ?></span>
        <button type = "submit">Login</button>
            
            
            

        </form>
    </div>
</body>
</html>