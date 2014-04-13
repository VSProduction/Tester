<?php

header("Content-type: text/html; charset = utf-8");
/////// ЛОГИКУ ИЗ ЭТОГО ФАЙЛА ПОТОМ НАДО ПЕРЕНЕСТИ В МОДЕЛЬ! ЭТО ЕСТЬ В TODO.
if(isset($data[0]['nick'])) {
		echo "<div id='prepods'><p> Преподаватели, тесты которых доступны для Вас </p>"; 
		$trigger = 0; 
	}  else {
		echo "<div id='prepods'><p> Тесты доступные  для Вас </p>"; 
		$trigger = 1; 
	}
 
	
	
for($i=0; $i<count($data); $i++) {
	if($trigger==0) {
			echo "<a href='#' onclick='go(this)'>".strtolower($data[$i]['nick'])."</a><br>"; 
		
	}  
	
	
	if($trigger==1) {
		if(is_array($data)) {
			echo "<a href='/student/?name=".$data[$i]['id']."&prepod=".$data['prepod']."'>".$data[$i]['name']."</a><br>";
		} else {
			
			echo $data;
		}
		
	}
	
}
?>
<script src="/js/available_prepods.js"> </script>