<?php
require_once 'functions/functions.php';
my_session_start('secure');

require_once 'tamplate/header.php';
?>
<div class="sign-up">
    <div class="container ">
        <div class="blog-page">
            <br>
            <h3 style="font-family: 'Permanent Marker', cursive;">Keep In Touch</h3>
            <br>
            <h5 style="font-family: 'Permanent Marker', cursive;">
                Contact us on a messenger <br>    
                and we will respond as soon as posible</h5>
            <div>
                <a class="btn" href="https://m.me/liza.minster"> 
                    <span style="color: darkblue ;">Open Messenger</span>
                </a>
                <a class="btn" href="https://m.me/liza.minster"> 
                    <span style="color: rgba(0,197,255,1); font-size: 2.2em;">
                        <i class="fab fa-facebook-messenger "></i>
                    </span>
                </a>
            </div>

        </div>
    </div>
</div>
<?php
require_once 'tamplate/footer.php';
?>
