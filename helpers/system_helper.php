<?php
/*
 * Redirect To Page with session varible message and its type, success for green and red error
 *if we don't include the page , it will lead back to the current page
*/
function redirect($page = FALSE, $message = NULL, $message_type = NULL) {
	if (is_string ($page)) {
		$location = $page;
	} else {
		$location = $_SERVER ['SCRIPT_NAME'];
	}

	//Check For Message which can be used on any page
	if($message != NULL){
		//Set Message
		$_SESSION['message'] = $message;
	}
	//Check For Type
	if($message_type != NULL){
		//Set Message Type
		$_SESSION['message_type'] = $message_type;
	}

	//Redirect
	header ('Location: '.$location);
	exit;
}

function displayMessage(){
	if(!empty($_SESSION['message'])) {

		//Assign Message Var
		$message = $_SESSION['message'];

		if(!empty($_SESSION['message_type'])) {
			//Assign Type Var
			$message_type = $_SESSION['message_type'];
			//Create Output
			if ($message_type == 'error') {
				echo '<div class="alert alert-danger">' . $message . '</div>';
			} else {
				echo '<div class="alert alert-success">' . $message . '</div>';
			}
		}
		//Unset Message
		unset($_SESSION['message'] );
		unset($_SESSION['message_type'] );
	} else {
		echo '';
	}
}

/*
 * Check If User Is Logged In
 */
function isLoggedIn(){
	if(isset($_SESSION['is_logged_in'])){
		return true;
	} else {
		return false;
	}
}

/*
 * Get Logged In User Info
*/
function getUser(){
	$userArray = array();
	$userArray['user_id'] = $_SESSION['user_id'];
	$userArray['username'] = $_SESSION['username'];
	$userArray['name'] = $_SESSION['name'];
	return $userArray;
}
