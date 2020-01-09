<!DOCTYPE html>
<?php
require('php_process/connect.php');
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Page</title>
    <link rel="stylesheet" href="vendor/Slick/slick.css">
    <link rel="stylesheet" href="fonts/fonts.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <header>
        <div class="container">
            <a href="index.html"><img class="logo" src="img/logo.png"></a>
            <div class="menu-btn not-active"><span></span>
            </div>
            <ul class="menu">
                <li><a href="#">FAQ</a></li>
                <li><a href="#">View Registered Tickets</a></li>
                <li><a href="#">Log Out</a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
    </header>

    <div class="user_banner">
        <div class="user_banner_wrapper">
            <div class="user_banner_wrapper_pic">
                <img id="profilePic" src="https://i.ibb.co/VtWkjpZ/profile.png" alt="Profile picture">
            </div>
            <div class="user_banner_wrapper_msg">
                <h3>Welcome back *INSERT NAME*! Ready to work?</h3>
            </div>
        </div>
    </div>
    <div class="main_security_wrapper">
        <?php
        $sql_select = 'SELECT customerid,companyid,username,customer_name,phone,email,password FROM Customer';
        if ($stmt_select = mysqli_prepare($connect, $sql_select)) {
            $execute_select = mysqli_stmt_execute($stmt_select);
            if ($execute_select == FALSE) {
                echo mysqli_error($conenct);
            }
            mysqli_stmt_bind_result($stmt_select, $customerid, $companyid, $username, $customer_name, $phone, $email, $pwd);
            mysqli_stmt_store_result($stmt_select);

            if (mysqli_stmt_num_rows($stmt_select) == 0) {
                echo 'No customers have been registered';
            } else {
                echo '<form action="security_operator.php" method="post">
                        <p><input type="number" name="customerid"></p>
                        <p><input type="submit" name="submit" value="submit"></p>
                    </form>';
                while (mysqli_stmt_fetch($stmt_select)) {
                    // $_SESSION['customerid'] = $customerid;
                    echo '<div class="security_general">
                        <div class="security_div">
                        <p><a class="link" href="#">' . $customerid . '</a></p>
                    </div>
                    <div class="security_div">
                        <p>' . $companyid . '</p>
                    </div>
                    <div class="security_div">
                        <p>' . $username . '</p>
                    </div>
                    <div class="security_div">
                        <p>' . $customer_name . '</p>
                    </div>
                    <div class="security_div">
                        <p>' . $phone . '</p>
                    </div>
                    <div class="security_div">
                        <p>' . $email . '</p>
                    </div>
                </div>';
                }
            }
        }
        ?>
        <!-- <div class="security_div">
                    <p><a href="#">1</a></p>
                </div>
                <div class="security_div">
                    <p>2</p>
                </div>
                <div class="security_div">
                    <p>3</p>
                </div>
                <div class="security_div">
                    <p>4</p>
                </div>
                <div class="security_div">
                    <p>5</p>
                </div>
                <div class="security_div">
                    <p>6</p>
                </div>
                <div class="security_div">
                    <p>7</p>
                </div>
                <div class="security_div">
                    <p>8</p>
                </div> -->
    </div>
    <footer>
        <div class="container clearfix">
            <div class="footer_logo"><img src="img/logo.png" alt="">
            </div>
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