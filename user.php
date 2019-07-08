<?php
require_once 'functions/functions.php';
my_session_start('secure');
$msg = "";
$err = "";

//check user
if (confirm_user()) {
    $user = $_SESSION['uname'];
    $user = ucfirst($user);
    $user_id = $_SESSION['user_id'];
} else {
    header("location: index.php");
}

//edit first name in DB
if (isset($_POST['save_name'])) {
    if (empty($_POST['user_name'])) {
        $err = "Name field is empty";
    } else {
        if ($link = db_connect()) {
            $updated_name = strtolower(trim(filter_input(INPUT_POST, 'user_name', FILTER_SANITIZE_STRING)));
            $updated_name = mysqli_real_escape_string($link, $updated_name);
            $sql = "UPDATE users SET first_name = '$updated_name' WHERE users.id = $user_id";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                $fname = ucfirst($updated_name);
                $msg = "Your First name Updated to $fname";
                $_SESSION['uname'] = $fname;
            }
        }
    }
}
//edit last name in DB
if (isset($_POST['save_lname'])) {
    if (empty($_POST['user_lname'])) {
        $err = "Last Name field is empty";
    } else {
        if ($link = db_connect()) {
            $updated_lname = strtolower(trim(filter_input(INPUT_POST, 'user_lname', FILTER_SANITIZE_STRING)));
            $updated_lname = mysqli_real_escape_string($link, $updated_lname);
            $sql = "UPDATE users SET last_name = '$updated_lname' WHERE users.id = $user_id";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                $lname = $updated_lname;
                $msg = "Your Last Name updated to $lname";
            }
        }
    }
}
//edit email in DB
if (isset($_POST['save_email'])) {
    if (empty($_POST['user_email'])) {
        $err = "Email field is empty";
    } else {
        if ($link = db_connect()) {
            $updated_email = strtolower(trim(filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL)));
            $updated_email = mysqli_real_escape_string($link, $updated_email);
            $sql = "UPDATE users SET email = '$updated_email' WHERE users.id = $user_id";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                $uemail = $updated_email;
                $msg = "Your Email updated to $uemail";
            }
        }
    }
}
//edit password in DB
if (isset($_POST['save_pass'])) {
    if (empty($_POST['user_pass'] && $_POST['user_pass2'])) {
        $err = "Password field is empty";
    } else {
        if ($_POST['user_pass'] !== $_POST['user_pass2']) {
            $err = "Passwords not matches, try again";
        } else {
            $updated_pass = trim(filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING));
            $updated_pass2 = trim(filter_input(INPUT_POST, 'user_pass2', FILTER_SANITIZE_STRING));
            $updated_pass = mysqli_real_escape_string($link, $updated_pass);
            $updated_pass = password_hash($updated_pass, PASSWORD_BCRYPT);
            if ($link = db_connect()) {
                $sql = "UPDATE users SET password = '$updated_pass' WHERE users.id = $user_id";
                $result = mysqli_query($link, $sql);
                if ($result && mysqli_affected_rows($link) > 0) {
                    $msg = "Your Password updated";
                }
            }
        }
    }
}

