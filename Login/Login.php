<?php
session_start(); //started so logins may be used on this page
  if (isset($_SESSION['Emp_Type'])){ // if the Emp_Type Session is set we start the switch to redirect them if they are already logged in. If no fields are met then they are presented the login page
    switch ($_SESSION['Emp_Type']) {
      case 0:
        $_SESSION['name'] = $username;
        header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/AdminDash.php");
        break;
      case 1:
        $_SESSION['name'] = $username;
        header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/PilotDash.php");
        break;
      case 2:
        $_SESSION['name'] = $username;
        header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AttDash/FlightAttendant.php");
        break;

      default:
      //When the user visits the page the first time the login form below will be displayed instead.
      break;
    }
  }



  if (isset($_POST['name']) and isset($_POST['pass'])){

  	$hostname = 'localhost';
  	$dbusername = 'CS3380GRP23';
  	$dbpassword = 'e7d18aa';
  	$database = 'CS3380GRP23';

    $username = $_POST['name'];
    $password = $_POST['pass'];

  	$link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());
    $query = "SELECT * FROM Employee WHERE Emp_ID='$username' and Emp_Password='$password'";

    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    //This small block of code was the death of me. num_rows sucks!!! That's all I have to say
    if ($count == 1){
      $_SESSION['name'] = $username;
      $querytype = "SELECT Emp_Type, Emp_ID FROM Employee WHERE Emp_ID='$username' and Emp_Password='$password'";
      $result = mysqli_query($link, $querytype) or die(mysqli_error($link));
      $type = mysqli_fetch_row($result);
      switch ($type[0]) {
          case 0:
              $_SESSION['Emp_Type'] = $type[0];
              date_default_timezone_set('America/Chicago');
              $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Emp_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'LOGIN', 'ADMIN', ".$_SESSION['name'].")";

              if(!mysqli_query($link, $sql)){
                  printf("Errormessage: %s\n", mysqli_error($link));
              }
              else {
                  mysqli_close($link);
                  header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/AdminDash.php");
                  exit;
              }
              break;
          case 1:
              $_SESSION['Emp_Type'] = $type[0];
              $_SESSION['Emp_ID'] = $type[1];

              date_default_timezone_set('America/Chicago');
              $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Emp_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'LOGIN', 'PILOT', ".$_SESSION['name'].")";

              if(!mysqli_query($link, $sql)){
                  printf("Errormessage: %s\n", mysqli_error($link));
              }
              else {
                  mysqli_close($link);
                  header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/PilotDash/PilotDash.php");
                  exit;
              }
              break;
          case 2:
              $_SESSION['Emp_Type'] = $type[0];
              $_SESSION['Emp_ID'] = $type[1];

              date_default_timezone_set('America/Chicago');
              $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Emp_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'LOGIN', 'ATTENDANT', ".$_SESSION['name'].")";

              if(!mysqli_query($link, $sql)){
                  printf("Errormessage: %s\n", mysqli_error($link));
              }
              else {
                  mysqli_close($link);
                  header("Location: http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AttDash/FlightAttendant.php");
                  exit;
              }
              break;

        default:
          Echo "Login Error. Possible Employee assigned no type. Line 37";
          break;
      }

    } else {
    // If the login credentials don't match, the user will be shown an error message.
      $fmsg = "Invalid Login Credentials.";
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Login</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

  <link rel="stylesheet" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/styles.css" >

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
       body {
          background-image: url("http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/AdminDash/Background/CityScape.jpg");
          background-color: #f7f7f7;
       }
   </style>
</head>
<body>

  <nav aria-label="..." style="padding-left: 20px;">
    <ul class="pager">
      <li class="previous"><a href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/"><span aria-hidden="true">&larr;</span> Return Home</a></li>
    </ul>
  </nav>

  <div class="container">
    <form class="form-signin" method="POST">
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <h2 class="form-signin-heading">Please Login</h2>
      <div class="input-group">
	      <span class="input-group-addon" id="basic-addon1">@</span>
	      <input type="text" name="name" class="form-control" placeholder="Username" required>
	    </div>
      <label for="pass" class="sr-only">Password</label>
      <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required> <br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button> <br>
    </form>
  </div>

  </body>

</html>
