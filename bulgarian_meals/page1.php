<?
require_once 'config.php';
include 'header.php';

// Get user profile data
$facebook = fbLogin ();
if ($facebook) {
	// Do something
}
echo db_query('SELECT * from recipes', array(''));
?>
<div><?=$_REQUEST["content"];?></div>
<a href='index.php'>Go back to homepage</a>
<div class="row">
  <div class="col-md-12">
    <form role="form">
      <div class="form-group">
        <label for="recipeName">Recipe's Name</label>
        <input type="text" class="form-control" id="recipeName" placeholder="Enter your recipe's name">
      </div>
      <div class="form-group">
        <label for="fullRecipe">Your Recipe</label>
        <textarea class="form-control" rows="5" id="fullRecipe"></textarea>
      </div>
      <div class="form-group">
        <label for="uploadImg">Upload Image</label>
        <input type="file" id="uploadImg">
        <p class="help-block">Image should be at least 810X500px</p>
      </div>
      <div class="checkbox">
        <label>
          <input type="checkbox"> I agree with the terms and conditions
        </label>
      </div>
      <button type="submit" class="btn btn-default" value="post">Upload Your Recipe</button>
    </form>
  </div>
</div>

<? include 'footer.php'; ?>