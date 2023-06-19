<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        mysqli_query($bd, "DELETE FROM lecturers WHERE lecturerId = '".$_GET['id']."'");
        $_SESSION['delmsg'] = "Lecturer record deleted!";
    }

    if (isset($_GET['pass'])) {
        $password = "12345";
        $newpass = md5($password);
        mysqli_query($bd, "UPDATE lecturers SET password='$newpass' WHERE lecturerId = '".$_GET['id']."'");
        $_SESSION['delmsg'] = "Password reset. New password is 12345";
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | Manage Lecturers</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>

<?php if ($_SESSION['alogin'] != "") {
    include('includes/menubar.php');
}
?>

<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-head-line">Manage Lecturers</h1>
            </div>
        </div>
        <div class="row">
            <font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?></font>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Lecturers
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Reg No</th>
                                        <th>Lecturer Name</th>
                                        <th>Pincode</th>
                                        <th>Reg Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = mysqli_query($bd, "SELECT * FROM lecturers");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($sql)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo htmlentities($row['lecturerRegno']); ?></td>
                                            <td><?php echo htmlentities($row['lecturerName']); ?></td>
                                            <td><?php echo htmlentities($row['pincode']); ?></td>
                                            <td><?php echo htmlentities($row['creationdate']); ?></td>
                                            <td>
                                                <a href="manage-lecturers.php?id=<?php echo $row['lecturerId']; ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                                <a href="manage-lecturers.php?id=<?php echo $row['lecturerId']; ?>&pass=update" onClick="return confirm('Are you sure you want to reset password?')">
                                                    <button type="submit" name="submit" id="submit" class="btn btn-default">Reset Password</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                        $cnt++;
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>

<script src="assets/js/jquery-1.11.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
