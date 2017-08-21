<?php
/*
 * Counting the Total Number of Replies
 */
function replyCount($tpc_id){
  $db = new Database;
  $db->query('SELECT * FROM replies WHERE tpc_id = :tpc_id');
  $db->bind(':tpc_id', $tpc_id);
  //Assign Rows
  $rows = $db->resultset();
  //Get Count
  return $db->rowCount();
}

/*
 * Get categories
 */
function getCategories(){
  $db = new Database;
  $db->query('SELECT * FROM categories');

  //Assign Result Set
  $results = $db->resultset();

  return $results;
}

/*
 * User Posts from Topics added with Replies
 */
function userPostCount($user_id){
	$db = new Database;
	$db->query('SELECT * FROM topics
				WHERE usr_id = :user_id
				');
	$db->bind(':user_id', $user_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count and on to the next count!
	$topic_count = $db->rowCount();

	$db->query('SELECT * FROM replies
				WHERE usr_id = :user_id
				');
	$db->bind(':user_id', $user_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	$reply_count = $db->rowCount();
	return $topic_count + $reply_count;
}
