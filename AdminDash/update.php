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

  if (isset($_POST['update'])){
    $pk=$_POST['update'];
    $hostname = 'localhost';
    $dbusername = 'kmstk5';
    $dbpassword = '75e93c2';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());
    $sql = "SELECT * FROM Employee WHERE Emp_ID = '" . $pk . "'";
    echo $pk;
    $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));

    $update = "UPDATE Employee SET Emp_Name = ?, Emp_Password = ?, Emp_Type = ? WHERE Emp_ID = ?";

    echo "<form method='post' action='update.php'>";
    echo "<table align='center' class='result'>";

    while($field = mysqli_fetch_field($result)) {
      echo "<th class='result'>" . $field->name . "<br></th>";
    }

    while($row = mysqli_fetch_row($result)) {
      echo "<tr class='result'>";
      $counter = 0;
      foreach ($row as $value) {
        switch ($counter) {
            case 0: echo "<td class='result'><input type='text' name='Emp_ID' value=" . $value . "><br></td>";
            break;
            case 1: echo "<td class='result'><input type='text' name='Emp_Password' value=" . $value . "><br></td>";
            break;
            case 2: echo "<td class='result'><input type='text' name='Emp_Type' value=" . $value . "><br></td>";
            break;
            case 3: echo "<td class='result'><input type='text' name='Emp_Name' value=" . $value . "><br></td>";
            break;
        }

        $counter++;
      }
      echo "</tr>";
    }

    echo "<tr><td colspan='6' align='center'><button type='submit' name='save' value='$update'>Update Employee Account</td></tr>";

    echo "</table>";
    echo "</form";
  }

  if (isset($_POST['save'])) {
    $update = $_POST['save'];
    $link = mysqli_connect("localhost", "ndtptb", "T!958684", "CS3380GRP23");
    if($stmt = mysqli_prepare($link, $update)) {
      echo $_POST['Emp_ID'];
      mysqli_stmt_bind_param($stmt, "ssii", $_POST['Emp_Name'], $_POST['Emp_Password'], $_POST['Emp_Type'], $_POST['Emp_ID']);
      if(mysqli_stmt_execute($stmt)) {
        echo "<br><div align='center'>Employee Saved!</div><br>";
        echo '<a class="btn btn-lg btn-primary btn-block" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/UserMan.php">Return To User Managment</a>';
      }
    }
  }
?>

<html>
  <head>
    <title>Toms Air - Admin User Managment</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
    <link rel="stylesheet" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/styles.css" >

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

</html>
