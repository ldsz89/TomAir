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
	<title>Log Managment</title>
  <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
   <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style type="text/css">

      body {
        background-color: #f7f7f7;
        /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
      }

      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
      }

      .mytable>tbody>tr>td, .mytable>tbody>tr>th, .mytable>tfoot>tr>td, .mytable>tfoot>tr>th, .mytable>thead>tr>td, .mytable>thead>tr>th {
          padding: 12px;
          background-color: rgba(0, 255, 255, 0.3);;
          color: black;
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
							<li class="active"><a href="LogView.php">Log Viewer</a></li>
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

      $hostname = 'localhost';
      $dbusername = 'CS3380GRP23';
      $dbpassword = 'e7d18aa';
      $database = 'CS3380GRP23';

      $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 83" . mysqli_connect_error());

      $sql = "SELECT Log_Num AS `Number`, Log_IP_Address AS `Host Address`, Log_Date AS `Date`, Log_Time AS `Time`, Log_Action AS `Action Performed`, Log_User AS User, Cust_ID AS `Customer Id`, Emp_ID AS `Employee Id` FROM `Log`;";
      $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));
      echo "<table class='table table-hover'><thead>";
      while($fieldinfo = mysqli_fetch_field($result)){
        echo "<th>".$fieldinfo->name."</th>";
      }
      echo "</thead>";
      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo "<tr>";
        $counter = 0;
        foreach ($row as $r) {
          echo "<td>$r</td>";
          if ($counter==0){
            $pk=$r;
          }
          $counter++;
        }

        echo "<td><form method='POST' action='deleteLog.php'>";
        echo "<button class='btn btn-primary' type='submit' name='delete' value='$pk'>Delete";
        echo "</form></td>";
      }
      echo "</tr>";


  ?>
