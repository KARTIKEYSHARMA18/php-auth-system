<?php

$errors = [];
$insert = false;
$name = $email = $password = $confirm_password = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = trim($_POST['name']);

    $email = trim($_POST['email']);
    $password = $_POST['password'] ?? '';
    $confirm_password= $_POST['confirm_password'] ?? '';
    if($name === ''){
        $errors['name'] = 'name is req';
    }
    if($email === ''){
        $errors['email']  = 'email is req.';
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "invalid email format";
    }
     if($password===''){
        $errors['password'] = "password is req.";
    }
    else if(strlen($password)<6){
        $errors['password'] = "password must be at least 6 characters";
    }
    if($confirm_password === ""){
        $errors['confirm_password'] = "confirm your password";

    }
    else if($password!== $confirm_password){
        $errors['confirm_password'] = "password do not match";
    }
  
    if(empty($errors)){
        require_once __DIR__ . '/../db.php';
        $checkemail = "SELECT id FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $checkemail);
        if(mysqli_num_rows($result)>0){
            $errors['email'] = 'Email already registered';
        }
        if (empty($errors)) {
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, password) 
            VALUES ('$name', '$email', '$hashedpassword')";
            if(mysqli_query($con, $sql)){
                header("Location: signup.php?success=1");
                exit;


            }
            else{
                $errors['form'] = 'something went wrong. try again';
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
    <title>Signup form</title>
    <link href="../style.css" rel = "stylesheet" >
    <link href = "https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel = "stylesheet">

</head>
<body>
    <div class="container">
        <h1>Signup form</h1>

        <?php if (isset($_GET['success'])): ?>
        <p style="color: green;">Signup successful. You can now log in.</p>
        <?php endif; ?>
        <form action = "<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method = "post">
            <input type = "text" name = "name" value = "<?= htmlspecialchars($name) ?>" placeholder="enter your name...">
            <span style="color:red"><?= $errors['name'] ?? '' ?></span>
            <input type = "email" name = "email" value = "<?= htmlspecialchars($email) ?>" placeholder="Enter your email...">
            <span style="color:red"><?= $errors['email'] ?? '' ?></span>
            <input type = "password" name = "password" placeholder="enter password">
            <span style="color:red"><?= $errors['password'] ?? '' ?></span>
            <input type = "password" name = "confirm_password" placeholder="confirm password">
            <span style="color:red"><?= $errors['confirm_password'] ?? '' ?></span>
            <button type = "submit" class="btn">Submit</button>
            
        </form>
    </div>
</body>
</html>