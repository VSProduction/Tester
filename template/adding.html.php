
<?php 
header("Content-type: text/html; charset = utf-8"); 
?> 
<style> 
body {
-moz-user-select: -moz-none;
-o-user-select: none;
-khtml-user-select: none;
-webkit-user-select: none;
user-select: none; 
}


</style>
<div id="test_container"> 

<form method="POST" name="new_test" id="form" action="javascript:void(null);" onsubmit="olo()"> 

<label for="table_name" id="label_table_name" > Variation name!</label>
<input name="table_name" type="text" id="table_name"/> <br>
<a href="word" id="aword"> Загрузить файл из MS Word</a>
<label for="question" id="q"> Question!</label>

<input name="question" id="qq" type="text" style="margin-bottom: 30px"/> <br>
<a href="#" onclick="olo()" id="test_add" class="button" style="margin: 20px""> Добавить тест! </a>
 
<a href="/teacher" class="button"> Закончить! </a><br>
<div id="questions"> 

</div>


</form> 
</div>
<div  id="RT"> </div>

<script src='/js/addingTest.js'> </script> 