<?php






class DataBase {

	public $connect_d; 
	public $select_db; 
	public $query; 
	public $result = array(); 
	


	public function p_connect($b) {
		 
		include('config.php');
		$this->connect_d = mysql_pconnect($db_host, $db_user, $db_password) or DIE('Sorry, but temporary our service is not working, please wait a little time & try again');
		mysql_select_db($b, $this->connect_d); 
		
		
		
		
	}
	
	public function setNames() {
		if(!mysql_query("SET NAMES utf8")) throw new Exception('Database didn`t know this code'); 
		
	}
	
	
	public function connect($b) {
	
include('config.php');

				
	
			$this->connect_d = 	mysql_connect($db_host, $db_user, $db_password) or DIE('Sorry, but temporary our service is not working, please wait a little time & try again');

			
			if(mysql_select_db($b, $this->connect_d)) {
				
				return true;
			} 
			else {
				
				return false; 
			}


		} //connect to database and return false, if the db isn`t exist 

	public function DB_drop($db) {
		$sql = 'DROP DATABASE '.$db; 
		mysql_query($sql) or DIE('no DROP'); 
		
		
		
	}  //DROP the database

	
	public function DB_create($db_c) {
		
 $sql = "CREATE DATABASE ".$db_c." CHARACTER SET utf8 COLLATE utf8_general_ci"; 
 
 mysql_query($sql) or DIE('Seems, that the db is already exist or the server can`t create the db'); 
		
	} // CREATE the database


	public function DB_table_create($table_name, $rows, $chars) {
		
	$sql= "CREATE TABLE `".$table_name."` ("; 

		if(is_array($rows)&&is_array($chars)) {
			$key = $rows[0]; 
		
		for($j=0;$j<count($rows);$j++) {
			
				$sql.= " `".$rows[$j]."` ".$chars[$j].", "; 
			
			
		

		}
			
			
		}
		
			else {
				
				$sql.="  `".$rows."` ".$chars.", "; 
				$key = $rows; 
				
			}
		
		
			$sql.=" PRIMARY KEY(`".$key. "`) ) "." CHARACTER SET utf8 COLLATE utf8_general_ci"; 

			mysql_query($sql) or DIE('NO'); 
	}

	public function DB_DATA_INSERT($table_name, $rows, $values) {//the row values write with ``
		
			
			$string = (is_array($rows)) ? implode(", ", $rows): $rows; //check if is an array; 

		$sql = "INSERT INTO ".$table_name." ".$this->make_array($rows, "`")."  VALUES  ".$this->make_array($values, "'"); 
		
	mysql_query($sql) or DIE("This value already exist"); 
		
		
		
		
		
		
		
	}
	
	
	
	
	
	private function make_array($array, $symbol) {
		
			for($a=0; $a<count($array); $a++) {
				
				$array[$a] = $symbol.$array[$a].$symbol; 
				
			}
			
			$array = implode(", ", $array); 
			$array="(".$array.")"; 
			
		return $array; 
		
	}
	
	




public function exist($table) {
	
	
$query = "SELECT * FROM ".$table; 

if(mysql_query($query)) {
	
	
return true; 
	
} else {
	
	return false; 
	
}

	
	
	
}
	
	
	public function getQuery($query) {
		
		
			$daemon = mysql_query($query); 
	if(!$daemon) {
		throw new Exception("По крайней мере в  базе данных ничего не найдено!");
	}
	
	$ar = array(); 
	
while($array =  mysql_fetch_assoc($daemon)) {
	
	array_push($ar, $array); 
	
}

return $ar; 
	}
	
	
	
	public function Select($query, $param) {
		if(!is_array($param)) die('False format!'); 
		mysql_query("PREPARE stmt1 FROM '".$query."'") or die('Wrong request'); 
		$query = "SET "; 
	 
		$execute='';
		for($i=0;$i<count($param); $i++) {
			count($param)>1 ? $execute.="@o".$i.COMA : $execute.="@o".$i; 
			count($param)>1 ? $query.= "@o".$i."='".$param[$i]."'".COMA: $query.= "@o".$i."='".$param[$i]."'"; 
		}
		
		mysql_query($query) or die('Unknown params given into function!'); 
	
		$d =   mysql_query("EXECUTE stmt1 USING ".$execute) or die('No execution!'); 
		return $d; 
	}
	
	

}





?>