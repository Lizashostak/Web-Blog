<?php

require_once 'functions/functions.php';
my_session_start('secure');
$_SESSION['msg'] = "";
$_SESSION['err'] = "";

//check user
if (confirm_user()) {
    $user = $_SESSION['uname'];
    $user = ucfirst($user);
} else {
    header("location: index.php");
}

$post_id_to_delete = $_GET['post_id_to_delete'];

if ($link = db_connect()) {
    $sql = "DELETE FROM posts WHERE id='$post_id_to_delete'";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_affected_rows($link) > 0) {
        $_SESSION['msg'] = 'Post have been deleted';
    } else {
        $_SESSION['err'] = "Post was not deleted";
    }
}

header('location: blog.php');
?>
