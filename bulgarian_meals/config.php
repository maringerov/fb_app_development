<?php

/**
* Main configuration file for this application
*
* This file holds the configuration information for the given application, such as Facebook app_id, app_secret, database details, etc
*/

/**
 * FACEBOOK APP CREDENTIALS
 *
 * @const APP_ID INT - The app ID value supplied by Facebook
 * @CONST APP_SECRET STRING - The app secret value supplied by Facebook
 * @CONST CANVAS_PAGE STRING - The homepage of the app on Facebook
 *
 * @param
 *        	default_scope ARRAY - An array of comma-separated values that defines the permissions that the application needs to function properly
 */
define ( 'APP_ID', '1485634284983815' );
define ( 'APP_SECRET', 'e7c1c001c41bc9793d539ea0aa9a9bea' );
define ( 'CANVAS_PAGE', 'https://apps.facebook.com/' . APP_ID );
$default_scope = array (
		"email, publish_stream" 
);
// Implode the scope and turn it into a comma-separated string of values
$scope = implode ( ", ", $default_scope );

/**
 * Main Facebook functions
 */
// First initialize a PHP session, enable the ability to save session data within the application iphrame and load the Facebook PHP API
SESSION_START ();
header ( 'p3p: CP="NOI ADM DEV PSAi COM NAV OUR OTR STP IND DEM"' );
require_once 'res/fb_api/src/facebook.php';

/**
 * Login function
 */
function fbLogin() {
	$debug = FALSE;
	// Initialize the Facebook API
	$facebook = new Facebook ( array (
			'appId' => APP_ID,
			'secret' => APP_SECRET,
			'allowSignedRequest' => true 
	) );
	
	/**
	 * if (isset ( $_GET ['code'] )) {
	 * print ('<script> top.location.href=\'' .
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 *
	 * $canvas_page . '\'</script>') ;
	 * exit ();
	 * }
	 */
	
	// Check if user is logged into Facebook and if it is, save the information into a PHP session
	$user = $facebook->getUser ();
	
	if ($user) {
		
		try {
			
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api ( '/me' );
			$access_token = $facebook->getAccessToken ();
			$fbid = $user_profile ['id'];
			// Display debug info
			if ($debug) {
				echo sprintf ( "User is logged in and has the following details: <br/>
		User Token: %s<br/>
		User profile: %s<br/>
		User ID: %d.<br/>", $access_token, print_R ( $user_profile ), $fbid );
			}
			
			// Save received access_token, code, signed request and user profile into session variables
			$_SESSION ["fb"] ["access_token"] = $access_token;
			$_SESSION ["fb"] ["code"] = $_GET ["code"];
			$_SESSION ["fb"] ["signed_request"] = $_REQUEST ["signed_request"];
			$_SESSION ["fb"] ["user_profile"] = $user_profile;
		}		

		// If this fails, catch the exception
		catch ( FacebookApiException $e ) {
			
			// User is not logged in, so catch the exception
			
			error_log ( $e );
			$user = null;
		}
	} else {
		
		// User is not logged into the app or has not authorized it properly, so first send them to the authorization dialog on Facebook and then redirect them to the main app page.
		
		$loginUrl = $facebook->getLoginUrl ( array (
				'scope' => $scope,
				'redirect_uri' => CANVAS_PAGE 
		) );
		
		// Redirect with JS
		
		print ('<script> top.location.href=\'' . $loginUrl . '\'</script>') ;
	}
	// Return the facebook variable
	return $facebook;
}

/**
 * Database Settings
 *
 * Define the settings used to connect to the MySQL database storing the app's data
 */
/**
 * $db_name = "bgmeals";
 * $db_host = "localhost";
 * $db_username = "root";
 * $db_password = "root";
 */
$db_name = 'bgmeals';
$db_host = 'bgmeals.sekwoia.org';
$db_username = 'bgmeals';
$db_password = 'bulgarianmeals';

/**
 * Function to connect to the database with PDO
 *
 * @PARAM $query STRING - The query that shall be passed to the MySQL
 */
function db_query($query, $params) {
	GLOBAL $db_name, $db_host, $db_username, $db_password;
	
	try {
		$conn = new PDO ( "mysql:host=$db_host;dbname=$db_name", $db_username, $db_password );
		
		// Prepare MySQL query
		$q = $conn->prepare ( $query );
		
		// Execute query
		$q->execute ( $params );
		$q->setFetchMode ( PDO::FETCH_ASSOC );
		
		while ( $r = $q->fetch () ) {
			$id = $conn->lastInsertId ();
			if ($id > 0) {
				$r ["last_insert_id"] = $conn->lastInsertId ();
			}
			$row[] = $r;
			// echo sprintf ( '%s <br/>', print_R ( $r ) );
		}
	
		$id = $conn->lastInsertId ();
		if ($id > 0) {
			$row ["last_insert_id"] = $conn->lastInsertId ();
		}
		return $row;
	} catch ( PDOException $pe ) {
		die ( "Could not connect to the database $db_name :" . $pe->getMessage () );
		return FALSE;
	}
}
