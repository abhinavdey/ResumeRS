<?php
session_start();

require_once "pdo.php";
require_once "util.php";

if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email'])
    && isset($_POST['headline']) && isset($_POST['summary'])) {
    if (strlen($_POST['first_name']) < 1 || strlen($_POST['last_name']) < 1 || strlen($_POST['email']) < 1 ||
        strlen($_POST['headline']) < 1 || strlen($_POST['summary']) < 1) {
        $_SESSION['error'] = 'All values are required';
        header("Location: add.php");
        return;
    } elseif (strpos($_POST['email'], '@') === false) {
        $_SESSION['error'] = 'Bad Email';
    } elseif (!validatePos()) {
        $_SESSION['error'] = validatePos();
    } else {
        $stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary) VALUES ( :uid, :fn, :ln, :em, :he, :su)');

        $stmt->execute(array(
                ':uid' => $_SESSION['user_id'],
                ':fn' => $_POST['first_name'],
                ':ln' => $_POST['last_name'],
                ':em' => $_POST['email'],
                ':he' => $_POST['headline'],
                ':su' => $_POST['summary'])
        );

        $profile_id = $pdo->lastInsertId();

        $rank = 1;
        for ($i = 1; $i <= 9; $i++) {
            if (!isset($_POST['year' . $i])) continue;
            if (!isset($_POST['desc' . $i])) continue;

            $year = $_POST['year' . $i];
            $desc = $_POST['desc' . $i];

            $stmt = $pdo->prepare('INSERT INTO Position
    (profile_id, rank, year, description)
    VALUES ( :pid, :rank, :year, :desc)');

            $stmt->execute(array(
                    ':pid' => $profile_id,
                    ':rank' => $rank,
                    ':year' => $year,
                    ':desc' => $desc)
            );

            $rank++;

        }

        $rank = 1;
        for ($i = 1; $i <= 9; $i++) {
            if (!isset($_POST['edu_year' . $i])) continue;
            if (!isset($_POST['edu_school' . $i])) continue;

            $edu_year = $_POST['edu_year' . $i];
            $edu_school = $_POST['edu_school' . $i];

            $stmt = $pdo->prepare("SELECT * FROM Institution where name = :xyz");
            $stmt->execute(array(":xyz" => $edu_school));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $institution_id = $row['institution_id'];
            } else {
                $stmt = $pdo->prepare('INSERT INTO Institution (name) VALUES ( :name)');

                $stmt->execute(array(
                    ':name' => $edu_school,
                ));
                $institution_id = $pdo->lastInsertId();
            }

            $stmt = $pdo->prepare('INSERT INTO Education
    (profile_id, institution_id, year, rank)
    VALUES ( :pid, :institution, :edu_year, :rank)');


            $stmt->execute(array(
                    ':pid' => $profile_id,
                    ':institution' => $institution_id,
                    ':edu_year' => $edu_year,
                    ':rank' => $rank)
            );

            $rank++;

        }

        $_SESSION['success'] = "Record added.";
        header("Location: index.php");
        return;
    }
} ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap-social/bootstrap-social.css">

  <title>Add Details</title>

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
                <li class="nav-item"><a class="nav-link" href="./resume.php"><span class="fa fa-list fa-lg"></span> Resume</a></li>

                <li class="nav-item active"><a class="nav-link" href="./contactus.php"><span class="fa fa-address-card fa-lg"></span> Contact</a></li>
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

    <div class="container">
        <div class="row">
          <ol class="col-12 breadcrumb">
            <li class="breadcrumb-item"><a href="./index.html">Home</a></li>
            <li class="breadcrumb-item active">Add Details</li>
          </ol>
          <div class="col-12">
             <h3>Add Details</h3>
             <hr>
          </div>
        </div>
    </div>
    <div class="container">
        <h1>Adding Profile for faculties</h1>
        <?php
        flashMessage();
        ?>
        <form method="post">
            <p>First Name:
                <input type="text" name="first_name" size="60"/></p>
            <p>Last Name:
                <input type="text" name="last_name" size="60"/></p>
            <p>Email:
                <input type="text" name="email" size="30"/></p>
            <p>Headline:<br/>
                <input type="text" name="headline" size="80"/></p>
            <p>Summary:<br/>
                <textarea name="summary" rows="8" cols="80"></textarea>
            <p>
                Education: <input type="submit" id="addEdu" value="+">
            <div id="edu_fields">
            </div>
            </p>
            <p>
                Position: <input type="submit" id="addPos" value="+">
            <div id="position_fields">
            </div>
            </p>
            <p>
                <input type="submit" value="Add">
                <input type="submit" name="cancel" value="Cancel">
            </p>
        </form>
        <script>
            countPos = 0;
            countEdu = 0;

            // http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
            $(document).ready(function () {
                window.console && console.log('Document ready called');

                $('#addPos').click(function (event) {
                    // http://api.jquery.com/event.preventdefault/
                    event.preventDefault();
                    if (countPos >= 9) {
                        alert("Maximum of nine position entries exceeded");
                        return;
                    }
                    countPos++;
                    window.console && console.log("Adding position " + countPos);
                    $('#position_fields').append(
                        '<div id="position' + countPos + '"> \
                <p>Year: <input type="text" name="year' + countPos + '" value="" /> \
                <input type="button" value="-" onclick="$(\'#position' + countPos + '\').remove();return false;"><br>\
                <textarea name="desc' + countPos + '" rows="8" cols="80"></textarea>\
                </div>');
                });

                $('#addEdu').click(function (event) {
                    event.preventDefault();
                    if (countEdu >= 9) {
                        alert("Maximum of nine education entries exceeded");
                        return;
                    }
                    countEdu++;
                    window.console && console.log("Adding education " + countEdu);

                    $('#edu_fields').append(
                        '<div id="edu' + countEdu + '"> \
                <p>Year: <input type="text" name="edu_year' + countEdu + '" value="" /> \
                <input type="button" value="-" onclick="$(\'#edu' + countEdu + '\').remove();return false;"><br>\
                <p>School: <input type="text" size="80" name="edu_school' + countEdu + '" class="school" value="" />\
                </p></div>'
                    );

                    $('.school').autocomplete({
                        source: "school.php"
                    });

                });

            });

        </script>
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


        <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    </body>

    </html>
