<?php
error_reporting(0);
//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['userID'])) {
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$userID = $userPassword = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty(trim($_POST['userID'])) || empty(trim($_POST['userPassword']))) {
        $err = "Please enter username + password";
    } else {
        $username = trim($_POST['userID']);
        $password = trim($_POST['userPassword']);
    }


    if (empty($err)) {
        $sql = "SELECT * FROM users WHERE userID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_userID);
        $param_userID = $userID;


        // Trying to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $userID, $hashed_password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($userPassword, $hashed_password)) {
                        // this means the password is corrct. Allow user to login
                        session_start();
                        $_SESSION["userID"] = $userID;
                        $_SESSION["id"] = $id;
                        $_SESSION["loggedin"] = true;

                        //Redirect user to welcome page
                        header("location: welcome.php");
                    }
                }
            }
        }
    }
}


?>


<!-- html code-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Demo</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="section">
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
        <div class="box">
            <div class="float1" style="--i:0"></div>
            <div class="float2" style="--i:0"></div>
            <div class="float3" style="--i:0"></div>
            <div class="float4" style="--i:0"></div>
        </div>
        <div class="section2">
            <div class="panel">
                <div class="sign">
                    <h1>Sign In</h1>
                </div>
                <form action="" method="post">
                    <div class="inputs">
                        <input type="text" name="userID" placeholder="userename">
                        <br>
                        <input type="password" name="userPassword" placeholder="password">
                        <br>
                        <input type="checkbox">Remember me</input>
                    </div>
                    <div class="btn1">
                        <button type="submit">Log In</button>
                        <p>Don't have a account?<a href="index.php">Sign Up Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>