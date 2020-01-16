<?php
include('header.php');
?>


<?php


?>


<div class="content_wrapper">
    <div class="maintain_wrapper">
        <div class="maintain_client">
            <div class="maintain_client_info">
                <img id="profilePic" src="https://i.ibb.co/VtWkjpZ/profile.png" alt="Profile picture">
                <div class="maintain_client_info_text">
                    <h4>INSERT USERNAME</h4>
                    <h4>INSERT COMPANY NAME</h4>
                    <h4>INSERT EMAIL</h4>
                    <h4>INSERT EMAIL</h4>
                </div>
            </div>
            <div class="maintain_client_text">
                <div class="bubble">
                    <h2>TITLE</h2>
                    <p>Loren, aliquam rhoncus velit. In et placerat nibh. Maecenas tincidunt leo id metus congue cursus. Donec aliquam leo eu lectus egestas, sit amet imperdiet eros efficitur. Phasellus dignissim ut elit in commodo. Integer in elementum sapien, in dapibus risus. Suspendisse vel magna vehicula, ornare neque in, gravida velit. Sed cursus est eget libero fringilla, a consectetur enim consequat. Curabitur sit amet nisi magna. Donec malesuada felis nec dictum hendrerit. Aliquam in aliquet arcu, condimentum eleifend felis. Mauris urna lorem, vestibulum non orci vitae, susci</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="maintain_wrapper">
        <div class="maintain_client">
            <div class="maintain_client_info">
                <p>INFO of ticket</p>
                <p>INFO of ticket</p>
                <p>INFO of ticket</p>
                <p>INFO of ticket</p>
                <p>INFO of ticket</p>
                <p>INFO of ticket</p>
            </div>
            <div class="maintain_client_text">
                <!--IF TEXT APPEARS PUT TEXT INTO A .bubble_response(different color bubble with different dirrextion of a tail)-->
                <div class="bubble_response">

                    <p>Loren, aliquam rhoncus velit. In et placerat nibh. Maecenas tincidunt leo id metus
                        congue cursus. Donec aliquam leo eu lectus egestas, sit amet imperdiet eros efficitur.
                        Phasellus dignissim ut elit in commodo. Integer in elementum sapien, in dapibus risus.
                        Suspendisse vel magna vehicula, ornare neque in, gravida velit. Sed cursus est eget libero fringilla,
                        a consectetur enim consequat. Curabitur sit amet nisi magna. Donec malesuada felis nec dictum hendrerit
                        . Aliquam in aliquet arcu, condimentum eleif
                        end felis. Mauris urna lorem, vestibulum non orci vitae, susci</p>
                </div>
            </div>
        </div>
    </div>
    <!--START OF THE OPERATOR INPUT-->

    <?php
    if ($clearance = 1){
            echo "
            <div class='maintain_client_anwserBar'>
                <div class='maintain_client_anwserBar_wrap clearfix'>
                    <div class='maintain_client_anwserBar_text'>
                        <form id='maintain_form' action='#' method='POST'>
                            <textarea id='textarea' name='response' placeholder='Write your response'>
                            </textarea>
                    </div>
                    <div class='maintain_client_anwserBar_buttons'>
                        <input type='checkbox' id='status' name='status' value='5'>
                        <label for='status'>
                            <h4>TICKET IS READY FOR TL's REVIEW</h4>
                        </label>
                        <button class='submitbtn' type='submit' name='submit'>Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
            <!--END OF OPERATOR INPUT-->
    </div>
<?php
require("../html/footer.html");
?>