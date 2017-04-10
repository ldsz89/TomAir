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
            
            #warning {
                background-color: palevioletred;
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
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/PilotDash.php">Dashboard</a></li>
                        <li class="active"><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/Certifications.php">Certifications</a></li>
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/FlightViewer.php">Flight Viewer</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/PilotProfile.php"><span class="glyphicon glyphicon-user"></span> Edit Profile</a></li>
                        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container jumbotron">
            <div class="jumbotron">
                <h1>Current certifications</h1>
                    <?php
                        $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
                        $query = "SELECT Certifications.Equip_Serial, Equip_Num, Equip_Name AS Name, Equip_Pilots_Req AS 'Pilots Required', Equip_Att_Req AS 'Attendants Required' FROM Equipment, Certifications WHERE Equipment.Equip_Serial = Certifications.Equip_Serial AND Emp_ID = ".$_SESSION['Emp_ID'];

                        $result = mysqli_query($link, $query);

                        echo "<table class='table table-hover'><thead>";
                        echo "<th></th>";
                        //Header loop
                        while($row = mysqli_fetch_field($result)) {
                            echo "<th>".$row->name."</th><br>";
                        }
                        echo "</thead>";

                        //For each row
                        while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                            echo "<tr>";
                            echo "<form action='deleteCert.php' method='POST'>";

                            echo "<input type='hidden' name='Equip_Serial' value='". $row[0] ."'>";

                            echo "<td><button class='btn' id='warning'><span class='glyphicon glyphicon-remove'></span></button></td>";
                            echo "</form>";
                            foreach($row as $val) {
                                echo "<td>".$val."</td>";
                            }
                            echo "</tr>";

                        }
                        echo "</table>";
                    ?>
            </div>
            <div class="row text-center">
                <h3>Add Certification</h3>
                <form method="POST" action="Certifications.php" class="form-inline">
                    <div id="mainselection" class="form-group">
                        <select name="equip">
                            <?php
                                $query = "SELECT Equip_Serial, Equip_Name FROM Equipment ORDER BY Equip_Name ASC";
                                $result = mysqli_query($link, $query);

                                //For each row
                                while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                    /*foreach($row as $val) {
                                        echo "<option value='". $val ."'>". $val ."</option>";
                                    }*/
                                    
                                    foreach($row as $val) {
                                        echo "<option value='". $row[0] ."'>". $row[0] ." - ".$row[1] ."</option>";
                                    }
                                }
                            ?>
                        </select>
                        <input type="submit" name="addCert" value="Submit" class="btn">
                    </div>
                </form>
            </div>
        </div>

    </body>
</html>

<?php
    if(isset($_POST['equip'])) {
        $query = "INSERT INTO Certifications(Emp_ID, Equip_Serial) VALUES(?, ?)";
        $result = mysqli_query($link, $query);
        if($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, 'is', $_SESSION['Emp_ID'], $_POST['equip']);
            if(mysqli_stmt_execute($stmt)) {
                echo "<div class='well'>Certification successfully added</div>";
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                
                date_default_timezone_set('America/Chicago');
                $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Emp_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'CERTIFICATION UPDATE', 'PILOT', ".$_SESSION['Emp_ID'].")";
                
                if(!mysqli_query($link, $sql)){
                    printf("Errormessage: %s\n", mysqli_error($link));
                }
                else {
                    header("Location: Certifications.php");
                    exit;
                }
            }
        }
    }
    mysqli_close($link);
?>