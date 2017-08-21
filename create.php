<!--Dosen't have to put session or require everytime we do every page-->
<?php require('core/init.php');?>
<!--Use Template Class. Get Template and Assign Variables-->
<?php
//Create Topic Object
$topic = new Topic;

if(isset($_POST['do_create'])){

	//Create Validator Object
	$validate = new Validator;

	//Create Data Array
	$data = array();
	$data['title'] = $_POST['title'];
	$data['body'] = $_POST['body'];
	$data['category_id'] = $_POST['category'];
  //Get User ID etc.. FOR Activity
	$data['user_id'] = getUser()['user_id'];
	$data['last_activity'] = date("Y-m-d H:i:s");

	//Required Fields
	$field_array = array('title', 'body', 'category');

	if($validate->isRequired($field_array)){
		//Register User if passes
		if($topic->create($data)){
			redirect('index.php', 'Your topic has been posted', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
		}
	} else {
		redirect('create.php', 'Please fill in all required fields', 'error');
	}
}


$template = new Template('templates/create.php');

//Assign Vars to output
$template->heading = 'This is the template heading';

//Display Template as we can out put object using to string magic method
echo $template;
