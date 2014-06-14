<?php
require_once ('config.php');
// Get user profile data
$facebook = fbLogin ();

// Process everything below if form is posted
if (array_key_exists ( 'upload', $_POST )) {
	if ($facebook) {
		$user_profile = $facebook->api ( '/me' );
	}
	// Make a user name by taking user's first and last names from their Facebook profile
	$user_name = $user_profile ["first_name"] . " " . $user_profile ["last_name"];
	$user_id = $user_profile ["id"];
	
	// Fetch the data from the form
	$recipeName = $_POST ["selectRecipe"];
	$ingredients = $_POST ["ingredients"];
	$fullRecipe = $_POST ["fullRecipe"];
	$uploadImg = $_FILES ["uploadImg"];
	($_POST ["t&cCheckbox"]) ? ($agreedToTerms = 1) : ($agreedToTerms = 0);
	
	// Check if all input has been filled in
	$errorMessages = array ();
	
	if (empty ( $recipeName )) {
		$errorMessages [] = "Please select the recipe you would like to upload.";
	}
	
	if (empty ( $ingredients )) {
		$errorMessages [] = "Please type in all ingredients needed to prepare the recipe with.";
	}
	
	if (empty ( $fullRecipe )) {
		$errorMessages [] = "Please type the full recipe.";
	}
	
	if (! $_FILES ["uploadImg"]) {
		$errorMessages [] = "An image is required to post your recipe.";
	}
	
	if ($agreedToTerms == 0) {
		$errorMessages [] = "Please read the terms and conditions and tick the relevant box before continuing.";
	}
	
	// Setup file upload
	if (array_key_exists ( 'uploadImg', $_FILES )) {
		// define constant for upload folder
		define ( 'UPLOAD_DIR', 'img_uploads/' );
		// replace any spaces in original filename with underscores
		// at the same time, assign to a simpler variable
		$file = str_replace ( ' ', '_', $_FILES ['uploadImg'] ['name'] );
		// create an array of permitted MIME types
		$permitted = array (
				'image/gif',
				'image/jpeg',
				'image/pjpeg',
				'image/png' 
		);
		// begin by assuming the file is unacceptable
		$typeOK = false;
		
		// check that file is of an permitted MIME type
		foreach ( $permitted as $type ) {
			if ($type == $_FILES ['uploadImg'] ['type']) {
				$typeOK = true;
				break;
			}
		}
		
		if ($typeOK) {
			switch ($_FILES ['uploadImg'] ['error']) {
				case 0 :
					// $username would normally come from a session variable
					$username = $user_id;
					// if the user's subfolder doesn't exist yet, create it
					if (! is_dir ( UPLOAD_DIR . $username )) {
						mkdir ( UPLOAD_DIR . $username );
					}
					// check if a file of the same name has been uploaded
					if (! file_exists ( UPLOAD_DIR . $username . '/' . $file )) {
						// move the file to the upload folder and rename it
						$success = move_uploaded_file ( $_FILES ['uploadImg'] ['tmp_name'], UPLOAD_DIR . $username . '/' . $file );
						$image_location = UPLOAD_DIR . $username . '/' . $file;
					} else {
						// get the date and time
						ini_set ( 'date.timezone', 'Europe/London' );
						$now = date ( 'Y-m-d-His' );
						$success = move_uploaded_file ( $_FILES ['uploadImg'] ['tmp_name'], UPLOAD_DIR . $username . '/' . $now . $file );
						$image_location = UPLOAD_DIR . $username . '/' . $now . $file;
					}
					if (! $success) {
						$errorMessages [] = "Error uploading $file. Please try again.";
					}
					break;
				case 3 :
					$errorMessages [] = "Error uploading $file. Please try again.";
				default :
					$errorMessages [] = "System error uploading $file. Contact webmaster.";
			}
		} elseif ($_FILES ['uploadImg'] ['error'] == 4) {
			$errorMessages [] = 'No file selected';
		} else {
			$errorMessages [] = "$file cannot be uploaded. Acceptable file types: gif, jpg, png.";
		}
	}
	
	// Post the recipe to the database
	if (count ( $errorMessages ) < 2) {
		// Insert the data to the db
		$mysql_query = "INSERT INTO recipes (recipe_name, recipe_date, recipe_ingredients, recipe_text, fb_id, fb_user_name, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$mysql_query_params = array (
				$recipeName,
				time (),
				$ingredients,
				$fullRecipe,
				$user_id,
				$user_name,
				$image_location 
		);
		$success = db_query ( $mysql_query, $mysql_query_params );
	}
	// If $success is true, try to redirect to the correct recipe page
	if ($success) {
		header ( "Location: recipe-post.php?id=" . $success ["last_insert_id"] );
	}
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
		<div class="container">
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
			<a href="#" class="btn btn-default btn-lg challenge">This week's
				challenge</a> <a href="#"><img
				src="http://dummyimage.com/700x300/4d494d/686a82.gif&text=placeholder+image"
				alt="placeholder+image"></a>
		</div>

		<!-- Main Content -->

		<h2>Upload your recipe</h2>
		<div class="upload-form">
    <?php if (count($errorMessages)>0) { ?>
    <div class="error">
				<ul>
    <?php foreach ($errorMessages AS $error) { ?>
    <li><?php echo $error; ?></li>
    <?php } ?>
    </ul>
    <?php } ?>
    </div>
			<form role="form" id="form" name="form" method="post" action=""
				enctype="multipart/form-data">
								<?
								// Get all recipes
								$mysql_query = "SELECT * FROM recipe_types";
								$rows = db_query ( $mysql_query, array () );
								?>
				<label for="selectRecipe">Which recipe you are preparing?</label> <select
					class="form-control" id="selectRecipe" name="selectRecipe">
					<?
					foreach ( $rows as $row ) {
						?>
					<option <?=($recipeName==$row["recipe_name"])?("selected"):(""); ?>><?=$row["recipe_name"]; ?></option>
					<? } ?>
									</select>
				<div class="form-group">
					<label for="ingredients">Ingredients</label>
					<textarea class="form-control" rows="8" id="ingredients"
						name="ingredients"><?=($ingredients)?($ingredients):(""); ?></textarea>
				</div>
				<div class="form-group">
					<label for="fullRecipe">Your Recipe</label>
					<textarea class="form-control" rows="8" id="fullRecipe"
						name="fullRecipe"><?=($fullRecipe)?($fullRecipe):(""); ?></textarea>
				</div>
				<div class="form-group">
					<label for="uploadImg">Upload your image</label> <input type="file"
						id="uploadImg" name="uploadImg">
					<p class="help-block">The image you upload must be 800X600 pixels
						at least.</p>
				</div>
				<div class="checkbox">
					<label> <input type="checkbox" id="t&cCheckbox" name="t&cCheckbox"
						<?=($agreedToTerms=="1")?("checked"):(""); ?>> I agree with the <a
						href="#">Terms and Conditions</a>.
					</label>
				</div>
				<button type="submit" class="btn btn-default btn-lg" id="upload"
					name="upload">Upload</button>
			</form>
		</div>

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