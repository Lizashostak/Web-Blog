<?php
require_once 'functions/functions.php';
my_session_start('secure');

require_once 'tamplate/header.php';
?>

<div class="sign-up">
    <div class="container">
        <div class="blog-page">
            <h1 style="font-family: 'Permanent Marker', cursive;">So how it's all starts ?</h1>
            <br>
            <p style="font-family: 'Permanent Marker', cursive;"> The idea was to create a comunity of skiers and snowboarders  <br>
                that can share their experience, ask for advice or just meet <br>
                snow lovers like themself.
            </p>
            <br>
            <p style="font-family: 'Permanent Marker', cursive;">Have an idea how we can improve our site or add more features?<br>
                Write to us, we would like to know!</p>
            <br>
            <a href="contact.php"><i  style="color: #66CCCC; font-size: 2em;" class="fas fa-file-signature"></i></a>
        </div>
    </div>
</div>
<?php
require_once 'tamplate/footer.php';
?>