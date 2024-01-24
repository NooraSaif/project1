<?php

include 'database.php';

    // For login --------------------------------
    session_start();
    if (isset($_POST["loginSubmit"])) {
        $userID = $_POST["userID"];
        $password = $_POST["password"];

        $select = " SELECT * FROM user_account WHERE userID = '$userID' && password = '$password' ";

        $result = mysqli_query($con, $select);
        
        if(mysqli_num_rows($result) > 0){

            $row = mysqli_fetch_array($result);
      
            if($row['user_type'] == 'teacher'){
      
               $_SESSION['teacher_name'] = $row['userName'];
               header('location:teacher_page.php');
      
            }elseif($row['user_type'] == 'student'){
      
               $_SESSION['student_name'] = $row['userName'];
               header('location:student_page.php');
      
            }
           
         }else {
            echo '<script>alert("You dont not have an account yet!")</script>';
        }    
    }

    // For registration------------------------------
    if (isset($_POST["registerSubmit"])) {
        $userID = $_POST["userID"];
        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $user_type = $_POST["user_type"];

        $select = " SELECT * FROM user_account WHERE userID = '$userID' && password = '$password' ";

        $result = mysqli_query($con, $select);  

        if(mysqli_num_rows($result) > 0){
        $errors[] ='User Already Exist';
        }else {
           if (empty($userID) OR empty($userName) OR empty($email) OR empty($password)) {
            $errors[] ="All fields are required";
           }
           elseif (strlen($password)<8) {
            $errors[] ="Password must be at least 8 charactes long";
           }
           elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] ="Email is not valid";
           }else{
            $insert = "INSERT INTO user_account(userID, userName, email, password, user_type) VALUES('$userID', '$userName', '$email','$password','$user_type')";
            mysqli_query($con, $insert); 
            $msg = "<div class='message'>Booking Successfull</div>";
           }
        }   
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/loginstyle.css">
    <title>Booking System for the MEC</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p>Book EduSpace</p>
        </div>
        

        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">log In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>
        
    </nav>

<!----------------------------- login Form ----------------------------------->    
<div class="form-box">
    <div class="login-container" id="login">
        <div class="top">
            <header>Welcome Back!</header>
        </div>
        <?php echo isset($msg)?$msg:''; ?>
        <form action="loginpage.php" method="post">
            <div class="input-box">
                <input type="text" name="userID" class="input-field" placeholder="user ID">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" name="loginSubmit" class="submit" value="Login">
            </div>
        </form>
        <div class="top">
            <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
        </div>
    </div>


<!------------------- registration form -------------------------->
<div class="register-container" id="register">
    <div class="top">
        <header>Sign Up</header>
    </div>

        <?php
        if(isset($errors)){
            foreach($errors as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>

    <form  action="loginpage.php" method="post">
        <div class="two-forms">
            <div class="input-box">
                <input type="text" name="userID" class="input-field" placeholder="ID">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="text" name="userName" class="input-field" placeholder="User Name">
                <i class="bx bx-user"></i>
            </div>
        </div>

        <div class="input-box">
            <input type="email" name="email" class="input-field" placeholder="Email">
            <i class="bx bx-envelope"></i>
        </div>
        <div class="input-box">
            <input type="password" name="password" class="input-field" placeholder="Password">
            <i class="bx bx-lock-alt"></i>
        </div>
        <div class="input-box">
            <select name="user_type" class="input-field">
            <option value="student">student</option>
            <option value="teacher">teacher</option>
            </select> 
        </div>
        <div class="input-box">
            <input type="submit" name="registerSubmit" class="submit" value="Register">
        </div>
    </form>
    
        <div class="top">
            <span>Have an account? <a href="#" onclick="login()">Login</a></span>
        </div>
    </div>
    </div>
</div>   


<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>

</body>
</html>