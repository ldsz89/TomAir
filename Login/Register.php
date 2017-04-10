<?php

  if (isset($_POST['username']) && isset($_POST['password'])){

    $passLength = strlen($_POST['password']);
    $hostname = 'localhost';
    $dbusername = 'kmstk5';
    $dbpassword = '75e93c2';
    $database = 'CS3380GRP23';

    if($passLength >= 8){
      $link = mysqli_connect($hostname, $dbusername, $dbpassword, $database) or die ("Line 129" . mysqli_connect_error());
      // This just makes handling those post vars so much easier.
      $username = $_POST['username'];
      $password = $_POST['password'];

      $sqlcheck = "SELECT * FROM login WHERE Emp_Name='".$_POST['username']."' LIMIT 1"; //Error checking to see if user exist
      $sql = "INSERT INTO login(Emp_name, pass) VALUES (?, ?)";
  /*  $test = "User: (".$_POST['username'].") ";
      echo $test;*/


      $sqlCheckVar = mysqli_query($link, $sqlcheck);
      if(mysqli_fetch_row($sqlCheckVar) > 0) {
            $fmsg = "Already assigned try again";
            mysqli_close($link);
        }
        else{
          if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['password']);
            if(mysqli_stmt_execute($stmt)){
              $smsg = "User Login Registed Succesfully";
              mysqli_close($link);
            } else {
                printf("Error: %s.\n", mysqli_stmt_error($stmt));
                $fmsg = "User Registration error on line 95";
                mysqli_close($link);
              }
          }
        }
      }
      else{
        $fmsg = "Password is $passLength/8 characters.  <br> Please Try Again";
        mysqli_close($link);
      }
  }


?>
<html>
  <head>
    <title>User Registeration</title>

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

    <div class="container">
    <form class="form-signin" method="POST">

      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
      <h2 class="form-signin-heading">Please Register</h2>
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
      	<input type="text" name="username" class="form-control" placeholder="Username" required>
      </div>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      <a class="btn btn-lg btn-primary btn-block" href="Login.php">Login Page</a>
    </form>
    </div>

  </body>

</html>
