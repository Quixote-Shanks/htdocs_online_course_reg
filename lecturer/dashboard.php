<?php
session_start();
include('includes/config.php');

if (isset($_POST['submit'])) {
    $courseCode = $_POST['courseCode'];
    $session = $_POST['session'];
    $semester = $_POST['semester'];

    $query = mysqli_query($bd, "SELECT COUNT(*) AS totalStudents FROM courseenrolls WHERE course='$courseCode' AND session='$session' AND semester='$semester'");
    $result = mysqli_fetch_assoc($query);
    $totalStudents = $result['totalStudents'];
} else {
    $totalStudents = 0;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Lecturer Dashboard</title>
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
                        <h3 class="panel-title">Check Number of Students Registered</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Course Code" name="courseCode" type="text" autofocus required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Session" name="session" type="text" required />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Semester" name="semester" type="text" required />
                                </div>
                                <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Check</button>
                            </fieldset>
                        </form>
                        <?php if ($totalStudents > 0) { ?>
                            <div class="alert alert-info" role="alert">
                                Total Students Registered for <?php echo htmlentities($courseCode); ?> in Session <?php echo htmlentities($session); ?>, Semester <?php echo htmlentities($semester); ?>: <?php echo $totalStudents; ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>
</html>
