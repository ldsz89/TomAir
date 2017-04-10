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

  <title>Toms Air - Update Equipment</title>
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
            <li><a href="UserMan.php">User Management</a></li>
            <li><a href="LogView.php">Log Viewer</a></li>
            <li class="active"><a href="EquipUp.php">Update Equipment</a></li>
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
    $pk=$_POST['update'];
    $hostname = 'localhost';
    $dbusername = 'CS3380GRP23';
    $dbpassword = 'e7d18aa';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 104" . mysqli_connect_error());

    $sql = "SELECT * FROM Equipment WHERE Equip_Serial = '" . $pk . "'";

    $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));

    $updateEquip = "UPDATE Equipment SET Equip_Num = ?, Equip_Name = ?, Equip_Pilots_Req = ?, Equip_Att_Req = ?, Equip_Seating = ? WHERE Equip_Serial = ?";

    echo "<form method='post' action='updateEquip.php'>";
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
            case 0: echo "<td class='result' ><input class='form-control' type='text' name='Equip_Num' value=" . $value . "><br></td>";
            break;
            case 1: echo "<td class='result'><input class='form-control' type='text' name='Equip_Name' value=" . $value . "><br></td>";
            break;
            case 2: echo "<td class='result'><input class='form-control' type='text' name='Equip_Serial' value=" . $value . " readonly><br></td>";
            break;
            case 3: echo "<td class='result'><input class='form-control' type='number' name='Equip_Pilots_Req' value=" . $value . "><br></td>";
            break;
            case 4: echo "<td class='result'><input class='form-control' type='number' name='Equip_Att_Req' value=" . $value . "><br></td>";
            break;
            case 5: echo "<td class='result'><input class='form-control' type='number' name='Equip_Seating' value=" . $value . "><br></td>";
            break;
        }

        $counter++;
      }
      echo "</tr>";
    }

    echo "<tr><td colspan='6' align='center'><br><button type='submit' class='btn btn-primary' name='save' value='$updateEquip'>Update Equipment</td></tr>";
    echo "</thead>";
    echo "</table>";
    echo "</form";
  }

  if (isset($_POST['save'])) {
    $hostname = 'localhost';
    $dbusername = 'CS3380GRP23';
    $dbpassword = 'e7d18aa';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 157" . mysqli_connect_error());
    $updateEmp = $_POST['save'];
    $pk = $_POST['Equip_Serial'];


    if($stmt = mysqli_prepare($link, $updateEmp)) {
      mysqli_stmt_bind_param($stmt, "ssiiis", $_POST['Equip_Num'], $_POST['Equip_Name'], $_POST['Equip_Pilots_Req'], $_POST['Equip_Att_Req'], $_POST['Equip_Seating'], $_POST['Equip_Serial']);

      //Removing the Employee from their old Emp_Type specific table so they can be added to their new correct one.
      if(mysqli_stmt_execute($stmt)) {
        echo "<br><div align='center'>Equipment Saved!</div><br>";
        echo '<a class="btn btn-lg btn-primary btn-block" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/EquipUp.php">Return To Equipment Managment</a>';


      }
      else {
        echo "<br><div align='center'>Equipment did not save correctly! Try again or contact Server Administrator. Execute Failure.</div><br>";
        echo '<a class="btn btn-lg btn-primary btn-block" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/EquipUp.php">Return To Equipment Managment</a>';
      }
    }
    else {
      echo "Update Failure. Line 178. Prepare Failed";
    }
  }
?>
