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

//Get username and password
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];

//Cleans username input
$cleanUser = mysql_real_escape_string($username);

//Cleans password input and encrypt for database comparison
$cleanPass = mysql_real_escape_string(base64_encode(hash('sha256',$password)));


//Queries to find user in database
$userRow = mysql_query("SELECT * FROM userprofiles WHERE username = '$cleanUser' AND password = '$cleanPass'")
    or die(mysql_error());

//Fetch row and create into array
$row = mysql_fetch_array($userRow);

//Check cid for valid account info
if(strlen($row[0]) < 1){
    die ('Invalid Username or Password');
}

//Create session variables
$_SESSION['cid'] = $row[0];
$_SESSION['username'] = $row[1];
$_SESSION['firstname'] = $row[2];
$_SESSION['lastname'] = $row[3];
$_SESSION['email'] = $row[6];
$_SESSION['status'] = $row[7];
$_SESSION['profilePic'] = $row[8];

//Redirect to user homepage
header("Location: http://people.oregonstate.edu/~leebran/CS%20290%20Final%20Project/homepage.php");

mysql_close($mysql_handle);
?>