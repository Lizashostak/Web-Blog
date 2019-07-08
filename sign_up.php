<?php
require_once 'functions/functions.php';
my_session_start('secure');
$err = "";
$name = "";
$lname = "";
$email = "";
$pwd = "";
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);
    $pass2 = trim($_POST['pass2']);

    if (empty($name)) {
        $err = 'Insert your name';
    } elseif (empty($lname)) {
        $err = 'Insert your last name';
    } elseif (empty($email)) {
        $err = 'Insert your email';
    } elseif (empty($pass)) {
        $err = 'Choose a password';
    } elseif (empty($pass2)) {
        $err = 'You must confirm your password';
    } else {

        $name = strtolower(trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)));
        $lname = strtolower(trim(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING)));
        $email = strtolower(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);
        if ($pass !== $pass2) {
            $err = "Passwords not matches, try again";
        } else {
            $_SESSION['uname'] = $name;
            if ($link = db_connect()) {
                $sql = "SELECT * FROM users WHERE email = '$email' ";
                $result = mysqli_query($link, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    $err = "This email already exist";
                } else {
                    $name = mysqli_real_escape_string($link, $name);
                    $lname = mysqli_real_escape_string($link, $lname);
                    $email = mysqli_real_escape_string($link, $email);
                    $pass = mysqli_real_escape_string($link, $pass);

                    $pass = password_hash($pass, PASSWORD_BCRYPT);
                    $sql = "INSERT INTO users VALUES('','$name','$lname','$email','$pass','2','0')";
                    $result = mysqli_query($link, $sql);
                    if ($result && mysqli_affected_rows($link) > 0) {
                        $name = ucfirst($name);
                        $_SESSION['msg'] = "Welcome $name your data updated, you will be abale to log in after admin approval";
                        header("location: index.php");
                    }
                }
            }
        }
    }
}
?>

<?php include_once 'tamplate/header.php'; ?>
<div class="sign-up">
    <div class="container ">
        <h1 style="font-family: 'Permanent Marker', cursive;">WELCOME TO OUR SITE</h1>
        <br>
        <div class="sign-up-form">
            <h3 style="font-family: 'Permanent Marker', cursive;">Sign Up</h3>
            <div style="margin: 25px; ">
                <form action="" method="post">
                    <div class="form-input">
                        <input class="input" type="text" name="name" placeholder="Enter your name" value="<?= $name; ?>"> 
                    </div>
                    <div class="form-input">
                        <input class="input"type="text" name="lname" placeholder="Enter your Last name" value="<?= $lname; ?>">
                    </div>
                    <div class="form-input">
                        <input class="input" type="text" name="email" placeholder="Enter your email" value="<?= $email; ?>">
                    </div>
                    <div class="form-input">
                        <input class="input"type="password" name="pass" placeholder="Enter your password">
                    </div>
                    <div class="form-input">
                        <input class="input"type="password" name="pass2" placeholder="Confirm Password">
                    </div>
                    <div class="form-input">
                        <input class="btn btn-primary my-btn" type="submit" name="submit" value="SEND">
                    </div>
                </form>
            </div>
            <?php if (!empty($err)): ?>
                <div class="err_msg">
                    <p ><?= $err ?></p>
                </div>
            <?php endif; ?>
            <h5 style="font-family: 'Permanent Marker', cursive;">Existing user? </h5>
            <a class="btn btn-primary my-btn" href="sign_in.php">Log In </a> 
        </div>

    </div>
</div>
<?php
require_once 'tamplate/footer.php';
?>

