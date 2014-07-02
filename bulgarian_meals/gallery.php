<?php
require_once ('config.php');
$facebook = fbLogin ();

// Fetch all recipes from the database
$mysql_query = "SELECT recipes.*, recipe_types.recipe_type FROM recipes, recipe_types WHERE recipes.recipe_name=recipe_types.recipe_name";
$row = db_query ( $mysql_query, array () );
// Put all recipes in an array according to their type
foreach ( $row as $recipe ) {
	$recipes [$recipe ["recipe_type"]] [] = $recipe;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>24Kitchen Summer Cook Off</title>
<link rel="stylesheet" type="text/css"
	href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- Navigation -->
	<nav class="navbar navbar-default" role="navigation">
		<divclass"container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html" title="Home">24KITCHEN</a>
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
			<a href="#" class="btn btn-default btn-lg challenge">This week's
				challenge</a> <a href="#"><img
				src="http://dummyimage.com/700x300/4d494d/686a82.gif&text=placeholder+image"
				alt="placeholder+image"></a>
		</div>

		<!-- Main Content -->

		<h2>Recipes</h2>

		<div>
			<!-- Nav Tabs -->
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#starters" data-toggle="tab">Starters</a></li>
				<li><a href="#salads" data-toggle="tab">Salads</a></li>
				<li><a href="#main" data-toggle="tab">Main Courses</a></li>
				<li><a href="#dessert" data-toggle="tab">Desserts</a></li>
			</ul>
			<!-- Tab Content -->
			<div class="tab-content">
      <?
						// Go through each type and list the recipes in a corresponding heading
						foreach ( $recipes as $recipe_type => $recipe_list ) {
							?>
        <div class="tab-pane fade in active" id="<?=$recipe_type; ?>">
					<div class="row">
                  <?
							foreach ( $recipe_list as $recipe ) {
								?>
            <div class="col-sm-4">
							<div class="entry">
								<a href="recipe-post.php?id=<?=$recipe["recipe_id"]; ?>"><img
									class="img-rounded recipe-photo"
									src="<?=$recipe["image_url"]; ?>" alt="placeholder+image"></a>
								<p>
									<a href="recipe-post.php?id=<?=$recipe["recipe_id"]; ?>"><?=$recipe["recipe_name"]; ?></a><br>by
									<a href="https://facebook.com/<?=$recipe["fb_id"]; ?>"><?=$recipe["fb_user_name"]; ?></a>
								</p>
								<p>
									<a href='upload.php?action=edit&id="recipe_id"'>Edit</a>
									<a href='upload.php?action=delite&id="recipe_id"'>Delete</a>
								</p>
							</div>
						</div>
            <? } ?>


					</div>

				</div>
        <? } ?>
              </div>

		</div>

		<h2>Join the competition</h2>
		<p>
			<a class="btn btn-primary btn-lg" href="#" role="buton">Upload your
				recipe</a>
		</p>

		<!-- footer -->
		<footer>
			<p>
				&copy; 2014 24Kitchen All rights reserved. <a href="#">Terms and
					Conditions</a>
			</p>
		</footer>
	</div>

	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script
		src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>