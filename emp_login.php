<!DOCTYPE html>
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
            
            #header_btn {
                margin: 0 auto;
            }
        </style>
    </head>
    
    <body>
        <div class="container">
            <div class="row">
                <div id="header" class="col-md-11">
                    <a href="index.php" id="header_link">TomAir</a>
                </div>
                <div class="col-md-1">
                    <form action="login.php">
                        <button class="btn glyphicon glyphicon-log-in" type="submit" name="submit" action="emp_login.php"> Login</button>
                    </form>
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
                    <div class="input-group col-md-offset-3">
                        <span class="input-group-addon" id="basic-addon1">Employee Login</span>
                        <input type="text" name="emp_id" class="form-control" placeholder="ID">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <span class="input-group-addon">
                            <input type="submit" name="login" value="Login">
                        </span>
                    </div>
                    <br>
                    <br>
                </form>
                <form action="login.php">
                    <button type="submit" class="btn btn-default col-md-offset-5" aria-label="Left Align">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    Are you a customer?
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>

<?php
    include("../storage/database.php");
    if( !(session_start()) ) {
        header("Location: index.php");
        exit;
    }
    if(isset($_POST['login'])){
        $link = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Error connecting to server" . mysqli_error($link));
//        $link = mysqli_connect('localhost', 'kmstk5', '75e93c2', 'CS3380GRP23');
        $emp_id = $_POST['emp_id'];
        $password = $_POST['password'];
        $query = "SELECT * FROM Employee WHERE Emp_ID=? AND Password=?";
        
        if($stmt = mysqli_prepare($link, $query)){
            mysqli_stmt_bind_param($stmt, "ss", $emp_id, $password);
            if(mysqli_stmt_execute($stmt)){
                if(mysqli_num_rows($result) == 1){
                    $_SESSION['emp_id'] = $emp_id;
                    header("Locaton: EmployeeDash.html");
                    exit;
                }
                else{
                    echo "ID or password invalid";
                }
            }
        }
    }
?>
