<?php
    session_start();
    if(isset($_SESSION['Emp_Type'])){
        if (($_SESSION['Emp_Type']) != 1){
            header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
        }
    }
    else {
        header("Locatoin: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Certifications</title>
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
                    <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/PilotDash.php">Pilot</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/PilotDash.php">Dashboard</a></li>
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/Certifications.php">Certifications</a></li>
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/FlightViewer.php">Flight Viewer</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/PilotProfile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    
        <div class=" container jumbotron text-center">
            <h1>Pilot Dashboard</h1>
            <p>Fly us to higher places</p>
            <div class="text-center">
                <?php
                    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
                    $query = "SELECT DISTINCT Equip_Num, Equip_Name AS Name, Equip_Pilots_Req AS 'Pilots Required', Equip_Att_Req AS 'Attendants Required' FROM Equipment, Certifications WHERE Equipment.Equip_Serial = Certifications.Equip_Serial AND Emp_ID = ".$_SESSION['Emp_ID'];
    
                    $result = mysqli_query($link, $query);
    
                    echo "<table class='table'><thead>";
                    echo "<h3>Current certifications</h3>";
                    //Header loop
                    while($row = mysqli_fetch_field($result)) {
                        echo"<th>".$row->name."</th><br>";
                    }
                    echo "</thead>";
    
                    //For each row
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        echo "<tr>";
                        foreach($row as $val) {
                            echo "<td>".$val."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
            </div>
            <div class="jumbotron">
                <?php
                    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
                    $query = "SELECT Flights.Fli_Num AS 'Flight Num', Fli_Dep_Time AS 'Departure Time', Fli_Dep_Date AS 'Departure Date', Fli_Availibility AS 'Availibility', Fli_Dep_City AS 'Departure City', Fli_Arr_City AS 'Arrival City' FROM Flights, Flight_Assign WHERE Flight_Assign.Fli_Num = Flights.Fli_Num";
    
                    $result = mysqli_query($link, $query);
    
                    echo "<table class='table'><thead>";
                    echo "<h3>Assigned Flights</h3>";
                    //Header loop
                    while($row = mysqli_fetch_field($result)) {
                        echo"<th>".$row->name."</th><br>";
                    }
                    echo "</thead>";
    
                    //For each row
                    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                        echo "<tr>";
                        foreach($row as $val) {
                            echo "<td>".$val."</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>
            </div>
        </div>

        <footer id="footer" class="container-fluid text-center">
            <p>Developed by: Group 23</p>
            <p>Report Bug: <a href="mailto:Ndtptb@mail.missouri.edu?Subject=Contacted%20from%20Website" target="_top">Ndtptb@mail.missouri.edu</a></p>
            <p>Designed With: Bootstrap V3</p>
        </footer>

</body>
</html>
