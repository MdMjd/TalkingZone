<!--Dosen't have to put session or require everytime we do every page-->
<?php require('core/init.php');?>

<?php

//Create Topic Object and will fix that No.25 issue
$topic = new Topic;

//Instantiate user Object.TAKE NOTICE
$user = new User;

//Create Validator Object
$validate = new Validator;

//CHeck to see if form is submitted - if yes, then put the post data into the array we created
if (isset($_POST['register'])) {
  //Create Data Array
  $data = array();
  $data['name'] = $_POST['name'];
  $data['email'] = $_POST['email'];
  $data['username'] = $_POST['username'];
  $data['password'] = md5($_POST['password']);
  $data['password2'] = md5($_POST['password2']);
  $data['about'] = $_POST['about'];
  //Setting to current date and time
  $data['last_activity'] = date("Y-m-d H:i:s");

  //Required Fields
  $field_array = array('name','email','username','password','password2');

  if($validate->isRequired($field_array)){
		if($validate->isValidEmail($data['email'])){
			if($validate->passwordsMatch($data['password'],$data['password2'])){


  //Upload Avatar Image - If uploadAvatar method is true, do the following, if not, it will be set to
  //no image.
  if($user->uploadAvatar()){
    $data['avatar'] = $_FILES["avatar"]["name"];
  }else{
    $data['avatar'] = 'noimage.png';
  }

  //Register User - if registration is true then ..
  if($user->register($data)){
    redirect('index.php', 'You are registered and can now log in', 'success');
  } else {
    redirect('index.php', 'Something went wrong with registration', 'error');
  }
  //Directs if any of the errors occur
  } else {
    redirect('register.php', 'Your passwords did not match', 'error');
  }
  } else {
    redirect('register.php', 'Please use a valid email address', 'error');
  }
  } else {
    redirect('register.php', 'Please fill in all required fields', 'error');
  }
}

//Get template & Assign Variables
$template = new Template('templates/register.php');

//Assign Vars to output

//Display Template as we can out put object using to string magic method
echo $template;
