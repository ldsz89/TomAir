<!DOCTYPE html>
<?php
    ob_start();
    session_start();

    function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function generateRandomInt($length = 4) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
?>
<html lang="en">
    <head>
        <title>Confirm Reservation</title>
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
            
            label {
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
                    <thead><h3>Reservation Details</h3>
                        <th>Flight Num</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Departure Date</th>
                        <th>Availibility</th>
                        <th>Departure City</th>
                        <th>Arrival City</th>
                        <th>Price</th>
                        <th>Baggage</th>
                        <th>Calculated Price</th>
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
                        <td><?php echo $_POST['Baggage'] ?></td>
                        <td>
                            <?php
                                $baggage = $_POST['Baggage'];
                                $CPrice = $_POST['Fli_Price'] + (($_POST['Fli_Price'] * 0.2) * $baggage);
                                echo $CPrice;
                            ?>
                        </td>
                    </tr>
                </table>

                <div class="row text-center">
                    <form method="POST" action="index.php" class="form-horizontal">
                        <input type="submit" name="cancel" value="Cancel" class="btn btn-warning col-md-4">
                    </form>
<!--                    <form method="POST" action="CustDash/CustomerDash.php" class="form-horizontal">-->
                    <form method="POST" class="form-horizontal">
                        
                        <input type='hidden' name='Fli_Num' value='<?php echo $_POST['Fli_Num']; ?>'>
                        <input type='hidden' name='Fli_Dep_Time' value='<?php echo $_POST['Fli_Dep_Time'] ?>'>
                        <input type='hidden' name='Fli_Arr_Time' value='<?php echo $_POST['Fli_Arr_Time'] ?>'>
                        <input type='hidden' name='Fli_Dep_Date' value='<?php echo $_POST['Fli_Dep_Date'] ?>'>
                        <input type='hidden' name='Fli_Availibility' value='<?php echo $_POST['Fli_Availibility'] ?>'>
                        <input type='hidden' name='Fli_Dep_City' value='<?php echo $_POST['Fli_Dep_City'] ?>'>
                        <input type='hidden' name='Fli_Arr_City' value='<?php echo $_POST['Fli_Arr_City'] ?>'>
                        <input type='hidden' name='Fli_Price' value='<?php echo $_POST['Fli_Price'] ?>'>
                        <input type='hidden' name='Baggage' value='<?php echo $_POST['Baggage'] ?>'>
                        
                        <input type="submit" name="confirm" value="Confirm" class="btn btn-primary col-md-4 col-md-offset-4">
                        <div class="form-group">
                            <label for="Cust_ID" class="col-md-2 control-label">Already have an ID? Enter it here:</label>
                            <div class="col-md-9">
                                <?php
                                    if(isset($_SESSION['Cust_ID'])) {
                                        echo '<input type="number" class="form-control" id="Cust_ID" name="Cust_ID" value="'. $_SESSION['Cust_ID'] .'"readonly>';
                                    }
                                    else {
                                        echo '<input type="number" class="form-control" id="Cust_ID" name="Cust_ID" placeholder="First time? Leave this blank.">';
                                    }
                                ?>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php
                if(isset($_POST['confirm'])) {
//                    echo "<div class='well'>Confirm Pressed</div>";
                    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
                    
                    $Res_Num = generateRandomString();
//                    echo "<div class='well'>". $Res_Num ."</div>";
//                    $Res_Num = "'". $Res_Num ."'";
//                    echo "<div class='well'>". $Res_Num ."</div>";
                    $newRes = "INSERT INTO Reservations(Res_Num, Cust_ID, Fli_Num, Res_Num_Baggage) VALUES(?, ?, ?, ?)";
                    $_SESSION['Cust_First_Name'] = "";
                    
                    if(!empty($_POST['Cust_ID'])) {
//                        echo "<div class='well'>Customer ID: ". $_POST['Cust_ID'] ." | Fli_Num: ". $_POST['Fli_Num'] ."</div>";
                        $_SESSION['Cust_ID'] = $_POST['Cust_ID'];
                        if($stmt = mysqli_prepare($link, $newRes)) {
                            mysqli_stmt_bind_param($stmt, 'siii', $Res_Num, $_POST['Cust_ID'], $_POST['Fli_Num'], $baggage) or die("<div class='well'>Returning Customer Bind Failed</div>");
                            if(mysqli_stmt_execute($stmt)) {
                                date_default_timezone_set('America/Chicago');
                                $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Cust_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'RESERVATION MADE', 'CUSTOMER', ".$_SESSION['Cust_ID'].")";

                                if(!mysqli_query($link, $sql)){
                                    printf("Errormessage: %s\n", mysqli_error($link));
                                }
                                else {
                                    header("Location: CustDash/CustomerDash.php");
                                    mysqli_close($link);
                                    exit;
                                }
                            }
                            else{
                                echo "<div class='well'>Returning Cust Statment failed to execute: </div>";
                                echo "<div class='well'>Execute failed: (" . $stmt->errno . ") " . $stmt->error ."</div>";
                            }
                        }
                        else{
                            echo "<div class='well'>Old prepare failed</div>";
                        }
                    }
                    else {
//                        echo "<div class='well'>Customer ID not set</div>";
                        $Cust_ID = generateRandomInt();
                        $Cust_ID = (int)$Cust_ID;
                        $_SESSION['Cust_ID'] = $Cust_ID;
//                        echo "<div class='well'>Generated: ". $Cust_ID ." | Session: ". $_SESSION['Cust_ID'] ."</div>";
                        
                        $newCust = "INSERT INTO Customer(Cust_ID) VALUES(". $Cust_ID .")";
                        echo "<div class='well'>". $newCust ."</div>";
                        if(mysqli_query($link, $newCust)) {
                            date_default_timezone_set('America/Chicago');
                            $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Cust_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'NEW CUSTOMER MADE', 'CUSTOMER', ".$_SESSION['Cust_ID'].")";

                            if(!mysqli_query($link, $sql)){
                                printf("Errormessage: %s\n", mysqli_error($link));
                            }
                            if($stmt = mysqli_prepare($link, $newRes)) {
                                mysqli_stmt_bind_param($stmt, 'siii', $Res_Num, $Cust_ID, $_POST['Fli_Num'], $baggage) or die("<div class='well'>New Customer Bind Failed</div>");
                                if(mysqli_stmt_execute($stmt)) {
                                    date_default_timezone_set('America/Chicago');
                                    $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Cust_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'RESERVATION MADE', 'CUSTOMER', ".$_SESSION['Cust_ID'].")";
                                    
                                    if(!mysqli_query($link, $sql)){
                                        printf("Errormessage: %s\n", mysqli_error($link));
                                    }
                                    else {
                                        header("Location: CustDash/CustomerDash.php");
                                        mysqli_close($link);
                                        exit;
                                    }
                                }
                                else {
                                    echo "<div class='well'>New customer reservation Statment failed to execute</div>";
                                    echo "<div class='well'>Execute failed: (" . $stmt->errno . ") " . $stmt->error ."</div>";
                                }
                            }
                            else {
                                echo "<div class='well'>New reservation prepare failed</div>";
                            }
                        }
                    }
                }
            ?>
<!--
            <footer id="footer" class="container-fluid text-center">
                <p>Developed by: Group 23</p>
                <p>Report Bug: <a href="mailto:Ndtptb@mail.missouri.edu?Subject=Contacted%20from%20Website" target="_top">Ndtptb@mail.missouri.edu</a></p>
                <p>Designed With: Bootstrap V3</p>
            </footer>
-->
        </body>
</html>
