
<html> 

<head> 


<link rel="stylesheet" href="/css.css" />
</head>

<body> 

<div id="header"> 
<h1> Create your own test! </h1>



<?php 

if(isset($_SESSION['nick'])) {
	session_start(); 
	echo '<img src="/images/icons/login.png" id="login_png"/> '; 
	echo '<a href="/auth/exit"   id="log_out" "> Log_out</a>';
	echo '<p id="hello"> HELLO, '.$_SESSION['nick'].' </p>';
}

  ?> 
 
</div>

<div id="box" > 

<?php
if($content!='') include($content); 
?> 


</div>

</body> 
</html> 













