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

<?php
    include ('php_process/header.php');
?>

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
        $sql_select = 'SELECT customerid,companyid,username,customer_name,phone,email,password,filepath FROM Customer';
        if ($stmt_select = mysqli_prepare($connect, $sql_select)) {
            $execute_select = mysqli_stmt_execute($stmt_select);
            if ($execute_select == FALSE) {
                echo mysqli_error($conenct);
            }
            mysqli_stmt_bind_result($stmt_select, $customerid, $companyid, $username, $customer_name, $phone, $email, $pwd, $filepath);
            mysqli_stmt_store_result($stmt_select);
            // echo 'chuj';
            if (mysqli_stmt_num_rows($stmt_select) == 0) {
                echo 'No customers have been registered';
            } else {
                echo '<form class="security_form" action="security_operator.php" method="post">
                            <div class="security_inside_form_top"><p class="notification">Register new Operator</p></div>
                            <div class="security_inside_form">Choose customer id <input class="input_security" placeholder="Enter the id of the user" type="number" name="customerid"></div>
                            <div class="security_inside_form"><input class="submit_security_operator" type="submit" name="submit" value="submit"></div>
                        
                    </form>';
                echo '<div id="security_wrap">';
                while (mysqli_stmt_fetch($stmt_select)) {
                    // $_SESSION['customerid'] = $customerid;

                    echo '<div class="security_general">
                            <div class="security_div">
                            <div><p>CustomerID</p></div>
                            <div><p>' . $customerid . '</p></div>
                        </div>
                        <div class="security_div">
                            <div><p>CompanyID</p></div>
                            <div><p>' . $companyid . '</p></div>
                        </div>
                        <div class="security_div">
                            <div><p>Username</p></div>
                            <div><p>' . $username . '</p></div>
                        </div>
                        <div class="security_div">
                            <div><p>Customer Name</p></div>
                            <div><p>' . $customer_name . '</p></div>
                        </div>
                        <div class="security_div">
                            <div><p>Phone Nr.</p></div>
                            <div><p>' . $phone . '</p></div>
                        </div>
                        <div class="security_div">
                            <div><p>Email</p></div>
                            <div><p>' . $email . '</p></div>
                        </div>
                        <div class="security_div">
                            <div><p>Email</p></div>
                            <div><img src="profileimages/' . $filepath . '"></img></div>
                        </div>
                    </div>';
                }
                echo '</div>';
            }
        }
        ?>
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