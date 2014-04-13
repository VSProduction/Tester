
<p>  Преподаватели, тесты которых доступны для Вас:</p>
<?php
header("Content-type: text/html; charset=utf-8");
if(is_array($data)) {
for($i=0; $i<count($data); $i++) {
	
		echo "<a  href='/rating/table/?nick=".$data[$i]['student']."'> ".($i+1).")  ".$data[$i]['student']."</a><br>";
	
}
} else {
	echo $data;
}
?> 