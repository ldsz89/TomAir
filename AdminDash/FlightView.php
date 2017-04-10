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
	<title>Gallery</title>
  <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
   <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style type="text/css">
    a.fancybox img {
        border: none;
        box-shadow: 0 1px 7px rgba(0,0,0,0.6);
        -o-transform: scale(1,1); -ms-transform: scale(1,1); -moz-transform: scale(1,1); -webkit-transform: scale(1,1); transform: scale(1,1); -o-transition: all 0.2s ease-in-out; -ms-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -webkit-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out;
      }
      a.fancybox:hover img {
          position: relative; z-index: 999; -o-transform: scale(1.03,1.03); -ms-transform: scale(1.03,1.03); -moz-transform: scale(1.03,1.03); -webkit-transform: scale(1.03,1.03); transform: scale(1.03,1.03);
      }

      body {
        background-color: #f7f7f7;
        /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
      }

      img {
          border-style: ridge;
          border-radius: 7px;
          display: inline;
          margin: 10px 50px;
          width: 250px;;
          height: auto;
          /*-webkit-transition: -webkit-transform 0.3s;
          transition: transform 0.5s;*/
      }

      div {

          text-align: center;
        }

    /* img:active
      {
        -webkit-transform: scale(2,2);
        transform: scale(2,2);
        box-shadow: 0 0 10px #555
      }*/

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
							<li class="active"><a href="FlightView.php">Flight Viewer</a></li>
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

      $hostname = 'localhost';
      $dbusername = 'CS3380GRP23';
      $dbpassword = 'e7d18aa';
      $database = 'CS3380GRP23';

      $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

      $sql = "SELECT Fli_Num AS Flight_Number, Fli_Dep_Time AS Departure_Time, Fli_Dep_Date AS Depature_Date, Fli_Availibility AS Availibility, Fli_Price AS Price, Fli_Dep_City AS Depature_City, Fli_Arr_City AS Arrival_City, Equip_Serial AS Equipment_Serial FROM Flights;";
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

        echo "<td><form method='POST' action='FlightUp.php'>";
        echo "<button class='btn btn-primary' type='submit' name='update' value='$pk'>Update";
        echo "</form></td>";
        echo "<td><form method='POST' action='deleteFlight.php'>";
        echo "<button class='btn btn-primary' type='submit' name='delete' value='$pk'>Delete";
        echo "</form></td>";
      }
      echo "</tr>";
  ?>
