<?php
session_start(); //This is required before any html to iniciate sessions to work on the page

if (isset($_SESSION['Emp_Type'])){ //Checking too see if the Emp_tyoe Session is set. If it is we check the type of Emp_Type. If not they are redirected to the login page to login.
  if (($_SESSION['Emp_Type']) != 0){ // If they are anything other than a Admin they are redirected to the login page where they will be relocated to their specific page.
    header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
  }
}
else {
  header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
}

$hostname = 'localhost'; //Setting Database login variables for login link.
$dbusername = 'kmstk5';
$dbpassword = '75e93c2';
$database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

    $sqlFind = "SELECT Emp_Type From Employee WHERE Emp_ID=" . $_POST['delete']; // this is the query to find the employee type
    $sql = "DELETE FROM Employee WHERE Emp_ID=" . $_POST['delete'];
    $sqlPilot = "DELETE FROM Pilot WHERE Emp_ID=" . $_POST['delete'];
    $sqlAtt = "DELETE FROM Flight_Att WHERE Emp_ID= " . $_POST['delete'];
    $sqlAdmin = "DELETE FROM Administrator WHERE Emp_ID= " . $_POST['delete'];

    $result = mysqli_query($link, $sqlFind) or die("Query Error: " . mysqli_error($link));
    $fieldinfo = mysqli_fetch_row($result); //User much be deleted from their specific type table before the employee table is touched
    switch ($fieldinfo[0]) {
      case 0:
      $stmt = mysqli_prepare($link, $sqlAdmin);
      mysqli_stmt_execute($stmt);
        break;
      case 1:
      $stmt = mysqli_prepare($link, $sqlPilot);
      mysqli_stmt_execute($stmt);
        break;
      case 2:
      $stmt = mysqli_prepare($link, $sqlAtt);
      mysqli_stmt_execute($stmt);
        break;
      default:
        echo "Employee type was not found, couldn't delete from Emp_Type specific table."; //Error checking
        break;
    }
    $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));
    echo "<h1>User has been deleted <br>";
    echo '<a class="btn btn-lg btn-primary btn-block" href="UserMan.php">Return to User Managment</a>'; //return home button
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
