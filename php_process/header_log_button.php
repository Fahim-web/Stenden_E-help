<?php
                            if (isset($_SESSION['loggedIn'])){
                                echo "
                                        <form action='./php_process/log_out.php' method='post'>
                                        <li><input id='log' type='submit' value='Log out' name='logout'></li>
                                        </form>
                                ";
                            }else{
                                echo "
                                         <li><a href='./php_process/login.php'>login/register</a></li>
                                    ";
                            }
