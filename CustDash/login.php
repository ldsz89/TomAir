<?php
    session_start();
    if(isset($_SESSION['Cust_ID'])) {
        header("Location http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/CustDash/CustomerDash.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!--        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<!--        <link rel="stylesheet" href="css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="http://cs3380.rnet.missouri.edu/group/CS3380GRP23/www/styles.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            body {
                background-image: url("../AdminDash/Background/CityScape.jpg");
                background-color: #f7f7f7;
                /*background: -webkit-linear-gradient(top, white, lightblue, skyblue, lightblue);*/
            }

            h3 {
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

            #content {
                text-align: center;
            }

            .row {
                padding: 15px;
            }

            /* Add a gray background color and some padding to the footer */
            footer {
                background-color: #C05F5F;
                padding: 15px;
            }
        </style>
    </head>
    
    <body>
        <div class="container text-center">
            <h2 class="form-signin-heading">Customer Login</h2>
            <?php
                if(isset($_POST['Cust_ID'])) {                    
                    $link = mysqli_connect('localhost', 'CS3380GRP23', 'e7d18aa', 'CS3380GRP23');
                    $query = "SELECT * FROM Customer WHERE Cust_ID = ". $_POST['Cust_ID'];
                    
                    $result = mysqli_query($link, $query);
                    if(($result->num_rows) == 1) {
                        $_SESSION['Cust_ID'] = $_POST['Cust_ID'];
                        date_default_timezone_set('America/Chicago');
                        $sql = "INSERT INTO Log(Log_IP_Address, Log_Date, Log_Time, Log_Action, Log_User, Cust_ID) VALUES('".$_SERVER['REMOTE_ADDR']."', '".date('Y-m-d')."', '".date('H:i:s')."', 'LOGIN', 'CUSTOMER', ".$_SESSION['Cust_ID'].")";
                        
                        if(!mysqli_query($link, $sql)){
                            printf("Errormessage: %s\n", mysqli_error($link));
                        }
                        else {
                            header("Location: CustomerDash.php");
                            exit;
                        }
                    }
                    else {
                        echo "<div class='well'>ID entered does not exist</div>";
                    }
                }
            ?>
            <form method="POST" action="login.php" class="form-signin form-inline">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Customer ID</span>
                    <input type="number" class="form-control" name="Cust_ID">
                </div><br><br>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
            </form>
            <a class="btn btn-default" href="../index.php"><span class="glyphicon glyphicon-chevron-left"></span>Home</a>
        </div>
    </body>
</html>