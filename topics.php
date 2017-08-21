<!--Dosen't have to put session or require everytime we do every page-->
<?php require('core/init.php');?>
<!--Use Template Class. Get Template and Assign Variables-->
<?php
//Create Topic Object
$topic = new Topic;

//If the category appears in the URL, then assign the number to this $category variable from the GET
$category = isset($_GET['category']) ? $_GET['category'] : null;

//Get user from URL
$user_id = isset($_GET['user']) ? $_GET['user'] : null;

//Get Template and Assing Vars
$template = new Template('templates/topics.php');

//Assign Template Variables if Category is set in URL Can be overwrite if we assign again. TAKE NOTICE
if (isset($category)) {
  $template->topics = $topic->getByCategory($category);
  $template->title = 'Posts In "'.$topic->getCategory($category)->ca_name.'"';
}


//Check for User Filter aka If user found in URL
if (isset($user_id)) {
  $template->topics = $topic->getByUser($user_id);
  //$template->title = 'Posts By "'.$topic->getCategory($user_id)->usr_id.'"';
}

//If not set both stuff
if (!isset($category) && !isset($user_id)) {
  $template->topics = $topic->getAllTopics();
}

$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();

//Display Template as we can out put object using to string magic method
echo $template;
