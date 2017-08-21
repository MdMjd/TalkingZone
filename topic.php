<!--Dosen't have to put session or require everytime we do every page-->
<?php require('core/init.php');?>
<!--Use Template Class. Get Template and Assign Variables-->
<?php

//New Topic Object
$topic = new Topic;

//Get ID From URL
$topic_id = $_GET['id'];

//Process Reply
if(isset($_POST['do_reply'])){
	//Create Data Array
	$data = array();
	$data['topic_id'] = $_GET['id'];
	$data['body'] = $_POST['body'];
	$data['user_id'] = getUser()['user_id'];

	//Create Validator Object
	$validate = new Validator;

	//Required Fields
	$field_array = array('body');

	if($validate->isRequired($field_array)){
		//Register User
		if($topic->reply($data)){
			redirect('topic.php?id='.$topic_id, 'Your reply has been posted', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your reply', 'error');
		}
	} else {
		redirect('topic.php?id='.$topic_id, 'Your reply form is blank!', 'error');
	}
}


$template = new Template('templates/topic.php');

//Assign Vars to output and assign new ones with names under same topic class.
$template->topic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);
//tpc_title is the actualy title that corresponds to the getTopic id Name. Cool.
$template->title = $topic->getTopic($topic_id)->tpc_title;

//Display Template as we can out put object using to string magic method
echo $template;
