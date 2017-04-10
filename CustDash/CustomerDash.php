<?php
    session_start();
    if(!isset($_SESSION['Cust_ID'])) {
        header("Location: login.php");
        exit;
    }
    else {
        $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
        $query = "SELECT Cust_First_Name, Cust_Last_Name FROM Customer WHERE Cust_ID = ".$_SESSION['Cust_ID'];
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        $_SESSION['Cust_First_Name'] = $row[0];
        $_SESSION['Cust_Last_Name'] = $row[1];
        
        mysqli_close($link);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Customer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>

            body {
                background-image: url("../Background/Wood.jpg");
                background-color: #f7f7f7;
                /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
            }

            h3 {
                color: white;
            }

            .jumbotron h1 {
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

            .jumbotron {
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
                    <a class="navbar-brand" href="CustomerDash.php">Customer - <?php echo $_SESSION['Cust_ID']; ?></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="CustomerDash.php">Dashboard</a></li>
                        <li><a href="Reservations.php">Reservations</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="CustomerProfile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/clogout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="jumbotron text-center">
                <?php
                    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
                    
                    if(isset($_SESSION['Cust_First_Name'])) {
                        echo "<h1>Welcome ".$_SESSION['Cust_First_Name']." ".$_SESSION['Cust_Last_Name']."</h1>";
                    }
                    else {
                        echo "<h1>Welcome</h1>";
                    }

                    $cust_query = "SELECT * FROM Customer WHERE Cust_ID = '" . $_SESSION['Cust_ID'] . "'";
                    $cust_result = mysqli_query($link, $cust_query);


                    $query = "SELECT Reservations.Fli_Num AS 'Flight Number', Fli_Dep_Date AS 'Flight Date', Res_Num_Baggage AS Baggage FROM Reservations, Flights WHERE Cust_ID = '" . $_SESSION['Cust_ID'] . "' AND Reservations.Fli_Num = Flights.Fli_Num";
                    $result = mysqli_query($link, $query);

                    echo "<table class='table'><thead>";
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
