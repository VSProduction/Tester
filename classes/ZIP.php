<?php

class ZIP {
	
	
	public function getText($path) {
		
		$desc = zip_open($path); 
		
		
			while($array = zip_read($desc)) {
			
		if(zip_entry_name($array)!="word/document.xml") continue; 
		
		if(zip_entry_open($desc, $array)) {
			
$zipA = zip_entry_read($array, zip_entry_filesize($array));
return $zipA; 
			
		}
		
		
				
				
				 
			
			
		}
		
		
		
	}
	
	
	
	
}


?>