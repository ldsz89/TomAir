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
	<title>Toms Air - Admin User Managment</title>
  <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css" />
 	<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <script> //This script shows or hides inputs baised on the type of employee selected. Yay Jquery
    $(document).ready(function() {
    $('input[type="radio"]').click(function() {
      if($(this).attr('id') == "Pilot") {
        $('#Pilot_Sec').fadeIn("slow");
      }
      else {
        $('#Pilot_Sec').fadeOut("slow");
      }
      if($(this).attr('id') == "Att") {
        $('#Flight_Att_Sec').fadeIn("slow");
      }
      else {
        $('#Flight_Att_Sec').fadeOut("slow");
      }
    });
    });

    function TimedRefresh( t ) { //Refreshes the page to autoshow the updated employee table on the page after they are submitted
    //  setTimeout("location.reload(true);", t);


    }

  </script>



  <style type="text/css">

      body {
        background-image: url("Background/Clouds.jpg");
        background-color: #f7f7f7;
      }


			table, th, td {
        background-color: rgba(20, 200, 255, 0.7);
				border: 1px solid black;
			  border-collapse: collapse;
			}

      th {
        background-color: rgba(180, 220, 250, 0.8);
      }

      .container {
        border: 3px solid white;
			  border-collapse: collapse;
        background-color: rgba(132, 97, 77, 1);
        padding-bottom: 20px;
      }

      #warning {
          background-color: palevioletred;
      }

      #Pilot_Sec {
        display:none;
      }

      #Flight_Att_Sec {
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
			        <li class="active"><a href="UserMan.php">User Management</a></li>
			        <li><a href="LogView.php">Log Viewer</a></li>
			        <li><a href="EquipUp.php">Update Equipment</a></li>
			        <li><a href="FlightUp.php">Update Flights</a></li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/Login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			      </ul>
			    </div>
			  	</div>
				</nav>
        <br>

<?php

    $hostname = 'localhost';
    $dbusername = 'CS3380GRP23';
    $dbpassword = 'e7d18aa';
    $database = 'CS3380GRP23';

    $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

    $sql = "SELECT Emp_ID AS ID, Emp_Password AS Password, Emp_Type AS Type, Emp_fname AS FirstName, Emp_lname AS LastName FROM Employee;"; // Renaming some of the data so it appears cleaner
    $result = mysqli_query($link, $sql) or die("Query Error: " . mysqli_error($link));
    echo "<table class='table table-hover'><thead>";
    while($fieldinfo = mysqli_fetch_field($result)){ // Grabs the field s owe can set the name of the column as the head of the table
      echo "<th>".$fieldinfo->name."</th>";
    }
    echo "</thead>";
    while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
      echo "<tr>";
      $counter = 0;
      foreach ($row as $r) {
        echo "<td>$r</td>";
        if ($counter==0){ // A counter to help us find the primary key/keys. This is used on each update page
          $pk=$r;
        }
        $counter++;
      }

      echo "<td><form method='POST' action='updateEmp.php'>";
      echo "<button class='btn btn-primary' type='submit' name='update' value='$pk'>Update"; //I send the primary key via the submit button to the update and delete page so it isnt lost
      echo "</form></td>";
      echo "<td><form method='POST' action='deleteEmp.php'>";
      echo "<button class='btn btn-primary' type='submit' name='delete' value='$pk'>Delete";
      echo "</form></td>";
    }
    echo "</tr>";
?>


    <div class="container">
      <form class="form-signin" method="POST" action="UserMan.php">

        <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?> <!-- alert messages for impropper input -->
        <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <h2 class="form-signin-heading">Add Employee</h2><br>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">ID</span>
        	<input type="text" name="ID" class="form-control" placeholder="Please Enter Employee ID Number" required>
        </div>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Name</span>
          <input type="text" name="Emp_fname" class="form-control" placeholder="First Name">
          <input type="text" name="Emp_lname" class="form-control" placeholder="Last Name">
        </div>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Password</span>
          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>

        <div class="form-group">

          <label for="Emp_Type_Sel">Employee Type (select one):</label><br>
          <input type="radio" name="Type" id="Admin" value="0" checked="check">Administrator<br>
					<input type="radio" name="Type" id="Pilot" value="1">Pilot<br>
					<input type="radio" name="Type" id="Att" value="2">Flight Attendant<br>

        <br><hr>


          <div class="Pilot" id="Pilot_Sec" style="display: none;">
            <h1 >Pilot Section:</h1>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">Hours Logged:</span>
              <input type="text" name="Pil_Hours" class="form-control" placeholder="Hours Flown">
            </div>

            <label for="pRank ">Pilot Ranking:</label>
            <input type="text" id="pRank" name="Pil_Rank" class="form-control" placeholder="Pilot Rank">

            <label for="sel2">Pilot Status:</label>
            <select style="width:150px;" name="Pil_Status" class="form-control" id="sel2">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
            </select>
          </div>
          <br><hr>

          <div class="Flight_Att" id="Flight_Att_Sec" style="display: none;">
            <h1 >Flight Attendant Section:</h1>
            <label for="AttRank ">Attendant Ranking:</label>
            <input type="text" id="AttRank" name="Att_Rank" class="form-control" placeholder="Attendant Rank">
            <input type="text" id="AttHours" name="Att_Hours" class="form-control" placeholder="Hours Flown">
            <label for="sel3">Flight Attendat Status:</label>
            <select style="width:150px;" name="Att_Status" class="form-control" id="sel3">
              <option value="0">Inactive</option>
              <option value="1">Active</option>
            </select>
          </div>


        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="add">Add Employee</button>
      </form>
    </div><br>

  </body>

