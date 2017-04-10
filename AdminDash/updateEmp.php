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

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title>Toms Air - Update Employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>

    body {
      background-color: #a94442;
    }

    th {
      background-color: rgba(250,250,250,1);
    }

    tr.result {
      background-color: rgba(200,200,200,1);
    }

    .col-sm-3 {
      border: 2px;
      font-size: 30px;
      color: black;
      background:rgba(0,0,0,0.4);
    }

	  .jumbotron {
		  background-color: rgba(0, 180, 255, 0.2);
		}

    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
	    background-color: rgba(0, 180, 255, 0.5);
      padding: 15px;
    }

  </style>
</head>

  <body>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="AdminDash.php">Admin</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="AdminDash.php">Dashboard</a></li>
            <li class="active"><a href="UserMan.php">User Management</a></li>
            <li><a href="LogView.php">Log Viewer</a></li>
            <li><a href="EquipUp.php">Update Equipment</a></li>
            <li><a href="FlightUp.php">Update Flights</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
        </div>
      </nav>

    </body>

</html>


<?php

  if (isset($_POST['update'])){
    $pk=$_POST['update']; //here we assign the primary key as a new variable from the post value we got from the previous page via the submit button labeled update
    $hostname = 'localhost';
    $dbusername = 'kmstk5';
    $dbpassword = '75e93c2';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

    $sql = "SELECT * FROM Employee WHERE Emp_ID = '" . $pk . "'";

    $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));

    $updateEmp = "UPDATE Employee SET Emp_fname = ?, Emp_lname = ?, Emp_Password = ?, Emp_Type = ? WHERE Emp_ID = ?";

    echo "<form method='post' action='updateEmp.php'>";
    echo "<table class='table' align='center' class='result'>";
    echo "<thead>";

    while($field = mysqli_fetch_field($result)) {
      echo "<th class='result'>" . $field->name . "<br></th>";
    }

    while($row = mysqli_fetch_row($result)) {
      echo "<tr class='result'>";
      $counter = 0;
      foreach ($row as $value) {
        switch ($counter) {
            case 0: echo "<td class='result' ><input class='form-control' type='text' name='Emp_ID' value=" . $value . " readonly><br></td>";
            break;
            case 1: echo "<td class='result'><input class='form-control' type='text' name='Emp_Password' value=" . $value . "><br></td>";
            break;
            case 2: echo "<td class='result'><input class='form-control' type='text' name='Emp_Type' value=" . $value . "><br></td>";
            break;
            case 3: echo "<td class='result'><input class='form-control' type='text' name='Emp_fname' value=" . $value . "><br></td>";
            break;
            case 4: echo "<td class='result'><input class='form-control' type='text' name='Emp_lname' value=" . $value . "><br></td>";
            break;
        }

        $counter++;
      }
      echo "</tr>";
    }

    echo "<tr><td colspan='6' align='center'><br><button type='submit' class='btn btn-primary' name='save' value='$updateEmp'>Update Employee Account</td></tr>";
    echo "</thead>";
    echo "</table>";
    echo "</form";
  }

  if (isset($_POST['save'])) {
    $updateEmp = $_POST['save'];
    $pk = $_POST['Emp_ID'];
    $link = mysqli_connect("localhost", "ndtptb", "T!958684", "CS3380GRP23");

    $sqlFind = "SELECT Emp_Type From Employee WHERE Emp_ID= '" . $pk . "'";

    $deleteEmp = "DELETE FROM Employee WHERE Emp_ID= '" . $pk . "'";
    $deletePilot = "DELETE FROM Pilot WHERE Emp_ID= '" . $pk . "'";
    $deleteAtt = "DELETE FROM Flight_Att WHERE Emp_ID= '" . $pk . "'";
    $deleteAdmin = "DELETE FROM Administrator WHERE Emp_ID= '" . $pk . "'";

    $addPilot = "INSERT INTO Pilot(Emp_ID, Emp_Password, Pil_Status, Pil_Hours, Pil_Rank) VALUES (?, ?, ?, ?, ?)";
    $addAtt = "INSERT INTO Flight_Att(Att_Rank, Emp_ID, Emp_Password) VALUES (?, ?, ?)";
    $addAdmin = "INSERT INTO Administrator(Admin_Role, Emp_ID, Emp_Password) VALUES (?, ?, ?)";


    if($stmt = mysqli_prepare($link, $updateEmp)) {
      mysqli_stmt_bind_param($stmt, "sssii", $_POST['Emp_fname'], $_POST['Emp_lname'], $_POST['Emp_Password'], $_POST['Emp_Type'], $_POST['Emp_ID']);

      //Removing the Employee from their old Emp_Type specific table so they can be added to their new correct one.
      $result = mysqli_query($link, $sqlFind) or die("Query Error: " . mysqli_error($link));
      $type = mysqli_fetch_row($result);
      switch ($type[0]) { //we delete the user before updating so their specific old type account is not lost
        case 0:
        $deletestmt = mysqli_prepare($link, $deleteAdmin);
        mysqli_stmt_execute($deletestmt);
          break;
        case 1:
        $deletestmt = mysqli_prepare($link, $deletePilot);
        mysqli_stmt_execute($deletestmt);
          break;
        case 2:
        $deletestmt = mysqli_prepare($link, $deleteAtt);
        mysqli_stmt_execute($deletestmt);
          break;
        default:
          echo "Employee type was not found, couldn't delete from Emp_Type specific table.";
          break;
      }

      if(mysqli_stmt_execute($stmt)) {
        echo "<br><div align='center'>Employee Saved!</div><br>";
        echo '<a class="btn btn-lg btn-primary btn-block" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/UserMan.php">Return To User Managment</a>';

        //Adding updated user to their new Emp_Type table.
        $rank="Junior"; //Default Starting Rank. Can be updated by user in profile.
        $hours="0";
        $status="1";
        switch ($_POST['Emp_Type']) {
          case 0:
          $Admin_Role = 1;
          $addstmt = mysqli_prepare($link, $addAdmin);
          mysqli_stmt_bind_param($addstmt, "iis", $Admin_Role, $_POST['Emp_ID'], $_POST['Emp_Password']);
          mysqli_stmt_execute($addstmt);
            break;
          case 1:
          $addstmt = mysqli_prepare($link, $addPilot);
          mysqli_stmt_bind_param($addstmt, "isiis", $_POST['Emp_ID'], $_POST['Emp_Password'], $status, $hours, $rank);
          mysqli_stmt_execute($addstmt);
            break;
          case 2:
          $addstmt = mysqli_prepare($link, $addAtt);
          mysqli_stmt_bind_param($addstmt, "sis", $rank, $_POST['Emp_ID'], $_POST['Emp_Password']);
          mysqli_stmt_execute($addstmt);
            break;

          default:
            echo "Employee added, but was not assigned to designated table.";
            break;
        }
      }
      else {
        echo "<br><div align='center'>Employee did not save correctly! Try again or contact Server Administrator.</div><br>";
        echo '<a class="btn btn-lg btn-primary btn-block" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/UserMan.php">Return To User Managment</a>';
      }
    }
    else {
      echo "Update Fail. Line 226.";
    }
  }
?>
