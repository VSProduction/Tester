<?php
class Model_auth extends Model {
	
	public $auth;
	private $password;
	private $login;
	public function __construct() {
		
			$this->auth = new auth;
	}
	public function getData() {
		
		$this->password = $_POST['password'];
		$this->login = $_POST['nick']; 
	
		
		return $this->auth->check_password($this->login, $this->password); 
		
		
	}
	
	
	
}

?>