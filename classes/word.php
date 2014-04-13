<?php

class word extends DB_work {
	public $count_variants = array(); //attr
	public $elems = array();
	public $questions = array(); 
	public $variants = array(); 
	public $corrects = array(); 
	public $count_var = array(); 
	public $names= array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L'); 
public function getATTR($file) {
$doc = new DOMDocument(); 
$doc->loadXML($file); 
$at = array(); 
$attr = $doc->getElementsByTagName('ilvl'); //получаем аттрибуты по тегу
foreach($attr as $val) {
$value = $val->getAttributeNode('w:val')->value; 
array_push($this->count_variants, $value);
} 
return $this->count_variants; 
		
	}
	
public function getElems($string) {
$pos1 = strpos($string, "w:r")-1; 
$pos2 = strpos($string, "w:numPr")-1;
$text = substr($string, 0, $pos1); 
$text.='>
<w:pPr>
<w:pStyle w:val="a3"/>'.substr($string, $pos2, strlen($string)); 
$pos3 = strrpos($text, "<w:numPr>"); 
$subtext = substr($text, $pos3, strlen($text)); 
$pos4 = strpos($subtext, "</w:p>"); 
$pos5 = $pos3 + $pos4 + 6; 
$text = substr($text,0,$pos5).'<w:sectPr w:rsidR="005908CB" w:rsidRPr="007F40E2"> 
<w:pgSz w:w="11906" w:h="16838"/>
<w:pgMar w:top="850" w:right="850" w:bottom="850" w:left="1417" w:header="708" w:footer="708" w:gutter="0"/>
<w:cols w:space="708"/>
<w:docGrid w:linePitch="360"/>
</w:sectPr>
</w:body>
</w:document>'; 
$doc2 = new DOMDocument(); 
$doc2->loadXML($text);
$elems = $doc2->getElementsByTagName("p"); 

for($i=0; $i<$elems->length; $i++) {
	if($elems->item($i)->nodeValue=='') continue; //if the string is empty
	
	array_push($this->elems, $elems->item($i)->nodeValue); 
	
}

	return $this->elems; 
	
}	
	
	
public function GetQuestion($attr, $elems) {
	
	for($i=0;$i<count($attr); $i++) {
		if($attr[$i]==0) {
		
			array_push($this->questions, $elems[$i]); 
			
		}
	}
	
	return $this->questions; 
	
}	
	
	
public function GetVariants($attr, $elems) {
	$count=0; 
	for($i=0; $i<count($attr); $i++) {
		if($attr[$i]==0) {
			if(isset($count_var)) {
						array_push($this->count_var, $count_var); 
			}
	
			$count_var=0; 
			$this->variants[$count++]= array(); 
		} else {
			if(strpos($elems[$i], "@")==strlen($elems[$i])-1) {
				$elems[$i]= substr($elems[$i], 0, strlen($elems[$i])-1); 
				($this->corrects[$count-1]!='') ?  $this->corrects[$count-1].=','.$this->names[$count_var] :  $this->corrects[$count-1].=$this->names[$count_var]; //to set the correct into string with coma`s
			}
			array_push($this->variants[$count-1], $elems[$i]); 
			$count_var++; // to set next question
		}
		
		
	}
	array_push($this->count_var, $count_var); 
	$this->number = $count; 
	 return $this->variants;
	
}


	
}



?>