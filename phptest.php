<?php
//Start PHP Session
session_start();

//Database info
$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'leebran-db';
$dbuser = 'leebran-db';
$dbpass = 'oUQk7V9tWXZH65Xd';

//Connect to database
$mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass)
    or die("Error connecting to database server");

mysql_select_db($dbname, $mysql_handle)
    or die("Error selecting database: $dbname");

echo 'Successfully connected to database!';

//Get username and password
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
echo $username;
echo $password;

//Cleans username input
$cleanUser = mysql_real_escape_string($username);

//Cleans password input and encrypt for database comparison
$cleanPass = mysql_real_escape_string(base64_encode(hash('sha256',$password)));


//Queries to find user in database
$userRow = mysql_query("SELECT * FROM userprofiles WHERE username = '$cleanUser' AND password = '$cleanPass'")
    or die('Invalid Username or Password'.mysql_error());
//might not need...
if(!$userRow){
    echo 'Invalid Username or Password' . mysql_error();
    exit;
}

$row = mysql_fetch_array($userRow);
echo "User's username: $row[1], User's email: $row[6]";

echo "Here is the session username: ";
echo $_SESSION["username"];


mysql_close($mysql_handle);
?>