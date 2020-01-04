<?php
//Open up a database, returns a link for the other calls
function db_open($url, $db, $user, $pw){
    $db_link = mysqli_connect($url, $user, $pw);
    mysqli_select_db($db_link, $db);
    mysqli_query($db_link, 'SET NAMES UTF8;');
    return $db_link;
}

//All done -- close the DB connection
function db_close($db_link) {
    mysqli_close($db_link);
}

//If something failed, get error number
function db_errorno($db_link) {
    return mysqli_errno($db_link);
}

//If something failed, get error message
function db_error($db_link) {
    return mysqli_error($db_link);
}

//Perform some kind of action like SELECT or INSERT or whatever
function db_query($db_link, $query) {
    $result = mysqli_query($db_link, $query);
    if($result === FALSE) die(mysqli_error($db_link));
    return $result;
}

//Following a db_query, call db_fetch multiple times
function db_fetch($query){
    return mysqli_fetch_array($query);
}

//Following a db_query, call db_num_rows to get row count
function db_num_rows($array){
    return mysqli_num_rows($array);
}

//Load a csv file ful of comma separated values
function db_load_data($db_link, $file, $table){
    $query = "LOAD DATA LOCAL INFILE'" . $file . "' INTO TABLE ". $table .
    " FIELDS TERMINATED BY ',' ENCLOSED BY '\' ESCAPED BY '\\\\' LINES TERMINATED BY '\\r\\n' IGNORE 1 LINES";
    $result = mysqli_query($db_link, $query);
    if($result === FALSE) die(mysqli_error($db_link));
    return mysqli_affected_rows($db_link);
}
?>