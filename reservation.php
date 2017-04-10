<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
    <head>
        <title>Reserve Flight</title>
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
                background-image: url("http://cs3380.rnet.missouri.edu/~ndtptb/Group/Portfolio/Background/Wood.jpg");
                background-color: #f7f7f7;
                /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
            }

            .row {
                background:rgba(0,0,0,0.6);
                padding: 15px;
            }
            
            h3 {
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

            #content {
                text-align: center;
            }

            #label {
                text-align: right;
                color: white;
            }
            
            #baggage {
                
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
                            <?php
                                if(isset($_SESSION['Cust_ID'])) {
                                    echo "<li><a href='Login/clogout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
                                }
                                else {
                                    echo "<li><a href='CustDash/login.php'><span class='glyphicon glyphicon-log-in'></span> Customer Login</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav><br>

            <div class="container jumbotron text-center">
                <table class="table">
                    <thead><h3>Flight Details</h3>
                        <th>Flight Num</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Departure Date</th>
                        <th>Availibility</th>
                        <th>Departure City</th>
                        <th>Arrival City</th>
                        <th>Price</th>
                    </thead>
                    
                    <tr>
                        <td><?php echo $_POST['Fli_Num']; ?></td>
                        <td><?php echo $_POST['Fli_Dep_Time'] ?></td>
                        <td><?php echo $_POST['Fli_Arr_Time'] ?></td>
                        <td><?php echo $_POST['Fli_Dep_Date'] ?></td>
                        <td><?php echo $_POST['Fli_Availibility'] ?></td>
                        <td><?php echo $_POST['Fli_Dep_City'] ?></td>
                        <td><?php echo $_POST['Fli_Arr_City'] ?></td>
                        <td><?php echo $_POST['Fli_Price'] ?></td>
                    </tr>
                </table>
                <div class="row text-center">
                    <form method="POST" action="confirmation.php" class="form-inline">
                        <div class="form-group text-center">
                            <div class="form-group" id="baggage">
                                
                                <input type='hidden' name='Fli_Num' value='<?php echo $_POST['Fli_Num']; ?>'>
                                <input type='hidden' name='Fli_Dep_Time' value='<?php echo $_POST['Fli_Dep_Time'] ?>'>
                                <input type='hidden' name='Fli_Arr_Time' value='<?php echo $_POST['Fli_Arr_Time'] ?>'>
                                <input type='hidden' name='Fli_Dep_Date' value='<?php echo $_POST['Fli_Dep_Date'] ?>'>
                                <input type='hidden' name='Fli_Availibility' value='<?php echo $_POST['Fli_Availibility'] ?>'>
                                <input type='hidden' name='Fli_Dep_City' value='<?php echo $_POST['Fli_Dep_City'] ?>'>
                                <input type='hidden' name='Fli_Arr_City' value='<?php echo $_POST['Fli_Arr_City'] ?>'>
                                <input type='hidden' name='Fli_Price' value='<?php echo $_POST['Fli_Price'] ?>'>
                                
                                <div class="input-group">
                                    <span class="input-group-addon">How many bags are you bringing?</span>
                                    <input type="number" name="Baggage" id="baggage" min="0" max="10" class="form-control">
                                </div>
                                <input type="submit" name="submit" value="Submit" class="btn btn-default">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <footer id="footer" class="container-fluid text-center">
                <p>Developed by: Group 23</p>
                <p>Report Bug: <a href="mailto:Ndtptb@mail.missouri.edu?Subject=Contacted%20from%20Website" target="_top">Ndtptb@mail.missouri.edu</a></p>
                <p>Designed With: Bootstrap V3</p>
            </footer>
        </body>
</html>