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

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title>Toms Air - Admin Dashboard</title><!-- making the page title template. This is similar throughout the admin dash. -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- adding bootstraps resources. This includes jquery,min.css,min.js, and a few other files located in the js and css folders. -->
  <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/i18n/defaults-*.min.js"></script>


  <style>

	body {
        background-image: url("Background/CloudP.jpg");
        background-color: #f7f7f7; // Backup background color
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
        <li class="active"><a href="AdminDash.php">Dashboard</a></li> <!-- active sets that tab as depressed on the page. This is the glory of bootsttrap at work -->
        <li><a href="UserMan.php">User Management</a></li>
        <li><a href="LogView.php">Log Viewer</a></li>
        <li><a href="EquipUp.php">Update Equipment</a></li>
        <li><a href="FlightUp.php">Update Flights</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
      <p class="navbar-text navbar-right">Signed in as <a href="#" class="navbar-link"><?php echo $_SESSION['name']; ?></a></p>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Admin Dashboard</h1>
    <?php
      echo "<p>Welcome " . $_SESSION['name'] . "</p>";
    ?>
  </div>
</div>

<div class="container-fluid bg-3 text-center">
  <h3><b>Click the tabs above to make changes</b></h3><br><br><br><br><br><br><br><br>

<!--
    <div class="">
        <select class="selectpicker" multiple="">
        <optgroup label="Pilot">
            <?php
                $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
                $query ="SELECT Emp_ID FROM Employee WHERE Emp_Type = '1'";
                $result = mysqli_query($link, $query);

                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        foreach($row as $val) {
                            echo "<option value='". $row[0] ."'>". $row[0] ."</option>";
                        }
                    }
            ?>
        </optgroup>
    </select>
    </div>
-->

<!--  <div class="row">
    <div class="col-sm-3">
      <p class="equipType"><b>747</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/Boeing_747.jpeg" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn748423805] <br>
      Departed at 5:00 P.M.</p>
    </div>
    <div class="col-sm-3">
      <p class="equipType"><b>747</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/Boeing_747.jpeg" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn743353805] <br>
      Departed at 3:45 P.M.</p>
    </div>
    <div class="col-sm-3">
      <p class="equipType"><b>Airbus A380</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/A380.jpg" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn343353805] <br>
      Departed at 4:00 P.M.</p>
    </div>
    <div class="col-sm-3">
      <p class="equipType"><b>Boeing 777</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/Boeing_777.PNG" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn777563058] <br>
      Departed at 4:20 P.M.</p>
  </div>
</div><br>

<div class="container-fluid bg-3 text-center">
  <div class="row">
    <div class="col-sm-3">
      <p class="equipType"><b>Hot Gas Powered Plane</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/Trump.jpg" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn66614185] <br>
      Departed at 5:30 P.M.</p>
    </div>
    <div class="col-sm-3">
      <p class="equipType"><b>Boeing 777</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/Boeing_777.PNG" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn77702348] <br>
      Departed at 3:00 P.M.</p>
    </div>
    <div class="col-sm-3">
      <p class="equipType"><b>Airbus A380</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/A380.jpg" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn38058140] <br>
      Departed at 3:30 P.M.</p>
    </div>
    <div class="col-sm-3">
      <p class="equipType"><b>747</b></p>
      <img src="http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Planes/Boeing_747.jpeg" class="img-responsive" style="width:100%" alt="747">
      <p class="flightDesc">Flight [nnnnn747424615] <br>
        Departed at 3:30 P.M.</p>
    </div>
  </div> -->
</div><br><br>

<footer id="footer" class="container-fluid text-center">
  <p>Developed by: Group 23</p>
  <p>Report Bug: <a href="mailto:Ndtptb@mail.missouri.edu?Subject=Contacted%20from%20Website" target="_top">Ndtptb@mail.missouri.edu</a></p>
  <p>Designed With: Bootstrap V3</p>
</footer>

</body>
</html>
