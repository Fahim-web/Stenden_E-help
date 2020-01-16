 <?php
        if (isset($_SESSION['loggedIn'])) {
            echo "
                                        <form action='log_out.php' method='post'>
                                        <li><input id='log' type='submit' value='Log out' name='logout'></li>
                                        </form>
                                ";
        } else {
            echo "
                                         <li><a href='login_page.php'>login/register</a></li>
                                    ";
        }
        ?> 