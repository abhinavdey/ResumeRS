<?php

session_start();

require_once "pdo.php";


try{

    $sql = "INSERT INTO users (name, email, password) VALUES (:fname, :email, md5(:password))";
    $stmt = $pdo->prepare($sql);


    $stmt->bindParam(':fname', $_REQUEST['name']);
    $stmt->bindParam(':email', $_REQUEST['email']);
    $stmt->bindParam(':password', $_REQUEST['password']);


    $stmt->execute();
    echo "Records inserted successfully.";
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}


unset($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Register</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">
    <link href="css/style.css" rel="stylesheet">
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
                  <li class="nav-item "><a class="nav-link" href="./login.php"><span class="fa fa-sign-in fa-lg"></span> Login</a></li>
                  <li class="nav-item active"><a class="nav-link" href="#"><span class="fa fa-sign-in fa-lg"></span> Register</a></li>
                  <li class="nav-item"><a class="nav-link" href="./resume.php"><span class="fa fa-list fa-lg"></span> Resume</a></li>

                  <li class="nav-item"><a class="nav-link" href="./contactus.php"><span class="fa fa-address-card fa-lg"></span> Contact</a></li>
                </ul>
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
      <li class="breadcrumb-item active">Register</li>
    </ol>
    <div class="col-12">
       <h3>Register Here</h3>
       <hr>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">
<br>
<hr>


<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<header class="card-header">
	<a href="./login.php" class="float-right btn btn-outline-primary mt-1">Log in</a>
	<h4 class="card-title mt-2">Sign up</h4>
</header>
<article class="card-body">
<form method="POST" action="register.php">
	<div class="form-row">
		<div class="col form-group">
			<label>First name </label>
		  	<input type="text" name="fname"class="form-control" placeholder="First Name">
		</div>
		<div class="col form-group">
			<label>Last name</label>
		  	<input type="text" name="lname" class="form-control" placeholder="Last Name ">
		</div>
	</div>
	<div class="form-group">
		<label>Email address</label>
		<input type="email" name="email" class="form-control" placeholder="Enter your Email Address">
		<small class="form-text text-muted">We'll never share your email with anyone else.</small>
	</div>
	<div class="form-group">
			<label class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gender" value="option1">
		  <span class="form-check-label"> Male </span>
		</label>
		<label class="form-check form-check-inline">
		  <input class="form-check-input" type="radio" name="gender" value="option2">
		  <span class="form-check-label"> Female</span>
		</label>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
		  <label>City</label>
		  <input type="text" class="form-control" placeholder="City">
		</div>
		<div class="form-group col-md-6">
		  <label>Country</label>
		  <select id="inputState" class="form-control">
		    <option> Choose...</option>
		      <option>United Kingdom</option>
		      <option>Australia</option>
		      <option selected="">United States</option>
		      <option>India</option>
		      <option>Canada</option>
		  </select>
		</div>
	</div>
	<div class="form-group">
		<label>Create password</label>
	    <input class="form-control" name="password" type="password" placeholder="Password">
	</div>
    <div class="form-group">
        <button type="submit" name="register" class="btn btn-primary btn-block" value="Submit"> Register  </button>
    </div>
    <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
</form>
</article>
<div class="border-top card-body text-center">Have an account? <a href="./login.php">Log In</a></div>
</div>
</div>

</div>


</div>


<br><br>
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
                <p>© Copyright 2020 Resume Registry System</p>
            </div>
       </div>
    </div>
</footer>

    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
