<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>

  <title>Flight Attendant Dashboard</title>
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
        background-image: url("Background/Wood.jpg");
        background-color: #f7f7f7;
        /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
      }

     img
      {
        -webkit-transform: scale(1,1);
        transform: scale(1, 1);
        box-shadow: 0 0 10px #555
      }

      h3 {
        color: white;
      }

      .row {
        background:rgba(0,0,0,0.6);
      }

      .flightDesc {
        color: white;

        border: 2px;
        border-style: solid;
        border-color: grey;
      }

      .equipType {
        color: white;
        background:rgba(0,0,0,0.6);
        border: 2px;
        border-style: solid;
        border-color: grey;
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
      <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/FlightDash.php">Flight Attendant</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/FlightDash.php">Dashboard</a></li>
        <li><a href="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/FlightView.php">Flight Viewer</a></li>
        <li><a href="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/LogView.php">Log Viewer</a></li>
        <li><a href="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/EquipUp.php">Update Equipment</a></li>
        <li><a href="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/FlightUp.php">Update Flights</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://cs3380.rnet.missouri.edu/~ndtptb/hw2/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <div class="jumbotron text-center">
            <p>Thinking that this page will basically be a summary of the employee/customer. It'll list their current certifications and all upcoming and previous flights</p>
            
            <p>The links at the top could take them to separate pages where they can view the information again but also add to it. For example, pilots adding more certifications or customers adding more flight reservations.</p>
        </div>
    </div>

<footer id="footer" class="container-fluid text-center">
  <p>Developed by: Group 23</p>
  <p>Report Bug: <a href="mailto:Ndtptb@mail.missouri.edu?Subject=Contacted%20from%20Website" target="_top">Ndtptb@mail.missouri.edu</a></p>
  <p>Designed With: Bootstrap V3</p>
</footer>

</body>
</html>