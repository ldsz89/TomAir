<?php
    ob_start();
    session_start();
    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
    $query = "DELETE FROM Certifications WHERE Emp_ID = ? AND Equip_Serial = ?";
    if($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, 'is', $_SESSION['Emp_ID'], $_POST['Equip_Serial']);
        if(mysqli_stmt_execute($stmt)) {
            date_default_timezone_set('America/Chicago');
            $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Emp_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'CERTIFICATION DELETION', 'PILOT', ".$_SESSION['Emp_ID'].")";

            if(!mysqli_query($link, $sql)){
                printf("Errormessage: %s\n", mysqli_error($link));
            }
            else {
                header("Location: Certifications.php");
                mysqli_stmt_close($stmt);
                mysqli_close($link);
                exit;
            }
        }
    }
?>