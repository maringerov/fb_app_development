<?php
require 'res/fb_api/src/facebook.php';

function login ()
{
	$app_id = "1485634284983815";
	$app_secret = "e7c1c001c41bc9793d539ea0aa9a9bea";
	$canvas_page = "https://apps.facebook.com/1485634284983815";
	$scope = 'publish_actions';
	$facebook = new Facebook(
			array(
					'appId' => $app_id,
					'secret' => $app_secret,
					'allowSignedRequest' => true
			));
	
	if (isset($_GET['code'])) {
		print('<script> top.location.href=\'' . $canvas_page . '\'</script>');
		exit();
	}
	
	$user = $facebook->getUser();
	
	if ($user) {
		
		try {
			
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
			$access_token = $facebook->getAccessToken();
			$fbid = $user_profile['id'];
		} catch (FacebookApiException $e) {
			
			error_log($e);
			$user = null;
		}
	} else {
		
		$loginUrl = $facebook->getLoginUrl(array(
				'scope' => $scope
		));
		print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
	}
	return $facebook;
}

$facebook = login();
// Get user profile
$user_profile = $facebook->api('/me');
?>
<h1>Welcome to Bulgarian meals</h1>
<br />
<p>Hello <?=ucfirst($user_profile['first_name']); ?>,
<br />Here you may enter your favourite Bulgarian meal and the others
	would be able to vote for it.
</p>