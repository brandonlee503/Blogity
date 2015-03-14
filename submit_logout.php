<?php
session_start();
//Remove all session variables
session_unset();
//Destroy the session
session_destroy();
//Redirect to login page
header("Location: http://people.oregonstate.edu/~leebran/CS%20290%20Final%20Project/");
?>