<?php
                            if (($_SESSION['loggedIn']) == true){
                                echo "
                                        <form action='' method='post'>
                                        <li><input id='log' type='submit' value='Log out' name='logout'></li>
                                        </form>
                                ";
                            }else{
                                echo "
                                         <li><a href='login.php'>login/register</a></li>
                                    ";
                            }
                        ?>