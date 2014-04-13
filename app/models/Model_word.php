<?php
class Model_word extends DB_work {
	public $data = array(); 
	
	
	public function setData() {
		session_start(); 
		$this->word = new word;
		$this->zip = new ZIP; 
		$file = $this->zip->getText($_FILES['file']['tmp_name']); 
		$this->attr = $this->word->getATTR($file); 
		$this->elems = $this->word->getElems($file);
		$this->question = $this->word->GetQuestion($this->attr, $this->elems);
		$this->variants = $this->word->GetVariants($this->attr, $this->elems); 
		
		///// to build incomig array
		$request = array(); 
		$query = array(); 
		for($i=0; $i<count($this->question); $i++) {
			$request[$i] = array('number', 'question', 'correct', 'count_var');
			$query[$i] = array($i+1, $this->question[$i], $this->word->corrects[$i], $this->word->count_var[$i]); 
				for($j=0; $j<$this->word->count_var[$i]; $j++) {
					array_push($query[$i], $this->variants[$i][$j]); 
					array_push($request[$i], $this->word->names[$j]);
					 
				}
			$this->db->DB_DATA_INSERT('pr_'.$_SESSION['nick'].'_'.$_SESSION['vc_name'], $request[$i], $query[$i]); 
			
			
		}
		
		
		

		
	}
	
	
}



?>