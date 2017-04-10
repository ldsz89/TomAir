<?php
    ob_start();
    session_start();
    if(isset($_SESSION['Emp_Type'])){
        if (($_SESSION['Emp_Type']) != 1){
            header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
        }
    }
    else {
        header("Locatoin: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/Login.php");
    }

    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
    $query = "SELECT Emp_fname, Emp_lname, Pilot.Emp_Password, Pil_Status, Pil_Hours, Pil_Rank FROM Pilot, Employee WHERE Pilot.Emp_ID = Employee.Emp_ID AND Pilot.Emp_ID = ".$_SESSION['Emp_ID'];
    $result = mysqli_query($link, $query);
    $pilotInfo = mysqli_fetch_row($result);

    $DBName = $pilotInfo[0];
    $DBLName = $pilotInfo[1];
    $DBPassword = $pilotInfo[2];
    $DBStatus = $pilotInfo[3];
    $DBHours = $pilotInfo[4];
    $DBRank = $pilotInfo[5];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo "<title>". $DBName ."'s - Profile</title>"; ?>
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
                    <a class="navbar-brand" href="PilotDash.php">Pilot</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="PilotDash.php">Dashboard</a></li>
                        <li><a href="Certifications.php">Certifications</a></li>
                        <li><a href="FlightViewer.php">Flight Viewer</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="PilotProfile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
                        <li><a href="../Login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            <form method="POST" action="PilotProfile.php" class="form-horizontal">
                <div class="form-group">
                    <label for="ID" class="col-md-2 control-label">Employee ID</label>
                    <div class="col-md-9"><input type="text" class="form-control" id="ID" <?php echo "value='". $_SESSION['Emp_ID'] ."'"; ?> readonly></div>
                </div>
                <div class="form-group">
                    <label for="Password" class="col-md-2 control-label">Password</label>
                    <div class="col-md-9"><input type="text" class="form-control" id="Password" name="Password" <?php echo "value='". $DBPassword ."'"; ?>></div>
                </div>
                <div class="form-group">
                    <label for="Name" class="col-md-2 control-label">First Name</label>
                    <div class="col-md-9"><input type="text" name="Name" class="form-control" id="Name" <?php echo "value='". $DBName ."'"; ?>></div>
                </div>
                <div class="form-group">
                    <label for="lname" class="col-md-2 control-label">Last Name</label>
                    <div class="col-md-9"><input type="text" name="lname" class="form-control" id="lname" <?php echo "value='". $DBLName ."'"; ?>></div>
                </div>
                <div class="form-group">
                    <label for="Status" class="col-md-2 control-label">Status</label>
                    <!--<div class="col-md-9"><input type="text" class="form-control" id="Status" <?php echo "value='". $DBStatus ."'"; ?>></div>-->
                    <div class="col-md-2"><input type="radio" name="Status" value="0" <?php if($DBStatus == 0) {echo 'checked';} ?>>Inactive</div>
                    <div class="col-md-2"><input type="radio" name="Status" value="1" <?php if($DBStatus == 1) {echo 'checked';} ?>>Active</div>
                </div>
                <div class="form-group">
                    <label for="Hours" class="col-md-2 control-label">Hours</label>
                    <div class="col-md-9"><input type="number" name="Hours" class="form-control" id="Hours" <?php echo "value='". $DBHours ."'"; ?>></div>
                </div>
                <div class="form-group">
                    <label for="Rank" class="col-md-2 control-label">Rank</label>
