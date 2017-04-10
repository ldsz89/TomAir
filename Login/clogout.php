<?php
    session_start();
    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
    date_default_timezone_set('America/Chicago');
    $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Cust_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'LOGOUT', 'CUSTOMER', ".$_SESSION['Cust_ID'].")";

    if(!mysqli_query($link, $sql)){
        printf("Errormessage: %s\n", mysqli_error($link));
    }
    else {
        mysqli_close($link);
        if(session_destroy()){
            header('Location: ../index.php');
            exit;
        }
    }
?>
