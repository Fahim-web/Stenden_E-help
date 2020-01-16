<?php
include('header.php');
require('connect_mar.php');
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
            echo mysqli_error($connect);
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
<?php
require("../html/footer.html");
?>