
<!DOCTYPE html>
<?php
    session_start();
    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
     function printTable($result) {
         echo "<table class='table table-hover'>";

        echo "<thead>";
        while ($field = mysqli_fetch_field($result)) {
            echo "<th>" . $field->name . "</th>\n";
        }

        echo "<th>Reserve</th>\n";
        echo "</thead>";

        while ($row = mysqli_fetch_row($result)) {
            echo "<tr>";

            foreach($row as $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "<td>";

            /* Reserve Button */
            echo "<form method='POST' action='reservation.php'>";

            echo "<input type='hidden' name='Fli_Num' value='$row[0]'>";
            echo "<input type='hidden' name='Fli_Dep_Time' value='$row[1]'>";
            echo "<input type='hidden' name='Fli_Arr_Time' value='$row[2]'>";
            echo "<input type='hidden' name='Fli_Dep_Date' value='$row[3]'>";
            echo "<input type='hidden' name='Fli_Availibility' value='$row[4]'>";
            echo "<input type='hidden' name='Fli_Dep_City' value='$row[5]'>";
            echo "<input type='hidden' name='Fli_Arr_City' value='$row[6]'>";
            echo "<input type='hidden' name='Fli_Price' value='$row[7]'>";

            echo "<input type='submit' name='reserve' value='Reserve' class='btn'>";
            echo "</form>";
            echo "</td>";

            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
     }
?>
<html lang="en">
    <head>
        <title>Flights</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input[type="radio"]').click(function() {
                    if($(this).attr('id') == "City") {
                        $('#City_Sec').fadeIn("slow");
                    }
                    else {
                        $('#City_Sec').fadeOut("slow");
                    }
                    if($(this).attr('id') == "Day_Time") {
                        $('#Day_Time_Sec').fadeIn("slow");
                    }
                    else {
                        $('#Day_Time_Sec').fadeOut("slow");
                    }
                    if($(this).attr('id') == "Price") {
                        $('#Price_Sec').fadeIn("slow");
                    }
                    else {
                        $('#Price_Sec').fadeOut("slow");
                    }
                });
            });
        </script>
        <style>
            body {
                background-image: url("Background/Plane.jpg");
                background-color: #f7f7f7;
                color: white;
                /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
            }

            h1,h3 {
                color: white;
            }

            .row {
                padding: 15px;
                background:rgba(0,0,0,0.6);
            }