</html>

<?php

    if (isset($_POST['ID']) && isset($_POST['password'])){

    $passLength = strlen($_POST['password']); //If a password is short it isn't secure. strlen finds the length
    $hostname = 'localhost';
    $dbusername = 'CS3380GRP23';
    $dbpassword = 'e7d18aa';
    $database = 'CS3380GRP23';

    if($passLength >= 8){ // if the password is less than 8 characters it fails.
        $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());

        $username = $_POST['ID'];
        $password = $_POST['password'];   // This just makes handling those post vars so much easier. Barely used.
        $name = $_POST['Emp_fname'];
        $type = $_POST['Type'];

        $sqlcheck = "SELECT * FROM Employee WHERE Emp_ID=" . $_POST['ID'] . " LIMIT 1"; //Error checking to see if user exist. I limit it to only one since once one is found it will end. This saves time depending on the size of the database
        $sql = "INSERT INTO Employee(Emp_ID, Emp_Password, Emp_fname, Emp_lname, Emp_Type) VALUES (?, ?, ?, ?, ?)";
        $sqlPilot = "INSERT INTO Pilot(Emp_ID, Emp_Password, Pil_Status, Pil_Hours, Pil_Rank) VALUES (?, ?, ?, ?, ?)";
        $sqlAtt = "INSERT INTO Flight_Att(Att_Rank, Emp_ID, Emp_Password, Att_Hours, Att_Status) VALUES (?, ?, ?, ?, ?)";
        $sqlAdmin = "INSERT INTO Administrator(Admin_Role, Emp_ID, Emp_Password) VALUES (?, ?, ?)";
        $sqlCheckVar = mysqli_query($link, $sqlcheck);

//      if(mysqli_fetch_row($sqlCheckVar) > 0) {
        if(mysqli_num_rows($sqlCheckVar) > 0) { // If more than one user exist then it fails
            $fmsg = "Already assigned try again";
            echo "<div class='well text-center' id='warning'>". $fmsg ."</div>";
            mysqli_close($link);
        }
        else{
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "isssi", $_POST['ID'], $_POST['password'], $_POST['Emp_fname'], $_POST['Emp_lname'], $_POST['Type']);
                if(mysqli_stmt_execute($stmt)){ //If the user is added to the employee table then we check the type to continue to add them to their specific type table
                  switch ($_POST['Type']) {
                    case 0:
                    $Admin_Role = 1; // setting the admin role value
                    $stmt = mysqli_prepare($link, $sqlAdmin);
                    mysqli_stmt_bind_param($stmt, "iis", $Admin_Role, $_POST['ID'], $_POST['password']);
                    mysqli_stmt_execute($stmt);
                      break;
                    case 1:
                    $stmt = mysqli_prepare($link, $sqlPilot);
                    mysqli_stmt_bind_param($stmt, "isiis", $_POST['ID'], $_POST['password'], $_POST['Pil_Status'], $_POST['Pil_Hours'], $_POST['Pil_Rank']);
                    mysqli_stmt_execute($stmt);
                      break;
                    case 2:
                    $stmt = mysqli_prepare($link, $sqlAtt);
                    mysqli_stmt_bind_param($stmt, "sisii", $_POST['Att_Rank'], $_POST['ID'], $_POST['password'], $_POST['Att_Hours'], $_POST['Att_Status']);
                    mysqli_stmt_execute($stmt);
                      break;

                    default:
                      echo "Employee added, but was not assigned to designated table."; // Error cheching
                      break;
                  }
                    $smsg = "User Login Registered Succesfully";
                    echo "<div class='well text-center'>". $smsg ."</div>";
                    mysqli_close($link);
                } else {
                    printf("Error: %s.\n", mysqli_stmt_error($stmt)); //If execution fails then a new error is displayed
                    $fmsg = "User Registration error on line 295";
                    echo "<div class='well text-center' id='warning'>". $fmsg ."</div>";
                    mysqli_close($link);
                }
            }
            else {
                echo "<div class='well text-center'>Prepare Failed</div>";
            }
        }
    }
        else{
        $fmsg = "Password is $passLength/8 characters.  <br> Please Try Again";
        echo "<div class='well text-center' id='warning'>". $fmsg ."</div>";
      }
  }


?>
