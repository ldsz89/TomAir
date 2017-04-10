<?php
  session_start();
  if (($_SESSION['Emp_Type']) != 2){
    header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title>Attendant Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<!--  <link rel="stylesheet" href="css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <style>

            body {
                background-image: url("http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Background/Wood.jpg");
                background-color: #f7f7f7;
                /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
            }

            h3 {
                color: white;
            }

            .row {
                background:rgba(0,0,0,0.6);
                color: white;
            }

            .col-sm-3 {
                border: 2px;
                font-size: 30px;
                color: black;
                background:rgba(0,0,0,0.4);
            }

            .jumbotron
            {
                background-color: #C05F5F;
            }

            /* Remove the navbar's default margin-bottom and rounded borders */
            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            }

    /* Add a gray background color and some padding to the footer */
            footer {
                background-color: #C05F5F;
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
      <a class="navbar-brand" href="FlightAttendant.php">Attendant</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="FlightAttendant.php">Dashboard</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="AttProfile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
        <li><a href="../Login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <div class="jumbotron text-center">
		<h1>Attendant Dashboard</h1>
            <p>Fly us to higher places<p>
            <div>
                <?php

                    $hostname = 'localhost';
                    $username = 'CS3380GRP23';
                    $password = 'e7d18aa';
                    $database = 'CS3380GRP23';
                    $link = mysqli_connect($hostname, $username, $password, $database) or die ("Connection error on line 48: " . mysqli_connect_error());

                    function executeQuery($sql){
                        global $link;
                        $result = mysqli_query($link, $sql) or die ("Query Error: " . mysqli_error($link));
                        echo "<table class='table table-hover'><thead>";
                        while($fieldinfo = mysqli_fetch_field($result)){
                            echo "<th>".$fieldinfo->name."</th>";
                        }

                        while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
                            echo "<tr>";
                            foreach($row as $r){
                                echo "<td>$r</td>";
                            }
                            echo"</tr>";
                        }
                    }

                    executeQuery("SELECT * FROM Flights INNER JOIN Flight_Assign ON Flights.Fli_Num = Flight_Assign.Fli_Num WHERE Flight_Assign.Emp_ID = ".$_SESSION['Emp_ID']);

                ?>
            </div>
        </div>
    </div>

    </body>
</html>
