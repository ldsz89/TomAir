<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TomAir - Home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!--        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            body {
                background-image: url("Background/Plane.jpg");
                background-color: #f7f7f7;
                background-position: top left;
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

            #content {
                text-align: center;
            }

            #radio {
                text-align: right;
                color: white;
            }

            #city_search {
                text-align: right;
            }

            .row {
                padding: 15px;
            }

            /* Add a gray background color and some padding to the footer */
            footer {
                background-color: #C05F5F;
                padding: 15px;
                position: absolute;
                bottom: 0;
                width: 100%;
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
                    <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/index.php">TomAir</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/flights.php">Flights</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php"><span class="glyphicon glyphicon-log-in"></span> Employee Login</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="CustDash/login.php"><span class="glyphicon glyphicon-log-in"></span> Customer Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="jumbotron text-center">
                <h1>Welcome to Tom Air!</h1>
                <div>
                    <form method="POST" action="flights.php">
                        <button type="submit" class="btn btn-default" aria-label="Left Align">
                            Click the arrow to see all flights
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <footer id="footer" class="container-fluid text-center">
            <p>Developed by: Group 23</p>
            <p>Report Bug: <a href="mailto:Ndtptb@mail.missouri.edu?Subject=Contacted%20from%20Website" target="_top">Ndtptb@mail.missouri.edu</a></p>
            <p>Designed With: Bootstrap V3</p>
        </footer>
    </body>
</html>