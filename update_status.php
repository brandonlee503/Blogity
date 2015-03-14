<?php
//Start the session
session_start();

//Database info
$servername = "oniddb.cws.oregonstate.edu";
$username = "leebran-db";
$password = "oUQk7V9tWXZH65Xd";
$dbname = "leebran-db";

//Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Get form submission and clean it
$status = $_REQUEST["status"];
$cleanInput = mysqli_real_escape_string($conn, $status);

//Set update to specific logged in user
$update = "UPDATE userprofiles SET status='$cleanInput' WHERE cid=".$_SESSION['cid']."";

//Check query update
if(!$conn->query($update) === TRUE){
    die('Error updating record:' . $conn->error);
}

$conn->close();

//Redirect to homepage
header("Location: http://people.oregonstate.edu/~leebran/CS%20290%20Final%20Project/homepage.php");

?>