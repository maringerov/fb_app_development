<?php
require_once ('config.php');
$facebook = fbLogin();

// Get the data from the database
$recipe_id = $_REQUEST["id"];
$mysql_query = "SELECT * FROM recipes WHERE recipe_id=?";
$mysql_query_params = array($recipe_id);
$row = db_query ( $mysql_query, $mysql_query_params );
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
    <!-- Uploaded Image Goes Here -->
    <div>
    <img src="<?=$row[0]["image_url"]; ?>">
      <img src="http://dummyimage.com/700x600/4d494d/686a82.gif&text=placeholder+image" alt="placeholder+image">
    </div>
  
    <!-- Rest of recipe content goes here -->
  
    <h2><?=$row[0]["recipe_name"]; ?></h2>
    <p>by <a href="https://facebook.com/<?=$row[0]["fb_id"]; ?>"><?=$row[0]["fb_user_name"]; ?></a></p>

    <div class="row recipe-content">
      <div class="col-sm-6">
        <h4>Ingredients</h4>
        <p><?=$row[0]["recipe_ingredients"]; ?></p>
      </div>
      <div class="col-sm-6">
        <h4>Preparation</h4>
        <p><?=$row[0]["recipe_text"]; ?></p>
      </div>
    </div>
    <hr>
    <div>
      <a class="btn btn-primary btn-lg" href="upload.php" role="button">Upload your own recipe</a>
      or
      <a class="btn btn-primary btn-lg" href="gallery.php" role="button">Go back to all recipes</a>
    </div>
  
    
  
    <!-- footer -->
    <footer>
      <p>&copy; 2014 24Kitchen All rights reserved. <a href="#">Terms and Conditions</a></p>
    </footer>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>