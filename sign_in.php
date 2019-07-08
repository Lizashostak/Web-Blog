<?php
require_once 'functions/functions.php';
my_session_start('secure');
$err;
$email = "";
$pass = "";
$msg = "";
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
                    $err = "User not registered yet, pleas sign up";
                }
            }
        }
    }
}
$token = sha1(rand(10000000, 50000000) . time());
$_SESSION['csrf_token'] = $token;
?>

<?php include_once 'tamplate/header.php'; ?>
<div class="sign-up">
    <div class="container">
        <div class="sign-up-form ">
            <h4 style="font-family: 'Permanent Marker', cursive;">Log In:</h4>
            <form  action="" method="post">
                <div class="form-input">
                    <input class="input" type="text" name="email" placeholder="Enter your email" value="<?= $email; ?>">
                </div>
                <div class="form-input">
                    <input  class="input"type="password" name="pass" placeholder="Enter your password" >
                </div>
                <input type="hidden" name="csrf_token" value="<?= $token ?>">
                <div class="form-input">
                    <input class="btn btn-primary my-btn"  type="submit" name="submit" value="Log In">
                </div>
            </form>
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
            </div>
        <?php endif; ?>
        <br>
        <h4 style="font-family: 'Permanent Marker', cursive;">New User?</h4>
        <a style="margin: auto;"class="btn btn-primary my-btn" href="sign_up.php">Sign Up</a>

    </div>
</div>

<?php
require_once 'tamplate/footer.php';
?>
