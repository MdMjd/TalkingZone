<?php
class User{
  //Init DB Variable
	private $db;

	/*
	 *	Constructor
	 */
	 public function __construct(){
		$this->db = new Database;
	 }

	/*
	 * Register User
	 */
	public function register($data){
			//Insert Query
			$this->db->query('INSERT INTO users (usr_name, usr_email, usr_avatar, usr_username, usr_password, usr_about, usr_last_activity)
											VALUES (:name, :email, :avatar, :username, :password, :about, :last_activity)');
			//Bind Values
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':avatar', $data['avatar']);
			$this->db->bind(':username', $data['username']);
			$this->db->bind(':password', $data['password']);
			$this->db->bind(':about', $data['about']);
			$this->db->bind(':last_activity', $data['last_activity']);
			//Execute
			if($this->db->execute()){
				return true;
			} else {
				return false;
			}
			//echo $this->db->lastInsertId();
	}

	/*
	 * Upload User Avatar
	 */
	public function uploadAvatar(){
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["avatar"]["name"]);
		$extension = end($temp);
		if ((($_FILES["avatar"]["type"] == "image/gif")
				|| ($_FILES["avatar"]["type"] == "image/jpeg")
				|| ($_FILES["avatar"]["type"] == "image/jpg")
				|| ($_FILES["avatar"]["type"] == "image/pjpeg")
				|| ($_FILES["avatar"]["type"] == "image/x-png")
				|| ($_FILES["avatar"]["type"] == "image/png"))
				&& ($_FILES["avatar"]["size"] < 100000)
				&& in_array($extension, $allowedExts)) {
			if ($_FILES["avatar"]["error"] > 0) {
				redirect('register.php', $_FILES["avatar"]["error"], 'error');
			} else {
				if (file_exists("images/avatars/" . $_FILES["avatar"]["name"])) {
					redirect('register.php', 'File already exists', 'error');
				} else {
					move_uploaded_file($_FILES["avatar"]["tmp_name"],
					"images/avatars/" . $_FILES["avatar"]["name"]);

					return true;
				}
			}
		} else {
			redirect('register.php', 'Invalid File Type!', 'error');
		}
	}

	/*
	 * User Login
	 */
	public function login($username, $password){
		$this->db->query("SELECT * FROM users
									WHERE usr_username = :username
									AND usr_password = :password
		");

		//Bind Values
		$this->db->bind(':username', $username);
		$this->db->bind(':password', $password);

		$row = $this->db->single();

		//Check Rows
		if($this->db->rowCount() > 0){
			$this->setUserData($row);
			return true;
		} else {
			return false;
		}
	}

	/*
	 * Set User Data when session is active
	 */
	private function setUserData($row){
		$_SESSION['is_logged_in'] = true;
		$_SESSION['user_id'] = $row->usr_id;
		$_SESSION['username'] = $row->usr_username;
		$_SESSION['name'] = $row->usr_name;
	}

	/*
	 * User Logout by unsetting session variables
	*/
	public function logout(){
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['name']);
		return true;
	}

	/*
	 * Get Total # Of Users
	 */
	public function getTotalUsers(){
		$this->db->query('SELECT * FROM users');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
}
