<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <link rel="stylesheet" href="style/style.css">
        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Permanent+Marker" rel="stylesheet">
        <title>Ski Adviser</title>
        <style>

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top  top-nav ">
            <div class="navbar-nav flex-row ml-md-auto d-md-flex">
                <div class="navbar-collapse " >
                    <div class="float-right">
                        <ul class="navbar-nav float-right  ">
                            <li class="nav-item ">
                                <a class="nav-link" href="index.php"  > 
                                    <i style="color: #66CCCC;" class="fas fa-home" onMouseOver="this.style.color = 'rgba(102,204,204,0.8)'"  onmouseout="this.style.color = '#66CCCC'">
                                    </i>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact Us</a>
                            </li>
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == "user"): ?>
                                <li class="nav-item ">
                                    <a class="nav-link" href="blog.php">Blog</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="log_out.php">Log Out</a>
                                </li>
                                <li class="nav-item ">
                                    <a  class="nav-link" href="user.php"><i class="fas fa-user-cog"></i></a>       
                                </li>
                            <?php elseif (isset($_SESSION['user_id']) && $_SESSION['role'] == "admin"): ?>
                                <li class="nav-item ">
                                    <a class="nav-link" href="blog.php">Blog</a>
                                </li>
                                <li class="nav-item ">
                                    <a  class="nav-link" href="admin.php">Admin Area</a>       
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="log_out.php">Log Out</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item ">
                                    <a class="nav-link" href="sign_in.php">Log In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="sign_up.php">Sign Up</a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div>

                </div>
            </div>
        </nav>