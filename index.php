<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/style.css">

    <title>Sign Up</title>
</head>

<body>
    <?php session_start() 
    
    ?>

    <?php if(isset($_SESSION["login"])): ?>    
        <div class="header">
            <div class="info">
                <p>Hello <?php echo $_COOKIE["login"] ?></p>
            </div>
            <div class="exit">
                <p><a href="public/logout.php">Exit</a></p>
            </div>
        </div>      
       


    
    
    <?php else: ?>
        <div class="wrapper">
            <div class="form-wrapper">
                <div class="title_form">
                    <h1>User registration</h1>
                </div>
                <form id="form" action="#">
                    <div class="input_login">
                        <input name="login" type="text" id="login" placeholder="Login">
                    </div>
                    <div class="input_password">
                        <input placeholder="Password"  id="password" type="password" name="password" >
                    </div>
                    <div class="input_confirm_password">
                        <input placeholder="Confirm Password" id="confirm_password" type="password" name="confirm_password">
                    </div>
                    <div class="input_email">
                        <input placeholder="Email" type="text" id="email" name="email">
                    </div>
                    <div class="input_name">
                        <input placeholder="Name" type="text" name="name" id="name">
                    </div>
                    <div class="submit_button">
                        <button type="button" class="submit">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <? endif ?>

        <script src="public/assets/js/create-error-element.js"></script>
        <script src='public/assets/js/send-form-sign-up-handler.js'></script>
</body>
    
</html>