//user info from DB
if ($link = db_connect()) {
    $sql = "SELECT * FROM  users WHERE id='$user_id'";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fname = htmlspecialchars(ucfirst($row['first_name']));
        $lname = htmlspecialchars(ucfirst($row['last_name']));
        $uemail = htmlspecialchars($row['email']);
    }
}
require 'tamplate/header.php';
?>
<div class="sign-up">
    <div class="container">  
        <div class="blog-page">
            <div class="blog-page-item" style="text-align: left">

                <h4>My Info:</h4>
                <form action="" method="post">
                    <div>First Name: <?= $fname ?>                
                        <a class="btn"  onclick="edit_field('fname')">
                            <span style="color: #1d8fa5; font-size: 1em;">
                                <i class="fas fa-edit"></i></span></a>
                        <input id="user_name" name="user_name" type="hidden" value="<?= $fname ?>    ">
                        <input id="save_name"  name="save_name" type="hidden" value="Save" class="btn my-btn">
                        <span style="visibility: hidden" id="cancel_edit_name" >
                            <a class="btn btn-delete" onclick="cancel_edit('name')">Cancel</a>
                        </span>
                    </div>
                </form>
                <form action="" method="post">
                    <div> Last name: <?= $lname ?>
                        <a class="btn"  onclick="edit_field('lname')">
                            <span style="color: #1d8fa5; font-size: 1em;">
                                <i class="fas fa-edit"></i></span></a> 
                        <input id="user_lname" name="user_lname" type="hidden" value="<?= $lname ?>">
                        <input id="save_lname"  name="save_lname" type="hidden" value="Save" class="btn my-btn">
                        <span style="visibility: hidden" id="cancel_edit_lname" >
                            <a class="btn btn-delete " onclick="cancel_edit('lname')">Cancel</a>
                        </span>
                    </div>
                </form>
                <form action="" method="post">
                    <div>  Email Adress: <?= $uemail ?>
                        <a class="btn"  onclick="edit_field('email')">
                            <span style="color: #1d8fa5; font-size: 1em;">
                                <i class="fas fa-edit"></i></span></a> 
                        <input id="user_email" name="user_email" type="hidden" value="<?= $uemail ?>">
                        <input id="save_email"  name="save_email" type="hidden" value="Save" class="btn my-btn">
                        <span style="visibility: hidden" id="cancel_edit_email" >
                            <a class="btn btn-delete" onclick="cancel_edit('email')">Cancel</a>
                        </span>
                    </div>
                </form>
                <form action="" method="post">
                    <div>  Change Password: 
                        <a class="btn"  onclick="change_pass()">
                            <span style="color: #1d8fa5; font-size: 1em;">
                                <i class="fas fa-edit"></i></span></a>
                        <br>
                        <input id="user_pass" name="user_pass" type="hidden" placeholder="Choose new password">
                        <br>
                        <input id="user_pass2"  name="user_pass2" type="hidden" placeholder="Confirm password" >
                        <input id="save_pass"  name="save_pass" type="hidden" value="Save" class="btn my-btn">
                        <span style="visibility: hidden" id="cancel_edit_pass" >
                            <a class="btn btn-delete" onclick="cancel_edit_pass()">Cancel</a>
                        </span>
                    </div>
                </form>
                <?php if (!empty($msg)): ?>
                    <div class="success_msg">
                        <p><?= $msg ?></p>
                    </div>
                <?php endif; ?>
                <?php if ((!empty($err))): ?>
                    <div class="err_msg">
                        <p><?= $err ?></p>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php require 'tamplate/footer.php'; ?>
<script>
//edit first/lastname/email
    function edit_field(field) {
        document.getElementById('user_' + field).type = 'text';
        document.getElementById('save_' + field).type = 'submit';
        document.getElementById('cancel_edit_' + field).style.visibility = 'visible';
    }
//cancel edit first/lastname/email 
    function cancel_edit(field) {
        document.getElementById('user_' + field).type = 'hidden';
        document.getElementById('save_' + field).type = 'hidden';
        document.getElementById('cancel_edit_' + field).style.visibility = 'hidden';
    }
//edit password
    function change_pass() {
        document.getElementById('user_pass').type = 'password';
        document.getElementById('user_pass2').type = 'password';
        document.getElementById('save_pass').type = 'submit';
        document.getElementById('cancel_edit_pass').style.visibility = 'visible';
    }
//cancel edit password
    function cancel_edit_pass() {
        document.getElementById('user_pass').type = 'hidden';
        document.getElementById('user_pass2').type = 'hidden';
        document.getElementById('save_pass').type = 'hidden';
        document.getElementById('cancel_edit_pass').style.visibility = 'hidden';
    }
</script>

