<?php
class Registration_check {
	
	private $mail; 
	
	public function __construct() {
		$this->db = new DataBase(); 
		$this->connect = $this->db->connect('tests'); 
		$this->mail= mysql_escape_string($_GET['mail']); 
		$this->user = mysql_escape_string($_GET['user']); 
	}
	
	public function check() {
	
	
					$buffer =   $this->db->Select("SELECT hash FROM users WHERE nick=?", array($this->user)); 
					$buffer=mysql_fetch_array($buffer); 
					if($buffer[0]==$this->mail) {
						
						mysql_query("UPDATE users SET `check`=1 WHERE nick='".$this->user."'") or die('На данный момент невозможно верифицировать Ваш аккаунт!'); 
						return array('response'=>"<p id='no_valid'> Account is successfull verificated. <br> <a href='/main'> Go to main page! </a> </p> "); 				
					} 
		
		
		
	}
	
	
	
}
?>