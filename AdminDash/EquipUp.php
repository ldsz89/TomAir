<?php
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
	<title>Tom's Air - Equipment Management</title>
  <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
 	<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


  <style type="text/css">

      body {
        background-color: #f7f7f7;
      }


				table, th, td {
						border: 1px solid black;
						border-collapse: collapse;
				}

				.mytable>tbody>tr>td, .mytable>tbody>tr>th, .mytable>tfoot>tr>td, .mytable>tfoot>tr>th, .mytable>thead>tr>td, .mytable>thead>tr>th {
						padding: 12px;
						background-color: rgba(0, 255, 255, 0.3);;
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
						<a class="navbar-brand" href="AdminDash.php">Admin</a>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li><a href="AdminDash.php">Dashboard</a></li>
							<li><a href="UserMan.php">User Management</a></li>
							<li><a href="LogView.php">Log Viewer</a></li>
							<li class="active"><a href="EquipUp.php">Update Equipment</a></li>
							<li><a href="FlightUp.php">Update Flights</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
						</ul>
					</div>
					</div>
				</nav>


        <div class="container">
          <form class="form-signin" method="POST" action="EquipUp.php">

            <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
            <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
            <h2 class="form-signin-heading">Add Equipment</h2><br>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Equipment Serial Number</span>
            	<input type="text" name="Equip_Serial" class="form-control" placeholder="Please Enter Serial Number" required>
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Equipment Name</span>
              <input type="text" name="Equip_Name" class="form-control" placeholder="Equipment Name">
            </div>

            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Equipment Number</span>
              <input type="text" name="Equip_Num" class="form-control" placeholder="Number">
            </div>

            <div class="form-group"> <hr>


                <h1>Staff Requirements:</h1>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Pilots Required:</span>
                  <input style="width:200px;" type="number" name="Equip_Pilots_Req" class="form-control" placeholder="0">
                </div>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Attendants Required:</span>
                  <input style="width:200px;" type="number" name="Equip_Att_Req" class="form-control" placeholder="0">
                </div>


                <br>

                <h1>Customer Requirements</h1>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">Seating:</span>
                  <input style="width:200px;" type="number" name="Equip_Seating" class="form-control" placeholder="0">
                </div>

            </div><hr>
            <br><br>

            <button class="btn btn-lg btn-primary btn-block" type="submit" name="add">Add Equipment</button>
          </form>
        </div><br><br><hr>


		</body>
	</html>

  <?php

      if (isset($_POST['Equip_Serial'])){

        $hostname = 'localhost';
        $dbusername = 'CS3380GRP23';
        $dbpassword = 'e7d18aa';
        $database = 'CS3380GRP23';

        $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

        $num = $_POST['Equip_Num'];
        $name = $_POST['Equip_Name'];   // This just makes handling those post vars so much easier. Barely used.
        $serial = $_POST['Equip_Serial'];

        $sqlcheck = "SELECT * FROM Equipment WHERE Equip_Serial='" . $_POST['Equip_Serial'] . "' LIMIT 1"; //Error checking to see if user exist
        $sql = "INSERT INTO Equipment(Equip_Num, Equip_Name, Equip_Serial, Equip_Pilots_Req, Equip_Att_Req, Equip_Seating) VALUES (?, ?, ?, ?, ?, ?)";
        $sqlCheckVar = mysqli_query($link, $sqlcheck);

        if(mysqli_num_rows($sqlCheckVar) > 0) {
          $fmsg = "Already exist try again";
          echo "<div class='well text-center' id='warning'>". $fmsg ."</div>";
          mysqli_close($link);
        }
        else {
          if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssiii", $_POST['Equip_Num'], $_POST['Equip_Name'], $_POST['Equip_Serial'], $_POST['Equip_Pilots_Req'], $_POST['Equip_Att_Req'], $_POST['Equip_Seating']);
            if(mysqli_stmt_execute($stmt)){
              $smsg = "Equipment Added Succesfully";
              echo "<div class='well text-center'>". $smsg ."</div>";
              mysqli_close($link);
            }
            else {
              printf("Error: %s.\n", mysqli_stmt_error($stmt));
              $fmsg = "Equipment Registration error on line 169";
              echo "<div class='well text-center' id='warning'>". $fmsg ."</div>";
              mysqli_close($link);
            }
          }
          else {
            echo "<div class='well text-center'>Prepare Failed Contact Admin</div>";
          }
        }
      }


  ?>


  <?php

      $hostname = 'localhost';
      $dbusername = 'CS3380GRP23';
      $dbpassword = 'e7d18aa';
      $database = 'CS3380GRP23';

      $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

      $sql = "SELECT Equip_Num AS Equipment_Number, Equip_Name AS Name, Equip_Serial AS Serial_Number, Equip_Pilots_Req AS Pilots_Required, Equip_Att_Req AS Attendants_Required, Equip_Seating AS Seating FROM Equipment;";
      $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));
      echo "<table class='table table-hover'><thead>";
      while($fieldinfo = mysqli_fetch_field($result)){
        echo "<th>".$fieldinfo->name."</th>";
      }
      echo "</thead>";
      while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
        echo "<tr>";
        $counter = 0;
        foreach ($row as $r) {
          echo "<td>$r</td>";
          if ($counter==2){
            $pk=$r;
          }
          $counter++;
        }

        echo "<td><form method='POST' action='updateEquip.php'>";
        echo "<button class='btn btn-primary' type='submit' name='update' value='$pk'>Update";
        echo "</form></td>";
        echo "<td><form method='POST' action='deleteEquip.php'>";
        echo "<button class='btn btn-primary' type='submit' name='delete' value='$pk'>Delete";
        echo "</form></td>";
      }
      echo "</tr>";


  ?>
