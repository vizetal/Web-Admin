<?php require("session_check.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin | Samakhya</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">ADMIN | <small>samakhya</small></a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recent Item <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="home.php">New</a></li>
            <li><a href="managerecent.php">Manage</a></li>
            </ul>
        </li>
	   
	   
	   
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Image Gallery <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="uploadimage.php">Upload Image</a></li>
            <li><a href="gallery.php" target="_blank">Preview Gallery</a></li>
			<li><a href="../preview.html" target="_blank">Preview Gallery - Simplegallery</a></li>
            </ul>
        </li>
     
      </ul>
	  <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"> <span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
    </div>
  </div>
</nav>
<div class="container"><?php
  