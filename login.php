<?php
require_once 'auth.php';

// If post, check user
if (!empty($_POST['userlogin']) && !empty($_POST['pass'])) {
    // Verify user and password
    if (isValidUser($_POST['userlogin'], $_POST['pass'])) {
        // Log in
        $_SESSION['userlogin'] = $_POST['userlogin'];
        header('Location: admin.php');
        exit();
    }
    else
    {
        $_SESSION['userlogin'] = FALSE;
    }
}

// The user login page
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar PAT 2017</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/styles.css"> -->
     <!-- Live Search Styles -->
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">

    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.css">

</head>

<body>


<!--login modal-->
<div id="loginModal" class="modal show bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form" method="POST" action="login.php">
                <div class="modal-header">
                    <h3 class="text-center">User authentication</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" placeholder="login" name="userlogin">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control input-sm" placeholder="password" name="pass">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default mybtn">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>