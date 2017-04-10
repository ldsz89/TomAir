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


  <title>Toms Air - Update Flight</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

  <!-- (Optional) Latest compiled and minified JavaScript translation files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/i18n/defaults-*.min.js"></script>


  <script>
    $(document).ready(function() {
    $('input[type="checkbox"]').click(function() {
      if($(this).is(':checked')) {
        $('#mycheckboxdiv').fadeIn("slow");
      }
      else {
        $('#mycheckboxdiv').fadeOut("slow");
      }
    });
    });

  </script>


  <style>

    body {
      background-color: #a94442;
    }

    th {
      background-color: rgba(250,250,250,1);
    }

    tr.result {
      background-color: rgba(200,200,200,1);
    }

    .col-sm-3 {
      border: 2px;
      font-size: 30px;
      color: black;
      background:rgba(0,0,0,0.4);
    }

	  .jumbotron {
		  background-color: rgba(0, 180, 255, 0.2);
		}

    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
	    background-color: rgba(0, 180, 255, 0.5);
      padding: 15px;
    }

    #mycheckboxdiv {
      display:none;
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
            <li><a href="EquipUp.php">Update Equipment</a></li>
            <li class="active"><a href="FlightUp.php">Update Flights</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
          </ul>
        </div>
        </div>
      </nav>




<?php

  if (isset($_POST['update'])){
    $pk=$_POST['update'];
    $hostname = 'localhost';
    $dbusername = 'CS3380GRP23';
    $dbpassword = 'e7d18aa';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 105" . mysqli_connect_error());
    $sql = "SELECT * FROM Flights WHERE Fli_Num = '" . $pk . "'";




    $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));
    $updateFlight = "UPDATE Flights SET Fli_Dep_Time = ?, Fli_Dep_Date = ?, Fli_Availibility = ?, Fli_Price = ?, Fli_Dep_City = ?, Fli_Arr_City = ?, Equip_Serial = ?, Fli_Arr_Time = ? WHERE Fli_Num = ?";

    echo "<form method='post' action='updateFlight.php'>";
    echo "<table class='table' align='center' class='result'>";
    echo "<thead>";

    while($field = mysqli_fetch_field($result)) {
      echo "<th class='result'>" . $field->name . "<br></th>";
    }

    while($row = mysqli_fetch_row($result)) {
      echo "<tr class='result'>";
      $counter = 0;
      foreach ($row as $value) {
        switch ($counter) {
            case 0: echo "<td class='result' ><input class='form-control' type='number' name='Fli_Num' value=" . $value . " readonly><br></td>";
            break;
            case 1: echo "<td class='result'><input class='form-control' type='time' name='Fli_Dep_Time' value=" . $value . "><br></td>";
            break;
            case 2: echo "<td class='result'><input class='form-control' type='date' name='Fli_Dep_Date' value=" . $value . "><br></td>";
            break;
            case 3: echo "<td class='result'><input class='form-control' type='number' name='Fli_Availibility' value=" . $value . "><br></td>";
            break;
            case 4: echo "<td class='result'><input class='form-control' type='number' name='Fli_Price' value=" . $value . "><br></td>";
            break;
            case 5: echo "<td class='result'><input class='form-control' type='text' name='Fli_Dep_City' value=" . $value . "><br></td>";
            break;
            case 6: echo "<td class='result'><input class='form-control' type='text' name='Fli_Arr_City' value=" . $value . "><br></td>";
            break;
            case 7: echo "<td class='result'><input class='form-control' type='text' name='Equip_Serial' value=" . $value . "><br></td>";
            break;
            case 8: echo "<td class='result'><input class='form-control' type='text' name='Fli_Arr_Time' value=" . $value . "><br></td>";
            break;
        }

        $counter++;
      }
      echo "</tr>";
    }

    echo "<tr><td colspan='6' align='center'><br><button type='submit' class='btn btn-primary' name='save' value='$updateFlight'>Update Flight</td></tr>";
    echo "</thead>";
    echo "</table>";
    echo "</form><hr>";
  }

  if (isset($_POST['save'])) {
    $hostname = 'localhost';
    $dbusername = 'CS3380GRP23';
    $dbpassword = 'e7d18aa';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 163" . mysqli_connect_error());
    $updateFlight = $_POST['save'];
    $pk = $_POST['Fli_Num'];


    if($stmt = mysqli_prepare($link, $updateFlight)) {
      mysqli_stmt_bind_param($stmt, "ssiissssi", $_POST['Fli_Dep_Time'], $_POST['Fli_Dep_Date'], $_POST['Fli_Availibility'], $_POST['Fli_Price'], $_POST['Fli_Dep_City'], $_POST['Fli_Arr_City'], $_POST['Equip_Serial'], $_POST['Fli_Arr_Time'], $_POST['Fli_Num']);

      //Removing the Employee from their old Emp_Type specific table so they can be added to their new correct one.
      if(mysqli_stmt_execute($stmt)) {
        echo "<br><div align='center'>Flight Saved!</div><br>";
        echo '<a class="btn btn-lg btn-primary btn-block" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/FlightUp.php">Return To Flight Managment</a>';


      }
      else {
        echo "<br><div align='center'>Flight did not save correctly! Try again or contact Server Administrator. Execute Failure.</div><br>";
        echo '<a class="btn btn-lg btn-primary btn-block" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/FlightUp.php">Return To Flight Managment</a>';
      }
    }
    else {
      echo "Update Failure. Line 178. Prepare Failed";
    }
  }

