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
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h2>Become a part of our community!</h2>
                        <h3>Please register</h3>

                        <input type="text" name="user" placeholder="User name">
                        <input type="text" name="cust_name" placeholder="Customer name">
                        <input type="text" name="phone" placeholder="Phone Nr">
                        <input type="email" name="email" placeholder="Email">
                        <input type="password" name="pass" placeholder="user password">
                        <input type="password" name="repass" placeholder="repeat password">
                        <label>Choose your image <input type="file" id="input" name="picture_input"></label>

                        <input type="submit" name="submit" value="Register">
                    </form>
                    <div class="disclaimer">
							<?php
							echo "<br><br>";
								include 'signup_action.php';

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