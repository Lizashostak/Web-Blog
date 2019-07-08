<?php
require_once 'functions/functions.php';
my_session_start('secure');
$err = "";

//check user
if (confirm_user()) {
    $user = $_SESSION['uname'];
    $user = ucfirst($user);
} else {
    header("location: index.php");
}

//change user status
if (isset($_GET['opp'])) {
    if ($link = db_connect()) {
        if ($_GET['opp'] == 'approve') {
            $aproval = 1;
        } else {
            $aproval = 0;
        }
        $sql = "UPDATE users SET status = '$aproval' WHERE id = {$_GET['uid']} ";

        $result = mysqli_query($link, $sql);
        if ($result && mysqli_affected_rows($link) > 0) {
            $err = "Status updated for: {$_GET['uemail']}";
        }
    }
}
//all users from DB
if ($link = db_connect()) {
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
}
?>
<?php
require_once 'tamplate/header.php';
?>
<div class="sign-up">
    <div class="blog-page">
        <div class="container">
            <h2><?= $user ?> Area </h2>
            <h5>Users on my Site:</h5>
            <table class="table ">
                <thead>
                    <tr>
                        <td>User Name</td>
                        <td>Email</td>
                        <td>Role</td>
                        <td>Status</td>
                        <td>Enable/Disable User</td>
                    </tr>
                </thead>
                <?php foreach ($data as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['first_name'] . " " . $user['last_name']) ?></td>    
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= $user['role'] ?></td>                    
                        <td>  <?php if ($user['status'] == 0): ?>
                                Not active
                            <?php else: ?>
                                Active
                            <?php endif; ?>
                        </td>
                        <td> <?php if ($user['status'] == 0): ?>
                                <a class=" btn btn-enable" href="admin.php?opp=approve&uid=<?= $user['id'] ?>&uemail=<?= $user['email'] ?>">Enable</a>
                            <?php else: ?>
                                <a class=" btn btn-disable" href="admin.php?opp=not_approve&uid=<?= $user['id'] ?>&uemail=<?= $user['email'] ?>">Disable</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p style="color: green"><b><?= $err ?></b></p>
        </div>
    </div>
</div>
</body>
</html>
