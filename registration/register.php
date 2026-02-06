<?php

$errors=[];
$insert = false;
$name = $email = $user_password = $confirm_password="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = trim($_POST['name']);
    $email = trim($_POST['email'] ?? '');
    $user_password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password']?? '';
    //validation
    if($name ===''){
        $errors['name'] = 'name is required.' ;
    }
   
    if ($email === "") {
        $errors['email'] = "Email is required";
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "invalid email format";
    }

    if($user_password===''){
        $errors['password'] = "password is req.";
    }
    else if(strlen($user_password)<6){
        $errors['password'] = "password must be at least 6 characters";
    }
    if($confirm_password === ""){
        $errors['confirm_password'] = "confirm your password";

    }
    else if($user_password!== $confirm_password){
        $errors['confirm_password'] = "password do not match";
    }

 
    if(empty($errors)){
        require_once __DIR__ . '/../db.php';

       
        $hashedPassword= password_hash($user_password, PASSWORD_DEFAULT);
       $sql = "INSERT INTO users (name, email, password, created_at)
        VALUES ('$name', '$email', '$hashedPassword', NOW())";

        if(mysqli_query($con, $sql)==true){
            header("Location: register.php?success=1");
            exit;
 

        }
        else{
             $errors['form'] = 'Something went wrong. Please try again.';
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
    <title>register form</title>
    <link href = "https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel = "stylesheet">
    <link rel = "stylesheet" href="../style.css">

</head>
<body>
        <img class = "bg" src = "download.jpg" alt = "RKGIT">
        <div class="container">
        <h1>Register</h1>
<p>Create an account to register for the event.</p>

      <?php if(isset($_GET['success'])): ?>
  <p style="color: green; font-size: 18px;">
   
    Success! Your details have been submitted.
  </p>
<?php endif; ?>

        <form action ="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"  method="post">
          <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Enter your name">
<span style="color:red"><?= $errors['name'] ?? '' ?></span>


<input type="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Enter your email">
<span style="color:red"><?= $errors['email'] ?? '' ?></span>

<input type = "password" name = "password" placeholder="enter password">

<span style="color:red"><?= $errors['password'] ?? '' ?></span>
<input type = "password" name = "confirm_password" placeholder="confirm password">
<span style="color:red"><?= $errors['confirm_password'] ?? '' ?></span>


            <button class="btn" >Submit</button>
            <!-- //users submits page reload
             refresh = from resubmits again.
             correct pattern prg pattern
             header("Location: contact.php?success=1");
                exit;
-->
        </form>
        <?php if (isset($errors['form'])): ?>
    <p style="color:red"><?= $errors['form'] ?></p>
<?php endif; ?>

        <script src="index2.js"></script>
    </div>

</body>
</html>


<!-- 
Mixing too many responsibilities

Your file is doing:

Validation

DB connection

Insert

HTML rendering

This is okay for now, BUT…

You should logically group:

// 1. request check
// 2. validation
// 3. database logic
// 4. output -->