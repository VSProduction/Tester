<?php 
if($_SERVER['REQUEST_URI']=='/auth/login') die($response); 
if(isset($_SESSION['nick'])) die('<p id="no_valid">�� ��� ���������������!<br><a href="/main"> �� ������� </a>'); 

?>
<html> 
<head> 
<link rel="stylesheet" href="/css.css" />
<!--<script src="/auth.js"> </script>  -->
</head>
<body> 
<form action="../auth/login" method="post" name="O"> 
<div id="auth_container">

<label for="nick"> ������� ��� ��� ��� e-mail </label>
<input type="text" id="nick" name="nick"/> 
<label for="password"  > ������� ��� ������! </label>
<input  type="password" id="password" name="password"/> 


<a href="/registration" > �����������! </a> <br><br>
<a href="#" class="button"  onclick="document.forms[0].submit(); return false;"> ������������!</a>
 </div>
</form> 






</body>







</html>
