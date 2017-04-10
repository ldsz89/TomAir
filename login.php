<!DOCTYPE html>
<?php
    if(!session_start()) {
        header("Location: login.php");
        exit;
    }

    $loggedIn empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];

    if($loggedIn) {
        switch($_SESSION['type']) {
            case "Pilot":
                header("Location: PilotDash.php");
                break;
            case "Attendant":
                
                break;
            case "Administrator":
                header("Location: AdminDash.html");
                exit;
                break;
            default:
                break;
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Signika" rel="stylesheet">
<!--        <link href="style.css" rel="stylesheet">-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            #header {
                font-size: 24pt;
            }
            
            #header_link {
                color: black;
                text-decoration: none;
            }
        </style>
    </head>
    
    <body>
        <div class="container">
            <div class="row">
                <div id="header" class="col-md-12">
                    <a href="index.php" id="header_link">TomAir</a>
                </div>
            </div>
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <div class="row">
                <form method="POST" action="login.php" class="form-inline">
                    <div class="input-group col-md-offset-4">
                        <span class="input-group-addon" id="basic-addon1">Customer ID</span>
                        <input type="text" class="form-control" placeholder="Customer ID" aria-describedby="basic-addon1">
                        <span class="input-group-addon">
                            <input type="submit" name="submit" value="Sign In">
                        </span>
                    </div><br><br>
                </form>
                <form action="emp_login.php">
                    <button type="submit" class="btn btn-default col-md-offset-5" aria-label="Left Align">
                    Are you an employee? <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                </button>
                </form>
            </div>
        </div>
    </body>
</html>