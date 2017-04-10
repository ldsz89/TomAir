<?php
    session_start();
    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
    date_default_timezone_set('America/Chicago'); //setting time zone for the logs
    switch ($_SESSION['Emp_Type']) { // switch for the logging system
      case 0:
        $type='ADMIN';
        break;
      case 1:
        $type='PILOT';
        break;
      case 2:
        $type='ATTENDANT';
        break;

      default:
        # code...
        break;
    }
    $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Emp_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'LOGOUT', '$type', ".$_SESSION['name'].")"; // ADdingthe logout log

    if(!mysqli_query($link, $sql)){
        printf("Errormessage: %s\n", mysqli_error($link)); // error message to display in the case it fails.
    }
    else {
        mysqli_close($link);
        if(session_destroy()){ //destroying the logged in sessions
            header('Location: Login.php'); //After logout we redirect back to the login page.
            exit;
        }
    }
?>
