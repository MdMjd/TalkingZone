<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome To Talking Zone</title>

    <!-- Bootstrap core CSS -->
     <link href="<?php echo BASE_URI; ?>templates/css/bootstrap.css" rel="stylesheet">
     <!-- Custom styles for this template -->
     <link href="<?php echo BASE_URI; ?>templates/css/custom.css" rel="stylesheet">
     <!--JS for Bootstrap-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
     <script src="<?php echo BASE_URI; ?>templates/js/bootstrap.js"></script>
     <script src="<?php echo BASE_URI; ?>templates/js/ckeditor/ckeditor.js"></script>

     <?php
     //Check if the title is set, if not, assign it
     if (!isset($title)) {
       $title = SITE_TITLE;
     }
      ?>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">TalkingZone</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <!--Add links in the a href to switch in between pages-->
            <li class="active"><a href="index.php">Home</a></li>
            <?php if (!isLoggedIn()): ?>
              <li><a href="register.php">Create an Account</a></li>
            <?php else: ?>
              <li><a href="create.php">Create Topic</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    <!--Using Bootstrap Grid System-->
      <div class="row">
        <!--MainPage-->
        <div class="col-md-8">
          <div class="main-col">
            <!--Give white block with rounded edges-->
            <div class="block">
              <h1 class="pull-left"><?php echo $title; ?></h1>
              <h4 class="pull-right">A simple PHP forum engine</h4>
              <!--Since the 2 header are floated, we need to add a clear fix below-->
              <div class="clearfix"></div>
              <!--Horizontal rule to sperate rom the list below-->
              <hr>
              <?php displayMessage(); ?>