/*
            .col-sm-3 {
                border: 2px;
                font-size: 30px;
                color: black;
                background:rgba(0,0,0,0.4);
            }
*/

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
            
            #warning {
                background-color: palevioletred;
            }
            
            #Day_Time_Sec, #City_Sec, #Price_Sec {
                display:none;
            }
            
            label {
                color: white;
            }
            
            .well {
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
                    <a class="navbar-brand" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/index.php">TomAir</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/flights.php">Flights</a></li>
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

        <div class="container jumbotron">
            <div class="text-center"><h1>Flights</h1></div>
            <div class="row">
                <div class="form-group">

                    <label for="Emp_Type_Sel">Search By (select one):</label><br>
                    <input type="radio" name="Type" id="City" value="0" checked="check">City<br>
                    <input type="radio" name="Type" id="Day_Time" value="1">Day/Time<br>
					<input type="radio" name="Type" id="Price" value="2">Price<br>
                    <br>
                    <p>To see all availible flights, click search, but leave search fields blank</p>
                    <hr>
                    <form action="flights.php" method="POST">
                        <div class="City" id="City_Sec" style="display:none;">
                            <h3>City Search:</h3>
                            <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Departure City</span>
                                <input type="text" name="Fli_Dep_City_Search" class="form-control" placeholder="Leave blank to only search for arrival cities">
                                <span class="input-group-addon" id="basic-addon1">Arrival City</span>
                                <input type="text" name="Fli_Arr_City_Search" class="form-control" placeholder="Leave blank to only search for departure cities">
                            </div>
                            <input type="submit" class="btn btn-default" value="Search">
                        </div>
                    </form>

                    <form action="flights.php" method="POST">
                        <div class="Day_Time" id="Day_Time_Sec" style="display: none;">
                            <h3>Day/Time Search:</h3>
                            <div class="input-group">
                                <span class="input-group-addon">Departure Date</span>
                                <input type="date" name="Fli_Dep_Date_Search" min="1980-01-01" class="form-control">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Departure Time</span>
                                <input type="time" name="Fli_Dep_Time_Search" class="form-control">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Arrival Time</span>
                                <input type="time" name="Fli_Arr_Time_Search" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-default" value="Search">
                        </div>
                    </form>
                        <br>

                    <form action="flights.php" method="POST">
                        <div class="Price" id="Price_Sec" style="display: none;">
                            <h3>Price:</h3>
                            <div class="input-group">
                                <span class="input-group-addon">Price</span>
                                <input type="number" name="Fli_Price_Search" min="0" max="3000" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-default" value="Search">
                        </div>
                    </form>
                </div>
            </div>
            <div class="jumbotron">
                <!--Here is the PHP code for the user to search for flights by city. It accounts for blank fields so the user can search by just departures or arrivals.-->
                <?php
                    if(isset($_POST['Fli_Dep_City_Search']) && isset($_POST['Fli_Arr_City_Search'])) {
                        $searchDepCity = $_POST['Fli_Dep_City_Search'] . "%";
                        $searchArrCity = $_POST['Fli_Arr_City_Search'] . "%";
                        $stmt = "";
                        
                        if(!empty($_POST['Fli_Dep_City_Search']) && (empty($_POST['Fli_Arr_City_Search']))){
                            $query = "SELECT Fli_Num AS Number, Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_Date AS Date, Fli_Availibility AS Availibility, Fli_Dep_City AS Departure, Fli_Arr_City AS Arrival, Fli_Price AS Price FROM Flights WHERE Fli_Dep_City LIKE ?";
                            $stmt = mysqli_prepare($link, $query);
                            mysqli_stmt_bind_param($stmt, 's', $searchDepCity);
                        }
                        else if(!empty($_POST['Fli_Arr_City_Search']) && empty($_POST['Fli_Dep_City_Search'])) {
                            $query = "SELECT Fli_Num AS Number, Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_Date AS Date, Fli_Availibility AS Availibility, Fli_Dep_City AS Departure, Fli_Arr_City AS Arrival, Fli_Price AS Price FROM Flights WHERE Fli_Arr_City LIKE ?";
                            $stmt = mysqli_prepare($link, $query);
                            mysqli_stmt_bind_param($stmt, 's', $searchArrCity);
                        }
                        else {
                            $query = "SELECT Fli_Num AS Number, Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_Date AS Date, Fli_Availibility AS Availibility, Fli_Dep_City AS Departure, Fli_Arr_City AS Arrival, Fli_Price AS Price FROM Flights WHERE Fli_Dep_City LIKE ? OR Fli_Arr_City LIKE ?";
                            $stmt = mysqli_prepare($link, $query);
                            mysqli_stmt_bind_param($stmt, 'ss', $searchDepCity, $searchArrCity);
                        }
                            
                        if(mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result) < 1){
                                echo "<div class='well'>No results found</div>";
                            }
                            else {
                                printTable($result);
                            }
                            mysqli_stmt_close($stmt);
                        }
                        mysqli_close($link);
                    }
                ?>
                <!--This is php code for the user to search for flights via dates, arrival times, and departure times-->
                <?php
                    if(isset($_POST['Fli_Dep_Date_Search'])) {
                        $query = "";
                        if(!empty($_POST['Fli_Dep_Date_Search']) && !empty($_POST['Fli_Dep_Time_Search']) && !empty($_POST['Fli_Arr_Time_Search'])) {
                            $query = "SELECT Fli_Num AS Number, Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_Date AS Date, Fli_Availibility AS Availibility, Fli_Dep_City AS Departure, Fli_Arr_City AS Arrival, Fli_Price AS Price FROM Flights WHERE Fli_Dep_Date = '".$_POST['Fli_Dep_Date_Search']."' AND Fli_Dep_Time = '".$_POST['Fli_Dep_Time_Search']."' AND Fli_Arr_Time = '".$_POST['Fli_Arr_Time_Search']."'";
                        }
                        else if(!empty($_POST['Fli_Dep_Date_Search']) && empty($_POST['Fli_Dep_Time_Search']) && empty($_POST['Fli_Arr_Time_Search'])) {
                            $query = "SELECT Fli_Num AS Number, Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_Date AS Date, Fli_Availibility AS Availibility, Fli_Dep_City AS Departure, Fli_Arr_City AS Arrival, Fli_Price AS Price FROM Flights WHERE Fli_Dep_Date = '".$_POST['Fli_Dep_Date_Search']."'";
                        }
                        $result = mysqli_query($link, $query);
                        if(mysqli_num_rows($result) < 1){
                            echo "<div class='well'>No results found</div>";
                        }
                        else {
                            printTable($result);
                        }
                        mysqli_close($link);
                    }
                ?>
                <!--This is php code for the user to search for flights via prices-->
                <?php
                    if(isset($_POST['Fli_Price_Search'])) {
                        $stmt = "";
                        if(!empty($_POST['Fli_Price_Search'])) {
                            $query = "SELECT Fli_Num AS Number, Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_Date AS Date, Fli_Availibility AS Availibility, Fli_Dep_City AS Departure, Fli_Arr_City AS Arrival, Fli_Price AS Price FROM Flights WHERE Fli_Price = ?";
                            $stmt = mysqli_prepare($link, $query);
                            mysqli_stmt_bind_param($stmt, 'd', $_POST['Fli_Price_Search']);
                            if(mysqli_stmt_execute($stmt)) {
                                $result = mysqli_stmt_get_result($stmt);
                                if(mysqli_num_rows($result) < 1){
                                    echo "<div class='well'>No results found</div>";
                                }
                                else {
                                    printTable($result);
                                }
                                mysqli_stmt_close($stmt);
                            }
                            mysqli_close($link);
                        }
                        else{
                            $priceSearch = 0;
                            $query = "SELECT Fli_Num AS Number, Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_Date AS Date, Fli_Availibility AS Availibility, Fli_Dep_City AS Departure, Fli_Arr_City AS Arrival, Fli_Price AS Price FROM Flights";
                            $result = mysqli_query($link, $query);
                            printTable($result);
                            mysqli_close($link);
                        }
                    }
                ?>
            </div>
        </div>

    </body>
</html>