<?php
ob_start();
session_start();

if (isset($_SESSION['Emp_Type'])){
  if (($_SESSION['Emp_Type']) != 0){
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
        <title>Tom's Air - Flight Management</title>
        <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/i18n/defaults-*.min.js"></script>
        <style type="text/css">
            a.fancybox img {
                border: none;
                box-shadow: 0 1px 7px rgba(0,0,0,0.6);
                -o-transform: scale(1,1); -ms-transform: scale(1,1); -moz-transform: scale(1,1); -webkit-transform: scale(1,1); transform: scale(1,1); -o-transition: all 0.2s ease-in-out; -ms-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -webkit-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out;
            }
            a.fancybox:hover img {
                position: relative; z-index: 999; -o-transform: scale(1.03,1.03); -ms-transform: scale(1.03,1.03); -moz-transform: scale(1.03,1.03); -webkit-transform: scale(1.03,1.03); transform: scale(1.03,1.03);
            }

            body {
                background-color: #f7f7f7;
                /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
            }

            img {
                border-style: ridge;
                border-radius: 7px;
                display: inline;
                margin: 10px 50px;
                width: 250px;;
                height: auto;
                /*-webkit-transition: -webkit-transform 0.3s;
                transition: transform 0.5s;*/
            }

            div {
                text-align: center;
            }

            #mainselection select {
                border: 0;
                color: #EEE;
                background-color: #555;
    /*                font-size: 20pt;*/
                font-weight: bold;
                padding: 2px 10px;
    /*                width: 378px;*/
                width: 100%;
                *width: 350px;
                *background: #58B14C
                -webkit-appearance: none;
            }
            #warning {
                background-color: #ff8c69;
            }

        /* img:active
          {
            -webkit-transform: scale(2,2);
            transform: scale(2,2);
            box-shadow: 0 0 10px #555
          }*/

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
							<li><a href="AdminDash.php">Dashboard</a></li>
							<li><a href="UserMan.php">User Management</a></li>
							<li><a href="LogView.php">Log Viewer</a></li>
							<li><a href="EquipUp.php">Update Equipment</a></li>
							<li class="active"><a href="FlightUp.php">Update Flights</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
						</ul>
					</div>
                </div>
            </nav>


<!--
		</body>
	</html>
-->

  <?php
      $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23') or die ("Line 129" . mysqli_connect_error());

      $sql = "SELECT Fli_Num AS '#',Fli_Dep_Date AS 'Departure Date', Fli_Dep_Time AS 'Departure Time', Fli_Arr_Time AS 'Arrival Time', Fli_Dep_City AS 'Departure City', Fli_Arr_City AS 'Arrival City', Equip_Serial AS 'Serial #', Fli_Price AS 'Price', Fli_Availibility AS Availability FROM Flights;";
      $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));
      echo "<table style='background-color:white;' class='table table-hover'><thead>";
      while($fieldinfo = mysqli_fetch_field($result)){
        echo "<th>".$fieldinfo->name."</th>";
      }
      echo "</thead>";
      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo "<tr>";
        $counter = 0;
        foreach ($row as $r) {
          echo "<td>$r</td>";
          if ($counter==0){
            $pk=$r;
          }
          $counter++;
        }

        echo "<td><form method='POST' action='updateFlight.php'>";
        echo "<button class='btn btn-primary' type='submit' name='update' value='$pk'>Update";
        echo "</form></td>";
        echo "<td><form method='POST' action='deleteFlight.php'>";
        echo "<button class='btn btn-primary' type='submit' name='delete' value='$pk'>Delete";
        echo "</form></td>";
      }
      echo "</tr>";
  ?>


      <div class="container">
        <form class="form-signin" method="POST" action="FlightUp.php">

          <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
          <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
          <h2 class="form-signin-heading">Add Flight</h2><br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">ID</span>
                <input type="number" name="Fli_Num" class="form-control" placeholder="Please Enter Flight Number" required>
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Departure Date</span>
                <input type="date" name="Fli_Dep_Date" class="form-control" placeholder="2016-12-25">
            </div>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Departure Time</span>
                <input type="time" name="Fli_Dep_Time" class="form-control" placeholder="HH:MM:SS">
<!--                <input type="text" name="Fli_Dep_Time" class="form-control" placeholder="HH:MM:SS">-->
                <span class="input-group-addon">Arrival Time</span>
                <input type="time" name="Fli_Arr_Time" class="form-control">
