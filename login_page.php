<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
    <link rel="stylesheet" href="vendor/Slick/slick.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>
  
    <header>
        <div class="container">
        <a href="index.html" ><img class="logo" src="img/logo.png"></a>
        <div class="menu-btn not-active"><span></span>
            </div>
        <ul class="menu"><li><a href="#">faq</a></li>
                <li><a href="#">contact us</a></li>
                <li><a href="login.html">login/register</a></li>
                <li><a href="#"></a></li>
        </ul>
        </div>
    </header>
        
        <div class="login_bg">
            <div class="container">
                <div class="login_form">
                    <img src="img/login_img.png" alt="">
                    <form action="" method="POST">
                        <h2>Long time no see!</h2>
                        <h3>Please write your login and password</h3>
                        
                        <input type="text" name="user" placeholder="User name">
                        <input type="password" name="pass" placeholder="user password">
                        <input type="submit" value="Log in" name="submit">
                        <a href="register_page.php">Still not registered? Click here!</a>
                        <p> <a href="login_operator_page.php">Login as operator</a></p>
                    </form>
                    <?php
					include "php_process/login.php";
				?>
                </div>
            </div>
        </div>	
    
    <footer>
        <div class="container clearfix">
            <div class="footer_logo"><img src="img/logo.png" alt=""></div>
            <div class="footer_contacts clearfix">
            <h3>Contacts</h3>
            <p>supportdesk@info.com</p>
            <p>+1234567890</p>
        </div>
            
        </div>
    </footer>
    <script src="vendor/jquery/jquery-3.2.0.min.js"></script>
    <script src="js/core.js"></script>
</body>
</html>