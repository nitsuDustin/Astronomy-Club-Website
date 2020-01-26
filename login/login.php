<?php
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type = "text/css" href="login.css">
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
</head>
    <body>
        <a href="../index.html"><button>Back</button></a>
        <?php
            $uname = $_REQUEST["username"];
            $password = $_REQUEST["password"];
            $remember = $_REQUEST["rememberme"];
            $msg = "";
            $_SESSION["username"] = $uname;
            $_SESSION["password"] = $password;
            print "hello world\n";
            print $_SESSION["username"];
            print $_SESSION["password"];
            include_once('db.php');
            $db = db_open("easel2.fulgentcorp.com", "kau853", "kau853", "VpbEIJ10n7UduTmJn3qo");
            $users = db_query($db, "SELECT * FROM Users WHERE 1");
            if(isset($_COOKIE["username"]) and isset($_COOKIE["password"])) {
                $_SESSION["username"] = $_COOKIE["username"];
                $_SESSION["password"] = $_COOKIE["password"];
                header('Location: ../main.php');
            }

            while(($user = db_fetch($users)) != NULL) {
                //Checking if username and password match
                if($uname == $user["Id"] and $password == $user["Password"]) {
                    //Store cookie if remember me is checked
                    if($remember == 1) {
                        setcookie("username", $uname, time() + (86400 * 7), "/");
                        setcookie("password", $password, time() + (86400 * 7), "/");
                    }
                    header('Location: ../main.php');
                    //exit;
                }
                else if($uname != "" and $password != "") {
                    $msg = "Incorrect Username or Password, try again.";
                }
                else if($uname == "" and $password == "") {
                    $msg = "Please enter a Username and Password.";
                }
                else {
                    $msg = "";
                }
            } 
        ?>
        <?php
            print '<p id ="errmsg" class = "err">'. $msg . '</p>';
        ?>
        <h1>
            UTSA Astronomy Club Login
        </h1>
        <form action = "login.php" method = "post">
            Enter your username:<br>
            <input type = "text" name = "username" value = ""><br><br>
            Enter your password:<br>
            <input type = "password" name = "password" value = ""><br><br>
            <input type="hidden" name = "rememberme" value=0>
            <input type = "checkbox" name = rememberme value=1>Remember me<br><br>
            <input class="submit" type = "submit" value = "Submit">
        </form>
    </body>
</html>