<!--                    <div class="col-md-9"><input type="text" name="Rank" class="form-control" id="Rank" <?php echo "value='". $DBRank ."'"; ?>></div>-->
                    <div class="col-md-9" id="mainselection">
                        <select name="Rank" id="Rank">
                            <option value="Junior Flight Officer" <?php if($DBRank == "Junior Flight Officer") {echo 'selected="selected"';} ?>>Junior Flight Officer</option>
                            <option value="Flight Officer" <?php if($DBRank == "Flight Officer") {echo 'selected="selected"';} ?>>Flight Officer</option>
                            <option value="First Officer" <?php if($DBRank == "First Officer") {echo 'selected="selected"';} ?>>First Officer</option>
                            <option value="Captain" <?php if($DBRank == "Captain") {echo 'selected="selected"';} ?>>Captain</option>
                            <option value="Senior Captain" <?php if($DBRank == "Senior Captain") {echo 'selected="selected"';} ?>>Senior Captain</option>
                            <option value="Commercaial First Officer" <?php if($DBRank == "Commercaial First Officer") {echo 'selected="selected"';} ?>>Commercaial First Officer</option>
                            <option value="Commercial Captain" <?php if($DBRank == "Commercial Captain") {echo 'selected="selected"';} ?>>Commercial Captain</option>
                            <option value="Commercial Senior Captain" <?php if($DBRank == "Commercial Senior Captain") {echo 'selected="selected"';} ?>>Commercial Senior Captain</option>
                            <option value="Commercial Commander" <?php if($DBRank == "Commercial Commande") {echo 'selected="selected"';} ?>>Commercial Commander</option>
                            <option value="Commercial Senior Commander" <?php if($DBRank == "Commercial Senior Commander") {echo 'selected="selected"';} ?>>Commercial Senior Commander</option>
                            <option value="ATP First Officer" <?php if($DBRank == "ATP First Officer") {echo 'selected="selected"';} ?>>ATP First Officer</option>
                            <option value="ATP Captain" <?php if($DBRank == "ATP Captain") {echo 'selected="selected"';} ?>>ATP Captain</option>
                            <option value="ATP Senior Captain" <?php if($DBRank == "ATP Senior Captain") {echo 'selected="selected"';} ?>>ATP Senior Captain</option>
                            <option value="ATP Commander" <?php if($DBRank == "ATP Commander") {echo 'selected="selected"';} ?>>ATP Commander</option>
                            <option value="ATP Senior Commander" <?php if($DBRank == "ATP Senior Commander") {echo 'selected="selected"';} ?>>ATP Senior Commander</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1 col-md-offset-11"><input type="submit" name="submit" class="btn btn-default" value="Save"></div>
            </form>
        </div>
        <?php
            if(isset($_POST['submit'])) {
                $employeeUpdate = "UPDATE Employee SET Emp_fname = ?, Emp_lname = ?, Emp_Password = ? WHERE Emp_ID = ?";
                $pilotUpdate = "UPDATE Pilot SET Emp_Password = ?, Pil_Status = ?, Pil_Hours = ?, Pil_Rank = ? WHERE Emp_ID = ?";
                if($stmt = mysqli_prepare($link, $employeeUpdate)) {
                    mysqli_stmt_bind_param($stmt, 'sssi', $_POST['Name'], $_POST['lname'], $_POST['Password'], $_SESSION['Emp_ID']) or die("<div class='well'>Employee Bind failed</div>");
                    if(mysqli_stmt_execute($stmt)) {
                        if($stmt = mysqli_prepare($link, $pilotUpdate)) {
                            mysqli_stmt_bind_param($stmt, 'siisi', $_POST['Password'], $_POST['Status'], $_POST['Hours'], $_POST['Rank'], $_SESSION['Emp_ID']) or die("<div class='well'>Pilot Bind failed</div>");
                            if(mysqli_stmt_execute($stmt)) {
                                date_default_timezone_set('America/Chicago');
                                $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Emp_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'PROFILE UPDATE', 'PILOT', ".$_SESSION['Emp_ID'].")";

                                if(!mysqli_query($link, $sql)){
                                    printf("Errormessage: %s\n", mysqli_error($link));
                                }
                                else {
                                    header("Location: PilotProfile.php");
                                    mysqli_close($link);
                                    exit;
                                }
                            }
                            else {
                                echo "<div class='well'>Execute failed</div>";
                            }
                        }
                        else {
                            echo "<div class='well'>Pilot prepare failed</div>";
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