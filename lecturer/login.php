<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
    $regno = $_POST['regno'];
    $password = md5($_POST['password']);
    $query = mysqli_query($bd, "SELECT * FROM lecturers WHERE lecturerRegno='$regno' AND password='$password'");
    $num = mysqli_fetch_array($query);
    if ($num > 0) {
        $_SESSION['alogin'] = $_POST['regno'];
        header('location:dashboard.php');
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid Reg No or Password";
        header('location:index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Lecturer Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lecturer Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Reg No" name="regno" type="text" autofocus required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required />
                                </div>
                                <button type="submit" name="login" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <?php if (isset($_SESSION['errmsg'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
