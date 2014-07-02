<?php
require_once('config.php');
$facebook = fbLogin();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>24Kitchen Summer Cook Off</title>
  <link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-default" role="navigation">
    <div class"container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php" title="Home">24KITCHEN</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="gallery.php" title="All Recipes">Recipes</a></li>
        <li><a href="chefs.php" title="Chefs">Chefs</a></li>
        <li><a href="upload.php" title="Upload a recipe">Upload</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <h1>Summer Cook Off</h1>
    <!-- Header -->
    <div class="header">
      <a href="#" class="btn btn-default btn-lg challenge">This week's challenge</a>
      <a href="#"><img src="http://dummyimage.com/700x300/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image"></a>
    </div>

    <!-- Main Content -->

    <div>
      <p class="lead">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
      <p>YT video embed</p>
    </div>
    <div class="row">
      <h2>Chefs</h2>
      <div class="col-sm-2 col-sm-offset-1">
        <a href="#" id="chefPhoto" data-toggle="tooltip" data-placement="bottom" title="Some tooltip text!"><img class="img-circle" src="http://dummyimage.com/100x100/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image"></a>
      </div>
      <div class="col-sm-2">
        <a href="#" id="chefPhoto1" data-toggle="tooltip" data-placement="bottom" title="Some tooltip text!"><img class="img-circle" src="http://dummyimage.com/100x100/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image"></a>
      </div>
      <div class="col-sm-2">
        <a href="#" id="chefPhoto2" data-toggle="tooltip" data-placement="bottom" title="Some tooltip text!"><img class="img-circle" src="http://dummyimage.com/100x100/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image"></a>
      </div>
      <div class="col-sm-2">
        <a href="#" id="chefPhoto3" data-toggle="tooltip" data-placement="bottom" title="Some tooltip text!"><img class="img-circle" src="http://dummyimage.com/100x100/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image"></a>
      </div>
      <div class="col-sm-2">
        <a href="#" id="chefPhoto4" data-toggle="tooltip" data-placement="bottom" title="Some tooltip text!"><img class="img-circle" src="http://dummyimage.com/100x100/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image"></a>
      </div>
    </div>
    <div class="cta">
      <a class="btn btn-primary btn-lg" href="upload.php" role="buton">Upload Your Recipe</a>
      or
      <a class="btn btn-primary btn-lg" href="gallery.php" role="buton">View All Recipes</a>
    </div>
    <!-- Footer -->
    <footer>
      <p>&copy; 2014 24Kitchen All rights reserved. <a href="#">Terms and Conditions</a></p>
    </footer>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $("#chefPhoto").tooltip();
    $("#chefPhoto1").tooltip();
    $("#chefPhoto2").tooltip();
    $("#chefPhoto3").tooltip();
    $("#chefPhoto4").tooltip();
  </script>

</body>
</html>