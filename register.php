<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type = "text/css" href="register.css">
<title>Create an account</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<script src = "register.js" type = "text/javascript"></script>
</head>
    <body>
        <a href="Huynh_kau853.html"><button>Back</button></a>
        <?php
        $username = $_REQUEST["username"];
        $first = str_replace("'", "", strip_tags($_REQUEST["firstname"]));
        $last = str_replace("'","",strip_tags($_REQUEST["lastname"]));
        $college = $_REQUEST["college"];
        $admin = $_REQUEST["isAdmin"];
        $password = $_REQUEST["password"];
        $year = $_REQUEST["year"];
        $month = $_REQUEST["month"];
        $day = $_REQUEST["day"];
        $msg = "";
        if($username and (strlen($username) < 4)) {
            $msg = "Username must be at least 4 characters long";
        }
        //Check username for letters only 
        if($username and !ctype_alpha($username)) {
            $msg = "Username must be a-z or A-Z, no space, digits, or symbols";
        }
        //Check for invalid year
        if($year and ($year <= 1900 or $year >=2100)) {
            $msg = "Invalid year: " . $year . " must be between 1901 and 2099";
        }
        //Check for invalid month
        if($month and ($month < 1 or $month > 12)) {
            $msg = "Invalid month: " . $month . " must be between 1 and 12";
        }
        //Checking for day
        if($month and ($month == 1 or $month == 3 or $month == 5 or $month == 7 or $month == 8 or $month or 10 or $month == 12)) {
            if($day < 1 or $day > 31) {
                $msg = "Invalid day: " . $day . " must be between 1 and 31";
            }
        }
        else if($month and ($month == 2)) {
            if(($year%4 == 0) and ($year > 1900 or $year < 2100)) {
                if($day and ($day < 1 or $day > 28)) {
                    $msg = "Invalid day: " . $day . " must be between 1 and 28";
                } 
            }
            else {
                if($day and ($day < 1 or $day > 29)) {
                    $msg = "Invalid day: " . $day . " must be between 1 and 29";
                }
            }
        }
        else {
            if($day and ($day < 1 or $day > 30)) {
                $msg = "Invalid day: " . $day . " must be between 1 and 30";
            }
        }

        include_once('db.php');
        $db = db_open("easel2.fulgentcorp.com", "kau853", "kau853", "VpbEIJ10n7UduTmJn3qo");
        $users = db_query($db, "SELECT * FROM Users WHERE 1");
        //Checking if username exists
        while(($user = db_fetch($users)) != NULL) {
            if($user["Id"] == $username and $username) {
                $msg = "That username already exists, please enter another one.";
            }
        }
        if($username and $first and $last and $college and $year and $month and $day) {
            db_query($db, 'INSERT INTO Users (First, Last, Id, IsAdmin, College, Year, Month, Day, Password)
                        VALUES("' . $first . '", "' . $last . '", "' . $username . '", ' . $admin . 
                        ', "' . $college . '", ' . $year . ', ' . $month . ', ' . $day . ', "' . $password . '")');
            header('Location: Huynh_kau853.html');
            exit;
        }
        if(!$username or !$first or !$last or !$password or !$college or !$year or !$month or !$day){
            $msg = "All fields are required";
        }
        
        //$msg = $username . " " . $first . " " . $last . " " . $college;
        ?>


        <?php
            print '<p id ="errmsg" class = "err">'. $msg . '</p>';
        ?>

        <h1>
            UTSA Atronomy Registeration
        </h1>
        <form action = "register.php" method = "post">
        <table cellpadding="20"><tr>
            <td>
            <b>First name:</b><br>
            <input type = "text" name = "firstname" value = ""><br><br>

            <b>Last name:</b><br>
            <input type = "text" name = "lastname" value = ""><br><br>

            <b>Username:</b><br>
            <input onchange="checkUsername()" type = "text" id="username" name = "username" value = ""><br><br>

            <b>Password:</b><br>
            <input type = "password" name = "password" value = ""><br><br>
            <input type = "hidden" name = "isAdmin" value = 0>
            <input type = "checkbox" name = "isAdmin" value = 1>Admin<br><br>
            <!--<input type = "submit" value = "Submit">-->
            <input class="submit" disabled id="submit" type="submit"/>
            <td class = "college"><b>Choose your college</b>
            <table class = "college">
                <tr><td><input type = "radio" name = "college" value = "Fine Arts">Fine Arts</th>
                <tr><td><input type = "radio" name = "college" value = "Business">Business</th>
                <tr><td><input type = "radio" name = "college" value = "Education">Education</th>
                <tr><td><input type = "radio" name = "college" value = "Engineering">Engineering</th>
                <tr><td><input type = "radio" name = "college" value = "Architecture">Architecture</th>
                <tr><td><input type = "radio" name = "college" value = "Sciences">Sciences</th>
            </table>
            <td class="year">
            <b>Enter your brithday</b><br><br>
            <b>Enter a Year:</b>
            <?php
                print '  <br/><input onchange="checkDate()" type="text" id="year" name="year" width="40" value="' . $year . '"/>';
            ?>
            <td class = "month"><b>Choose a Month:</b><br>
            <table class = "m">
                <tr class = "m">
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "1">January</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "2">February</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "3">March</th>
                <tr class = "m">
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "4">April</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "5">May</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "6">June</th>

                <tr class = "m">
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "7">July</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "8">August</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "9">September</th> 
                <tr class = "m">
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "10">October</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "11">November</th>
                    <td class = "m"><input onchange="checkDate()" type ="radio" name ="month" value = "12">December</th>
            </table>
                <td class="day"><b>Select a Day:</b><br/>
                <select onchange="checkDate()" name = "day" id = "day">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <!--<td><input disabled id="submit" type="submit"/>-->
        </table>
        </form>
    </body>
</html>