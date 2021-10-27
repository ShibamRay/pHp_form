<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Welcome</title>
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
                    <h1>Hello, Now you can serf the internet.</h1>
                </div>
                <form action="login.php" method="POST">
                    <div class="btn1">
                        <button type="submit">Log Out</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>