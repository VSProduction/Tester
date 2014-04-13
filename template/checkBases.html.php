
<p style='position: absolute; left: 10%;top:-10%;'> Ваши тесты!</p>
<?php

header("Content-type: text/html; charset = utf-8");
for($i=0; $i<count($data)-1; $i++) {
	
	echo "<p id='checkBases'><a href='student/?name=".$data[$i]['id']."&prepod=".$data['prepod']."'>".$data[$i]['name']."</a><a href='#'> <img id='reggif' src='/images/icons/reg.gif'/></a></p>"; 
	
}
?>


<a href="/teacher/add" id="new_test" class="button"> Новый тест! </a>