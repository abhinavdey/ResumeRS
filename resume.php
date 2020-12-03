<?php // Do not put any HTML above this line
session_start();

require_once "pdo.php";
require_once "util.php";

$stmt = $pdo->query("SELECT profile_id, first_name,last_name , headline from users join Profile on users.user_id = Profile.user_id");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags always come first -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">

  <title>Resume Registry System: About Us</title>

</head>

<body>

    <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
            <span class="navbar-toggler-icon"></span>
          </button>
           <a class="navbar-brand mr-auto" href="index.php"><img src="img/resume.jpg" height="30" width="41"></a>
           <div class="collapse navbar-collapse" id="Navbar">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item "><a class="nav-link" href="./index.php"><span class="fa fa-home fa-lg"></span> Home</a></li>
               <li class="nav-item"><a class="nav-link" href="./login.php"><span class="fa fa-sign-in fa-lg"></span> Login</a></li>
               <li class="nav-item"><a class="nav-link" href="./register.php"><span class="fa fa-sign-in fa-lg"></span> Register</a></li>
               <li class="nav-item active"><a class="nav-link" href="./resume.php"><span class="fa fa-list fa-lg"></span> Resume</a></li>

               <li class="nav-item"><a class="nav-link" href="./contactus.php"><span class="fa fa-address-card fa-lg"></span> Contact</a></li>
             </ul>
             <span class="navbar-text">
          <a id="logout"><span class=""></span> 	<?php
        if (isset($_SESSION['name'])) {
            echo '<p><a href="logout.php">Logout</a></p>';
        }
        ?></a>
        </span>
           </div>
        </div>
    </nav>

    <header class="jumbotron">
        <div class="container">
            <div class="row row-header">
                <div class="col-12 col-sm-6">
                  <h1>Resume Registry System</h1>
                  <p>We take the best Resumes from the best faculties in the world, and create a unique experience for colleges to have them.</p>
                </div>
                <div class="col-12 col-sm text-center align-self-center">

                </div>
            </div>
        </div>
    </header>
  <div class="backimg" style="background-image: url(img.jpeg) !important">
    <div class="container">
        <div class="row">
          <ol class="col-12 breadcrumb">
            <li class="breadcrumb-item"><a href="./index.html">Home</a></li>
            <li class="breadcrumb-item active">Resume</li>
          </ol>
          <div class="col-12">
             <h3>Resume Entries</h3>
             <hr>
          </div>
        </div>


    <?php
    flashMessage();
    ?>


       <div class="row row-content">
         <div class="col-12 col-sm-9">
           <h2>Facts &amp; Figures</h2>
           <div class="table-responsive">
						 <?php
         if (!isset($_SESSION['name'])) {
             echo "<p><a href='login.php'>Please log in</a></p>";
         }
         if (true) {
             if (true) {
                 echo "<table class='table table-striped' >";
                 echo " <thead class='thead-dark'><tr>";
                 echo "<th>Name</th>";
                 echo " <th>Headline</th>";
                 if (isset($_SESSION['name'])) {
                     echo("<th>Action</th>");
                 }
                 echo " </tr></thead>";
                 foreach ($rows as $row) {
                     echo "<tr><td>";
                     echo("<a href='view.php?profile_id=" . $row['profile_id'] . "'>" . $row['first_name'] . $row['last_name']  . "</a>");
                     echo("</td><td>");
                     echo($row['headline']);
                     echo("</td>");
                     if (isset($_SESSION['name'])) {
                         echo("<td>");
                         echo('<a href="edit.php?profile_id=' . $row['profile_id'] . '">Edit</a> / <a href="delete.php?profile_id=' . $row['profile_id'] . '">Delete</a>');
                     }
                     echo("</td></tr>\n");
                 }
                 echo "</table>";
             } else {
                 echo 'No rows found';
             }
         }
         echo '</li></ul>';
         ?>
         <p><a href="add.php">Add New Entry</a></p>
         </div>
         <div class="col-12 col-sm-3">
         </div>
       </div>
     </div>
    </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-4 offset-1 col-sm-2">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                      <li><a href="./index.php">Home</a></li>
                      <li><a href="./login.php">Login</a></li>
                      <li><a href="./register.php">Register</a></li>
                      <li><a href="./resume.php">Resume</a></li>
                        <li><a href="./contactus.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-7 col-sm-5">
                    <h5>Our Address</h5>
                    <address>
                      SRM Nagar<br>
                      Kattankulathur - 603 203<br>
                      Chengalpattu District, Tamil Nadu<br>
                      <i class="fa fa-phone fa-lg"></i>: +91-44- 27417000<br>
                      <i class="fa fa-fax fa-lg"></i>: +91-44- 27417000<br>
                      <i class="fa fa-envelope fa-lg"></i>: <a href="mailto:infodesk@srmist.edu.in">infodesk@srmist.edu.in</a>
                    </address>
                </div>
                <div class="col-12 col-sm-4 align-self-center">
                    <div class="text-center">
                      <a class="btn btn-social-icon btn-google" href="http://google.com/+"><i class="fa fa-google-plus"></i></a>
                      <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id="><i class="fa fa-facebook"></i></a>
                      <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/"><i class="fa fa-linkedin"></i></a>
                      <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/"><i class="fa fa-twitter"></i></a>
                      <a class="btn btn-social-icon btn-google" href="http://youtube.com/"><i class="fa fa-youtube"></i></a>
                      <a class="btn btn-social-icon" href="mailto:"><i class="fa fa-envelope-o"></i></a>
                    </div>
                </div>
           </div>
           <div class="row justify-content-center">
                <div class="col-auto">
                    <p>© Copyright 2018 Resume Registry System</p>
                </div>
           </div>
        </div>
    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>
