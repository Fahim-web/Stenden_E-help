<?php
include('header.php');
?>




<div class="login_bg">
    <div class="container">
        <div class="login_form">
            <img src="img/login_img.png" alt="">
            <form action="signup_action.php" method="POST" enctype="multipart/form-data">
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
                // echo "<br><br>";
                // include 'signup_action.php';

                ?>
            </div>
        </div>
    </div>
</div>

<?php
require("../html/footer.html");
?>