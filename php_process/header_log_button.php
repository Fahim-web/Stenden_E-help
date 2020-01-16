
<?php
        if (isset($_SESSION['loggedIn'])) {
            echo "
                        <li><a href='log_out.php'>Log Out</a></li>
                                ";
        } else {
            echo "
                        <li><a href='login_page.php'>login/register</a></li>
                                    ";
        }
?>