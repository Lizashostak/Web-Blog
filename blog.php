<?php
require_once 'functions/functions.php';
my_session_start('secure');

$title = "";
$txt_area = "";
$user = "";
$msg = "";
$err = "";

if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
}
if (isset($_SESSION['err'])) {
    $err = $_SESSION['err'];
}

//check user
if (confirm_user()) {
    $user = $_SESSION['uname'];
    $user = ucfirst($user);
} else {
    header("location: index.php");
}

//add new post
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $txt_area = $_POST['txt_area'];
    if (empty($_POST['title'])) {
        $err = 'Title is empty';
    } elseif (empty($_POST['txt_area'])) {
        $err = 'Post content is empty';
    } else {
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
        $txt_area = trim(filter_input(INPUT_POST, 'txt_area', FILTER_SANITIZE_STRING));
        if ($link = db_connect()) {
            $title = mysqli_real_escape_string($link, $title);
            $txt_area = mysqli_real_escape_string($link, $txt_area);
            $user_id = $_SESSION['user_id'];
            $sql = "INSERT INTO posts (id, uid, title, article, created_at, updated_at) VALUES ('', '$user_id', '$title', '$txt_area', CURRENT_TIME(), CURRENT_TIME());";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                $_SESSION['msg'] = "Your post added succefuly";
                $msg = $_SESSION['msg'];
                $title = "";
                $txt_area = "";
            } else {
                $_SESSION['err'] = "There was a problen to add your post, try again later";
                $err = $_SESSION['err'];
            }
        }
    }
}
// add edited post to db
if (isset($_POST['save_post_edit'])) {
    $post_id = $_POST['post_id'];
    $title = trim($_POST['edited_title']);
    $txt_area = trim($_POST['edited_txt']);
    if (empty($title) || empty($txt_area)) {
        $err .= "Title or Post content is empty";
    } else {
        $title = filter_input(INPUT_POST, 'edited_title', FILTER_SANITIZE_STRING);
        $txt_area = filter_input(INPUT_POST, 'edited_txt', FILTER_SANITIZE_STRING);
        if ($link = db_connect()) {
            $title = mysqli_real_escape_string($link, $title);
            $txt_area = mysqli_real_escape_string($link, $txt_area);
            $user_id = $_SESSION['user_id'];
            $sql = "UPDATE posts SET title = '$title', article='$txt_area',updated_at=NOW() WHERE posts.id = '$post_id';";
            $result = mysqli_query($link, $sql);
            if ($result && mysqli_affected_rows($link) > 0) {
                $_SESSION['msg'] = "Your post updated succefuly";
                $msg = $_SESSION['msg'];
                $title = "";
                $txt_area = "";
            } else {
                $_SESSION['err'] = "There was a problen to update your post, try again later";
                $err = $_SESSION['err'];
            }
        }
    }
}
//all posts from db
if ($link = db_connect()) {
    $sql = "SELECT posts.*,users.first_name ,users.last_name FROM posts JOIN users on posts.uid = users.id ORDER BY updated_at DESC";
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
    <div class="container">     
        <h4 style="font-family: 'Permanent Marker', cursive;"><?= $user ?> Welcome to a Blog Page </h4>
        <div class="blog-page">
            <div class="row">
                <div class="col-md-12 blog-page">
                    <div class="blog-page-item">
                        <form  action="" method="post"> 
                            <div class="md-form">
                                <input style="width:95%" class="form-input" type="text" name="title" placeholder="Post title" value="<?php echo $title; ?>">
                            </div>
                            <div class="md-form">
                                <textarea  class="form-input" style="width:95%" rows="5" name="txt_area" placeholder="Write your post..." value="" ><?php echo $txt_area; ?></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <input  class="btn btn-primary my-btn" id="submit" type="submit" name="submit" value="POST">
                            </div>
                        </form>
                        <br>
                        <div id="msg-box">
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
                        <?php
                        $_SESSION['msg'] = "";
                        $_SESSION['err'] = "";
                        ?>
                    </div>
                    <?php if (isset($data)) : ?>
                        <?php foreach ($data as $post): ?>
                            <div class="blog-page-item" >

                                <div align="left" style="font-weight:bold">
                                    <?= htmlspecialchars(ucwords($post['first_name'] . " " . $post['last_name'])); ?>
                                </div>
                                <div id="current_post_<?= $post['id'] ?>" style=" display: block;">
                                    <div style=" text-decoration: underline;">
                                        <?= htmlspecialchars($post['title']) ?>
                                    </div>
                                    <div>
                                        <?= htmlspecialchars($post['article']) ?>   
                                    </div>
                                    <div style="font-size:10px; "> 
                                        <span> Created at:  <?= $post['created_at']; ?></span>
                                        <?php if ($post['created_at'] !== $post['updated_at']) : ?>
                                            <span>   Updated at:  <?= $post['updated_at'] ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($post['uid'] == $_SESSION['user_id']): ?>
                                        <div align="right">
                                            <a class="btn" id="<?= $post['id'] ?>" onclick="edit_post(this.id)">
                                                <span style="color: #1d8fa5; font-size: 1em;">
                                                    <i class="fas fa-edit"></i></span></a>
                                            <a class="btn" id="<?= $post['id'] ?>" onclick="delete_post(this.id)">
                                                <span style="color: #aa3f64; font-size: 1em;">
                                                    <i class="fas fa-trash"></i></span></a>
                                        </div>
                                    <?php elseif ($_SESSION['uname'] == "admin"): ?>
                                        <div align="right">
                                            <a class="btn" id="<?= $post['id'] ?>" onclick="delete_post(this.id)">
                                                <span style="color: #aa3f64; font-size: 1em;">
                                                    <i class="fas fa-trash"></i></span></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div id="edit_post_<?= $post['id'] ?>" style=" display: none;">
                                    <form action="" method="post">
                                        <input style="width:95%" type="text" size="77" name="edited_title" value=" <?= htmlspecialchars($post['title']) ?>">  
                                        <textarea style="width:95%" rows="8" cols="80" name="edited_txt"> <?= htmlspecialchars($post['article']) ?></textarea> 
                                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                        <div>
                                            <input class="btn my-btn"type="submit" name="save_post_edit" value="Save">
                                            <span id="cancel_edit" >
                                                <a class="btn btn-delete" onclick="cancel_edit_post(<?= $post['id'] ?>)">Cancel</a>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <!--                <div class="col-md-3 blog-page ">
                
                                </div>-->
            </div> 
        </div>
    </div>
</div>
<?php require_once 'tamplate/footer.php'; ?>
<script>
    function delete_post(id) {
        var delete_post = confirm("Delete this post?");
        if (delete_post) {
            window.location.href = "delete.php?post_id_to_delete=" + id;
        }
    }
    $('#msg-box').fadeOut(5000);

    function edit_post(id) {
        document.getElementById('current_post_' + id).style.display = 'none';
        document.getElementById('edit_post_' + id).style.display = 'block';

    }
    function cancel_edit_post(id) {
        document.getElementById('current_post_' + id).style.display = 'block';
        document.getElementById('edit_post_' + id).style.display = 'none';
    }
</script>
