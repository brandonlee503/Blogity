<?php
//TEST DOCUMENT DO NOT DELETE
//Start PHP session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blogify</title>
    <script src="js/jquery-1.11.2.js"></script>
    <script>
        $("#statusForm").submit(function() {
            var url = "update_status.php"; // the script where you handle the form input.
            $.ajax({
                type: "POST",
                url: url,
                data: $("#statusForm").serialize(), // serializes the form's elements.
                success: function(data){
                    alert(data); // show response from the php script.
                }
            });
            return false; // avoid to execute the actual submit of the form.
        });
    </script>
</head>
<body>
<!-- PHP Session Stuff -->
<?php
//For reference that it works
echo "Username is " . $_SESSION['username'] . ".<br>";
echo "Firstname is " . $_SESSION['firstname'] . ".<br>";
echo "Lastname is " . $_SESSION['lastname'] . ".<br>";
echo "email is " . $_SESSION['email'] . ".<br>";
echo "cid is " . $_SESSION['cid'] . ".<br>";

//Check if there is existing profile picture
if($_SESSION['profilePic'] === NULL){
    echo 'no profile pic';
    $img_path = 'images/default_profile_photo.png';
}else{
    echo 'there is one';
    //$img_path = 
}
?>
    <?php
    echo "<img src='$img_path'/>";
    ?>
    Status:
    <?php echo $_SESSION['status']; ?>
    <form id="statusForm" action="update_status.php">
        <input type="text" name="status">
        <input type="submit" value="Submit">
    </form>

    <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="myfile">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    
    <form action="submit_logout.php">
        Logout:
        <input type="submit" value="Logout">
    </form>
    
</body>
</html>