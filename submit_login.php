<?php
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

//Search for username in database
$checkUsername = mysql_query("SELECT * FROM userprofiles WHERE username = '".$_POST['username']."'")
    or die(mysql_error());

//Gives error if user dosen't exist
$checkUserExist = mysql_num_rows($checkUsername);
if ($checkUserExist == 0){
    die('User does not exist');
} else {
    echo 'you good'; //get rid of this later
}

while($info = mysql_fetch_array($checkUsername)){
    $_POST['password'] = stripslashes($_POST['password']);
 	$info['password'] = stripslashes($info['password']);
 	$_POST['pass'] = md5($_POST['pass']);
	
    //gives error if the password is wrong
 	if ($_POST['pass'] != $info['password']){
 		die('Incorrect password, please <a href="http://people.oregonstate.edu/~leebran/CS%20290%20Final%20Project/">try again</a>.');
 	}
	
	else{ // if login is ok then we add a cookie 
		$_POST['username'] = stripslashes($_POST['username']); 
		$hour = time() + 3600; 
		setcookie(ID_your_site, $_POST['username'], $hour); 
		setcookie(Key_your_site, $_POST['pass'], $hour);	 
 
		//then redirect them to the members area 
		header("Location: members.php");
	}
}

mysql_close($mysql_handle);
?>