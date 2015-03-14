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

//Proof that session is connecting
echo $_SESSION['firstname'];
echo 'theprofilepic selection:';
echo $_SESSION['profilePic'];
echo 'cid is:';
echo $_SESSION['cid'];

/*
//Queries to find user in database
$userRow = mysqli_query($conn, "SELECT * FROM userprofiles WHERE cid = ".$_SESSION['cid']."")
    or die(mysql_error());

//Fetch row and create into array
$row = mysqli_fetch_array($userRow);
*/

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $filename = $_FILES["myfile"]["name"];
    $tmpfile = $_FILES["myfile"]["tmp_name"];
    $filesize = $_FILES["myfile"]["size"];
    $filetype = $_FILES["myfile"]["type"];
    
    echo 'The filename is: ';
    echo $filename;
    
    if ($filetype == "image/jpeg" && $filesize < 1048576) {
        //My code, not registering prepared statment for database update.
        $filedata = file_get_contents($tmpfile);
        $stmt = $conn->prepare("UPDATE userProfiles SET profilePic=? WHERE cid=".$_SESSION['cid']."");
        $empty = NULL;
        $stmt->bind_param("b", $empty);
        $stmt->send_long_data(0, $filedata);
        $stmt->execute();
        /* Safiddi's Original code
        $query = $conn->prepare("INSERT INTO userprofiles(profilePic) VALUES (?)");
        $empty = NULL;
        $query->bind_param("b", $empty);

        $query->send_long_data(2, $filedata);
        $query->execute();
        */
        echo "Thank you.";
    } else {
        echo "Image not processed. Only jpegs under 1MB are allowed.";
    }
}

$conn->close();
?>