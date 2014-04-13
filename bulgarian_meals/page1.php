<?
require_once 'config.php';

// Get user profile data
$facebook = fbLogin ();
if ($facebook) {
	// Do something
}
?>
<div><?=$_REQUEST["content"];?></div>
<a href='index.php'>Go back to homepage</a>