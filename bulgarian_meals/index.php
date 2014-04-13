<?
require_once 'config.php';

// Get user profile data
$facebook = fbLogin();
if ($facebook) {
	$user_profile = $user_profile = $facebook->api ( '/me' );
}
?>
<h1>Welcome to Bulgarian meals</h1>
<br />
<p>Hello <?=ucfirst($user_profile['first_name']); ?>,
<br />Here you may enter your favourite Bulgarian meal and the others
	would be able to vote for it.
</p>
<p>
<ul>
	<li><a href='page1.php'>Test page 1</a></li>
	<li><a
		href='page2.php?first_name=<?=ucfirst($user_profile['first_name']); ?>&last_name=<?=ucfirst($user_profile['last_name']); ?>&age=<?=ucfirst($user_profile['age']); ?>'>Page
			2</a></li>
</ul>
</p>