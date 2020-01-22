<?php
include('header.php');
require('connect_mar.php');
?>


<div class="user_banner">
    <div class="user_banner_wrapper">
        <div class="user_banner_wrapper_pic">
            <?php echo '<img id="profilePic" src="' . $_SESSION['ope_filepath'] . '" alt="Profile picture">'; ?>
        </div>
        <div class="user_banner_wrapper_msg">
            <h3>Welcome back <?php echo $_SESSION['username_ope']; ?> Ready to work?</h3>
        </div>
    </div>
</div>
<div class="main_security_wrapper">
    <?php
    $sql_select = 'SELECT customerid,companyid,username,customer_name,phone,email,password,filepath FROM Customer WHERE CompanyID IS NULL';
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
            echo '<form class="priv_form" action="security_operator_process.php" method="post">
                            <p >Register new Operator</p>
                            <div >Choose customer id <input placeholder="Enter the id of the user" type="number" name="customerid"></div>
                            <div ><input  type="submit" name="submit" value="submit"></div>
                        
                    </form>';
            echo '<div id="security_wrap">';
            while (mysqli_stmt_fetch($stmt_select)) {
                // $_SESSION['customerid'] = $customerid;

                echo '<div class="security_general">
                            <div class="security_div">
                            <div ><p>CustomerID</p></div>
                            <div class="sec_top"><p>' . $customerid . '</p></div>
                        </div>
                        <div class="security_div">
                            <div ><p>CompanyID</p></div>
                            <div class="sec_top"><p>' . $companyid . '</p></div>
                        </div>
                        <div class="security_div">
                            <div ><p>Username</p></div>
                            <div class="sec_top"><p>' . $username . '</p></div>
                        </div>
                        <div class="security_div">
                            <div ><p>Customer Name</p></div>
                            <div class="sec_top"><p>' . $customer_name . '</p></div>
                        </div>
                        <div class="security_div">
                            <div ><p>Phone Nr.</p></div>
                            <div class="sec_top"><p>' . $phone . '</p></div>
                        </div>
                        <div class="security_div">
                            <div ><p>Email</p></div>
                            <div class="sec_top"><p>' . $email . '</p></div>
                        </div>
                        <div class="security_div_user">
                            
                            <div><img class="security_user_img" src="' . $filepath . '"></img></div>
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