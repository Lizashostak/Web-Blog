<?php
require_once 'functions/functions.php';
my_session_start('secure');
$err;
$email = "";
$pass = "";
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
}
if (isset($_POST['submit'])) {
    if ($_SESSION['csrf_token'] == $_POST['csrf_token']) {
        $email = $_POST['email'];
        if (empty($_POST['email'])) {
            $err = 'Insert your email';
        } elseif (empty($_POST['pass'])) {
            $err = 'Insert your password';
        } else {
            $email = strtolower(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
            $pass = trim(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));
            if ($link = db_connect()) {
                $email = mysqli_real_escape_string($link, $email);
                $pass = mysqli_real_escape_string($link, $pass);
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($link, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if (password_verify($pass, $row['password'])) {
                        if ($row['role'] == 1) {
                            $_SESSION['admin'] = "admin";
                            $_SESSION['uname'] = "admin";
                            $_SESSION['role'] = "admin";
                            $_SESSION['user_id'] = $row['id'];
                            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                            $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
                            header('Location: admin.php');
                        } else {
                            if ($row['role'] == 2 && $row['status'] == 1) {
                                $_SESSION['role'] = "user";
                                $_SESSION['uname'] = $row['first_name'];
                                $_SESSION['user_id'] = $row['id'];
                                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
                                $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
                                header('Location: blog.php');
                            } else {
                                $err = "You have not been approved yet. Please try again later.";
                            }
                        }
                    } else {
                        $err = 'wrong email or password';
                    }
                } else {
                    $err = "User not registered yet, please sign up";
                }
            }
        }
    }
}
$token = sha1(rand(10000000, 50000000) . time());
$_SESSION['csrf_token'] = $token;
?>

<?php
require_once 'tamplate/header.php';
?>
<div class="home-container">
    <div class="container main-body ">
        <div class="row">
            <div class="col-md-9">
                <h1 class="heading" style="font-family: 'Permanent Marker', cursive;">Welcome to Ski Adviser</h1>
                <br>
                <br>
                <h4 style="font-family: 'Permanent Marker', cursive;">Here you can share your snow experience, 
                    <br>
                    <br>
                    get advice or meet snow adicted people just like you!</h4>
                <br>
                <h4 style="font-family: 'Permanent Marker', cursive;">So what you are waiting for? Lets start!</h4>
            </div>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <div style="display: none;"></div>
            <?php else: ?>
                <div class="col-md-3 login-home">
                    <h2 style="font-family: 'Permanent Marker', cursive;">Log In:</h2>   
                    <form  action="" method="post"> 
                        <div class="md-form">
                            <i class="fa fa-envelope prefix white-text"></i>
                            <input type="email"  class="white-text form-control home-input" name="email" placeholder="Your Email" value="<?= $email; ?>">
                        </div>
                        <div class="md-form">
                            <i class="fa fa-lock prefix white-text"></i>
                            <input type="password"  class="white-text form-control home-input" name="pass" placeholder="Your Password">
                        </div>
                        <input type="hidden" name="csrf_token" value="<?= $token ?>">
                        <div class="text-center mt-4">
                            <button name="submit" class="btn btn-indigo waves-effect waves-light">Log In</button>
                        </div>
                    </form>
                    <br>
                    <?php if (!(empty($err))): ?>
                        <div class="err_msg">
                            <?= $err ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($msg)): ?>
                        <div class="success_msg">
                            <?= $msg ?>
                            <?php $_SESSION['msg'] = ""; ?>
                        </div>
                    <?php endif; ?>
                    <br>
                </div>
            <?php endif; ?>
        </div> 
    </div>
    <?php
    require_once 'tamplate/footer.php';
    ?>