<!--                <input type="text" name="Fli_Arr_Time" class="form-control" placeholder="HH:MM:SS">-->
            </div>
            <div class="input-group">
                <span class="input-group-addon">Departure City</span>
                <div class="form-control" id="mainselection">
                    <select name="Fli_Dep_City" data-live-search="true">
                        <?php
                            $query = "SELECT Name FROM City ORDER BY Name ASC";
                            $result = mysqli_query($link, $query);

                            //For each row
                            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                foreach($row as $val) {
                                    echo "<option value='". $val ."'>". $val ."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <span class="input-group-addon">Arrival City</span>
                <div class="form-control" id="mainselection">
                    <select name="Fli_Arr_City">
                        <?php
                            $query = "SELECT Name FROM City ORDER BY Name ASC";
                            $result = mysqli_query($link, $query);

                            //For each row
                            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                foreach($row as $val) {
                                    echo "<option value='". $val ."'>". $val ."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">Plane Serial #</span>
                <div class="form-control" id="mainselection">
                    <select name="Equip_Serial">
                        <?php
                            $query = "SELECT Equip_Name, Equip_Serial FROM Equipment ORDER BY Equip_Name ASC";
                            $result = mysqli_query($link, $query);

                            //For each row
                            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                                foreach($row as $val) {
//                                    echo "<option value='". $val ."'>". $val ."</option>";
                                    echo "<option value='". $row[1] ."'>". $row[0] ." - ". $row[1] ."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <span class="input-group-addon">Price</span>
                <input type="number" name="Fli_Price" class="form-control" min="0">
            </div>
            <br>
            <label for="sel2">Availability:</label>
            <select class='text-center' style="width:150px;" name="Fli_Avail" class="form-control" id="sel2">
              <option value="0">Full</option>
              <option value="1">Available</option>
            </select>
            <br><hr>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="add">Add Flight</button>
        </form>
      </div><hr>

    </body>

</html>

  <?php

      if(isset($_POST['Fli_Num']) && isset($_POST['Fli_Dep_Date']) && isset($_POST['Fli_Dep_Time']) && isset($_POST['Fli_Arr_Time']) && isset($_POST['Fli_Price'])){
//      if(isset($_POST['Fli_Num'])){
        $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23') or die ("Line 241" . mysqli_connect_error());

        $Fli_Num = $_POST['Fli_Num'];
        $Fli_Dep_Date = "'". $_POST['Fli_Dep_Date'] ."'";
        $Fli_Dep_Time = "'". $_POST['Fli_Dep_Time'] .":00'";
        $Fli_Arr_Time = "'". $_POST['Fli_Arr_Time'] .":00'";
        $Fli_Dep_City = $_POST['Fli_Dep_City'];
        $Fli_Arr_City = $_POST['Fli_Arr_City'];
        $Equip_Serial = $_POST['Equip_Serial'];
        $Fli_Price = $_POST['Fli_Price'];
        $Fli_Avail = $_POST['Fli_Avail'];

          $sqlcheck = "SELECT * FROM Flights WHERE Fli_Num =" . $Fli_Num . " LIMIT 1"; //Error checking to see if user exist
          $sql = "INSERT INTO Flights(Fli_Num, Fli_Dep_Date, Fli_Dep_Time, Fli_Arr_Time, Fli_Dep_City, Fli_Arr_City, Equip_Serial, Fli_Price, Fli_Availibility) VALUES (?, $Fli_Dep_Date, $Fli_Dep_Time, $Fli_Arr_Time, ?, ?, ?, ?, ?)";

          $sqlCheckVar = mysqli_query($link, $sqlcheck);

          if(mysqli_num_rows($sqlCheckVar) > 0) {
            $fmsg = "Already assigned try again";
              echo "<div class='well text-center' id='warning'>". $fmsg ."</div>";
              mysqli_close($link);
              echo "Check 2 fail";
          }
          else {
              /*echo "<div class='well' id='warning'>Now we're rustling jimmies</div>";
              echo "<div class='well' id='warning'>".$sql."</div>";*/
              if($stmt = mysqli_prepare($link, $sql)) {
                  mysqli_stmt_bind_param($stmt, 'isssii', $Fli_Num, $Fli_Dep_City, $Fli_Arr_City, $Equip_Serial, $Fli_Price, $Fli_Avail) or die("<div class='well' id='warning'>The salt is real</div>");
                  if(mysqli_stmt_execute($stmt)) {
                      header("Location: FlightUp.php");
                      exit;
//                      echo "<div class='well' id='warning'>I've seen the light! The light asked me to stop staring at it.</div>";
                  }
              }
          }
      }
  ?>
