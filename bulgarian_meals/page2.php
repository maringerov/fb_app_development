<!-- Tiny MCE -->
<script type="text/javascript" src="res/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	plugins : "paste",

	// Theme options
	theme_advanced_buttons1 : "undo,redo,paste,|,bullist,numlist",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
		theme_advanced_resizing : true,

	// Example content CSS (should be your site CSS)
	content_css : "css/example.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "js/template_list.js",
	external_link_list_url : "js/link_list.js",
	external_image_list_url : "js/image_list.js",
	media_external_list_url : "js/media_list.js",

	// Replace values for the template plugin
	template_replace_values : {
		username : "Some User",
		staffid : "991234"
	}
});
</script>
<form method="post" action="page1.php">
<fieldset>
<textarea rows="20" cols="20" name="content"></textarea></fieldset>
<input type="submit" name="send" value="send">
</form>
<br/>
<a href='index.php'>Go back to home page</a>