?>

<?php

  if (isset($_POST['update'])){
    $pk=$_POST['update'];

    $hostname = 'localhost';
    $dbusername = 'CS3380GRP23';
    $dbpassword = 'e7d18aa';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 163" . mysqli_connect_error());

    $FlightSerialsql = "SELECT Equip_Serial FROM Flights WHERE Fli_Num = '" . $pk . "'";
    $FlightSerialResults = mysqli_query($link, $FlightSerialsql) or die("Query Error: " . mysqli_error($link));
    $FlightSerial = mysqli_fetch_row($FlightSerialResults);
    $EquipPilReq = "SELECT Equip_Pilots_Req FROM Equipment WHERE Equip_Serial = '" . $FlightSerial[0] . "'";
    $EquipAttReq = "SELECT Equip_Att_Req FROM Equipment WHERE Equip_Serial = '" . $FlightSerial[0] . "'";

    $FlightPilReqResults = mysqli_query($link, $EquipPilReq) or die("Query Error: " . mysqli_error($link));
    $FlightAttReqResults = mysqli_query($link, $EquipAttReq) or die("Query Error: " . mysqli_error($link));

    $FlightPilReq = mysqli_fetch_row($FlightPilReqResults);
    $FlightAttReq = mysqli_fetch_row($FlightAttReqResults);


  }


 ?>

<label id="mycheckbox" ><input type="checkbox" value="" >Reassign Employees to Flight?</label>

<div id="mycheckboxdiv" style="display:none">
  <form method='post' action='updateFlight.php'>

   <b><label for="ReqStaff">Staff Required: <?php echo $FlightPilReq[0]; ?> Pilots and <?php echo $FlightAttReq[0]; ?> Attendants</label></b>
   <div id="ReqStaff">
      <select class="selectpicker" multiple="" data-live-search="true"  title="Pilots" data-selected-text-format="count">
        <optgroup label="Pilots" data-max-options="<?php echo $FlightPilReq[0]; ?>">
          <?php
            $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
            $query = "SELECT Emp_ID FROM Employee WHERE Emp_Type = '1' ORDER BY Emp_ID ASC";
            $result = mysqli_query($link, $query);

            //For each row
            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
              foreach($row as $val) {
               echo "<option value='". $row[0] ."'>". $row[0] ."</option>";
              }
            }
          ?>
        </optgroup>
      </select>
      <select class="selectpicker" multiple="" data-live-search="true" title="Flight Attendants" data-selected-text-format="count">
        <optgroup label="Flight Attendants" data-max-options="<?php echo $FlightAttReq[0]; ?>">
          <?php
            $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
            $query = "SELECT Emp_ID FROM Employee WHERE Emp_Type = '2' ORDER BY Emp_ID ASC";
            $result = mysqli_query($link, $query);

              //For each row
            while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
              foreach($row as $val) {
               echo "<option value='". $row[0] ."'>". $row[0] ."</option>";
              }
            }
          ?>
        </optgroup>
      </select>
    </div>
    <br><br><br><br>

  </form>

</div><br>

<button class="btn btn-lg btn-primary btn-block" type="submit" name="AssignEmps">Assign Employees</button>

</body>

</html>
