<?php
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type = "text/css" href="style.css">
<title>UTSA Astronomy Club</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<script src="main.js" type="text/javascript"></script>
</head>
    <body>
        <a href="Huynh_kau853.html"><button>Back</button></a>
        <h1>
            The UTSA Astronomy Club
        </h1>
        <p class="one">
            Email me: 
            <a href = "mailto:dustin.huynh11@gmail.com">
                Dustin Huynh
            </a>          
        </p>
        <img class="right" src="space.jpg" height="200"/>
        <p class = "two">
                This is the official website for the UTSA Atronomy Club.
                We talk about space related things like planets, asteroids,
                aliens, different galaxys, and the recent raid on area 51.
                We also host star gazing nights every friday at 7pm. Telescopes
                are provided, you just need to show up!             
        </p>
        <p class = "three">
                Our first meeting is on <b>01/01/3000</b>. See you there!
        </p>
        <p class = "four">
            If you would like to learn more about astronomy you can go to 
            <a href = "https://www.aiaa.org/"> The American Institute of Aeronautics and Astronautics</a>.
            You can also go check out <a href = "https://www.nasa.gov/">NASA</a>
            for more space related news.
        </p>
        <img class = "left" src = "telescope.jpg" height = "200"/>
        <?php
            $uname = $_SESSION["username"];
            $password = $_SESSION["password"];
            include_once('db.php');
            $db = db_open("easel2.fulgentcorp.com", "kau853", "kau853", "VpbEIJ10n7UduTmJn3qo");
            $users = db_query($db, 'SELECT * FROM Users WHERE Id = "' . $uname . '" AND Password ="' . $password . '"');
            //Loop through the query and assign variables
            while(($user = db_fetch($users)) != NULL) {    
                $first =  $user["First"];
                $last =  $user["Last"];
                $admin =  $user["IsAdmin"];
                $college =  $user["College"];
                $year =  $user["Year"];
                $month =  $user["Month"];
                $day =  $user["Day"];
            }
            //Print out user information
            print '<p class="user">Hello, ' . $first . ' ' . $last . ".<br>";
            if($admin == 1) {
                print "Admin: Yes<br>";
            }
            else {
                print "Admin: No<br>";
            }
            print "College: " . $college . " <br>";
            print "Birthday: " . $month . "/" . $day . "/" . $year . "</p>";
            //Find all colleges in the query
            $colleges = db_query($db, 'SELECT College FROM Users Where 1');
            $sci = 0;
            $arch = 0;
            $eng = 0;
            $edu = 0;
            $bus = 0;
            $fa = 0; 
            //Count the number of students in each college
            while(($col = db_fetch($colleges)) != NULL) {  
                $temp = $col["College"];
                if($temp == "Sciences") {
                    $sci++;
                }
                if($temp == "Architecture") {
                    $arch++;
                }
                if($temp == "Engineering") {
                    $eng++;
                }
                if($temp == "Education") {
                    $edu++;
                }
                if($temp == "Business") {
                    $bus++;
                }
                if($temp == "Fine Arts") {
                    $fa++;
                }
            }
            $total = $sci + $arch + $eng + $edu + $bus + $fa;
            db_close($db);
        ?>
        <?php
            //Print the bar graph if there is at least 1 entry in colleges
            if($sci or $arch or $eng or $edu or $bus or $fa) {
                print '
                    <canvas id="cnvs" width="700" height="400"></canvas>
                    <script type="text/javascript">
                        barData = [ {lbl: "Sciences", val: ' . $sci/$total . '}, {lbl: "Architecture", val: ' . $arch/$total . '}, 
                        {lbl: "Engineering", val: ' . $eng/$total . '}, {lbl: "Education", val: ' . $edu/$total . '}, 
                        {lbl: "Business", val: ' . $bus/$total . '}, {lbl: "Fine Arts", val: ' . $fa/$total . '}];
                        bar("cnvs", barData);
                    </script>';
            }
        ?>
    </body>
    
</html>