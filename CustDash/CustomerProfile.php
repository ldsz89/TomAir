<?php
    ob_start();
    session_start();
    if(!isset($_SESSION['Cust_ID'])){
        header("Location: login.php");
    }

    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
    $query = "SELECT Cust_First_Name, Cust_Last_Name, Cust_Age FROM Customer WHERE Cust_ID = ".$_SESSION['Cust_ID'];
    $result = mysqli_query($link, $query);
    $custInfo = mysqli_fetch_row($result);

    $DBFName = $custInfo[0];
    $DBLName = $custInfo[1];
    $DBAge = $custInfo[2];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo "<title>". $DBFName ."'s - Profile</title>"; ?>
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
            
            #mainselection select {
                border: 0;
                color: #EEE;
                background-color: #555;
/*                font-size: 20pt;*/
                font-weight: bold;
                padding: 2px 10px;
                width: 378px;
                *width: 350px;
                *background: #58B14C
                -webkit-appearance: none;
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
                        <li><a href="CustomerDash.php">Dashboard</a></li>
                        <li><a href="Reservations.php">Reservations</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="CustomerProfile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
                        <li><a href="../Login/clogout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <form method="POST" action="CustomerProfile.php" class="form-horizontal">
                <div class="form-group">
                    <label for="ID" class="col-md-2 control-label">Customer ID</label>
                    <div class="col-md-9"><input type="text" class="form-control" id="ID" <?php echo "value='". $_SESSION['Cust_ID'] ."'"; ?> readonly></div>
                </div>
                <div class="form-group">
                    <label for="Name" class="col-md-2 control-label">First Name</label>
                    <div class="col-md-9"><input type="text" name="FName" class="form-control" id="Name" <?php echo "value='". $DBFName ."'"; ?>></div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-9"><input type="text" name="LName" class="form-control" id="lname" <?php echo "value='". $DBLName ."'"; ?>></div>
                </div>
                <div class="form-group">
                    <label for="Hours" class="col-md-2 control-label">Age</label>
                    <div class="col-md-9"><input type="number" name="Age" class="form-control" id="Age" <?php echo "value='". $DBAge ."'"; ?>></div>
                </div>
                <div class="col-md-1 col-md-offset-11"><input type="submit" name="submit" class="btn btn-default" value="Save"></div>
            </form>
        </div>
        <?php
            if(isset($_POST['submit'])) {
                $customerUpdate = "UPDATE Customer SET Cust_First_Name = ?, Cust_Last_Name = ?, Cust_Age = ? WHERE Cust_ID = ?";
                if($stmt = mysqli_prepare($link, $customerUpdate)) {
                    mysqli_stmt_bind_param($stmt, 'ssii', $_POST['FName'], $_POST['LName'], $_POST['Age'], $_SESSION['Cust_ID']) or die("<div class='well'>Customer Bind failed</div>");
                    if(mysqli_stmt_execute($stmt)) {
                        echo "<div class='well'>Customer ". $_SESSION['Cust_ID'] ." has been updated</div>";
                        $_SESSION['Cust_First_Name'] = $_POST['FName'];
                        $_SESSION['Cust_Last_Name'] = $_POST['LName'];
                        
                        date_default_timezone_set('America/Chicago');
                        $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Cust_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'PROFILE UPDATE', 'CUSTOMER', ".$_SESSION['Cust_ID'].")";
                        
                        if(!mysqli_query($link, $sql)){
                            printf("Errormessage: %s\n", mysqli_error($link));
                        }
                        else {
                            mysqli_close($link);
                            header("Location: CustomerProfile.php");
                            exit;
                        }
                    }
                }
                else {
                    echo "<div class='well'>Prepare failed</div>";
                }
            }
        ?>
    </body>
</html>