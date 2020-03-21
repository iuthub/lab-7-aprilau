<?php 

class UsersRepo {
	private $db;

	private $getUserStmt;
	private $addUserStmt;

	public function __construct($db) {
		$this->db = $db;
		$this->getUserStmt = $db->prepare("SELECT * FROM users WHERE username=?");
		$this->addUserStmt = $db->prepare("INSERT users(username, fullname, email, pwd) VALUES(?,?,?,?)");
	}

	public function getUser($username) {
		$this->getUserStmt->execute(array($username));
		if($this->getUserStmt->rowCount()>0) {
			return $this->getUserStmt->fetch();
		}
		return NULL;
	}

	public function checkUser($username, $pwd) {
		$user=$this->getUser($username);
		return $user && $user['pwd']==$pwd;
	}

	public function addUser($username, $fullname, $email, $pwd) {
		if (!$this->getUser($username)) {
			$this->addUserStmt->execute(array(
				$username,
				$fullname,
				$email,	
				$pwd			
			));
			return true;
		}
		return false;
	}
}


?>