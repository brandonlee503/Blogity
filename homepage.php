<?php
//Start PHP session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="User Homepage">
    <meta name="author" content="Brandon Lee">    
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/homepagecover.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/blogity_logo.ico">
    <title>Blogity</title>
</head>
<body>
    <!-- --------------------------------- The two main wrappers for the site --------------------------------- -->
    <div class="site-wrapper">
        <div class="site-wrapper-inner">
    <!-- --------------------------------- Navagation Bar --------------------------------- -->
          <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
              <div class="container">
                  <div class="navbar-header">
                      <a class="navbar-brand" href="#">Blogity</a>
                  </div>
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="#"><?php echo $_SESSION['firstname']; ?></a></li>
                  </ul>
                  <form data-toggle="validator" role="form" class="navbar-form pull-right" action="submit_logout.php" method="post">
                      <button type="submit" class="btn">Logout</button>
                  </form>
              </div>
          </div>
        <!----------------------End nav bar and begin main page, left column------------------->
          <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <!-- Profile picture, update later -->
                      <img src="images/default_profile_photo.png">
                      <br><br>
                      <!-- User's Name -->
                      <h3> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> </h3>
                      <br>
                      <!-- User's username -->
                      <h4><?php echo "Username: " . $_SESSION['username']; ?></h4>
                      <br>
                      <!-- User's email -->
                      <h4><?php echo "Email: " . $_SESSION['email']; ?></h4>
                  </div>
                  <!-----------------------------Begin Right column ----------------------------->
                  <div class="col-md-6">
                      <!-- User's profile, name, and current status -->
                      <img src="images/default_profile_photo.png" width='50' height ='50'>
                      <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> 
                      <h3><?php echo 'Status: '; echo $_SESSION['status']; ?></h3>
                      <br>
                      <!-- Form to update status -->
                      <form class="form-inline" role="form" autocomplete="off" action="update_status.php" method="post">
                          <div class="form-group">
                              <input name="status" type="text" class="form-control" placeholder="What's on your mind?">
                              <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                      </form>
                  </div>
              </div>
              <!-- --------------------------------- Footer --------------------------------- -->
              <div class="mastfoot">
                  <div class="inner">
                      <p>(C) Brandon Lee 2015</p>
                  </div>
              </div>
          </div>
        </div>
    </div>
</body>
</html>












