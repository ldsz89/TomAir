<?php
session_start();

if (isset($_SESSION['Emp_Type'])){
  if (($_SESSION['Emp_Type']) != 0){
    header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
  }
}
else {
  header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
}

$hostname = 'localhost';
$dbusername = 'kmstk5';
$dbpassword = '75e93c2';
$database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

    $sql = "DELETE FROM Employee WHERE Emp_ID=" . $_POST['delete'];
    $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));
    echo "<h1>User has been deleted <br>";
    echo '<a class="btn btn-lg btn-primary btn-block" href="UserMan.php">Return to User Managment</a>';
?>

<html>
  <head>
    <title>Toms Air - Search System</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
    <link rel="stylesheet" href="http://cs3380.rnet.missouri.edu/~ndtptb/lab9/styles.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

</html>
