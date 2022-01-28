<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <title>Sign In</title>
</head>
<body>
<?php
    session_start();
    if(isset($_SESSION["login"])) {
        echo '<div class="header">
                <div class="info">
                    <p>Hello ' . $_COOKIE["login"] . '</p>
                </div>
                <div class="exit">
                    <p><a href="public/logout.php">Exit</a></p>
                </div>
             </div>';       
    }   


    if(!isset($_SESSION["login"])) {
        echo '
    <div class="wrapper">
        <div class="form-wrapper">
            <div class="title_form">
                <h1>Sign In</h1>
            </div>
            <form id="form">
                <div class="input_login">
                    <input name="login" type="text" id="login" placeholder="Login">
                </div>
                <div class="input_password">
                    <input placeholder="Password"  id="password" type="password" name="password" >
                </div>

                <div class="submit_button">
                    <button type="submit">
                        Sign In
                    </button>
                </div>
            </form>
        </div>';
    }
        ?>
</body>
</body>
</html>