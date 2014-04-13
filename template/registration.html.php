<? 

?>
<form  action="javascript:void(null)" > 
<div id="Registr_container"> 

<label for="nick" > Name </label>
<input name="nick" required="true" id="nick"   /> 
<label for="email" > EMAIL </label>
<input name="email"  id="email" required="true"/> 
<label for="password"> PASSWORD </label>
<input name="password" id="password" /> 
<label for="prepod" style="display: inline-block;"> Выбрать преподавательский профиль! </label>
<input type="checkbox"  name="prepod" id="prepod"/> 
<br> 
<a href="#"  style="position: relative; top: 30%" class="button" onclick="go()">Зарегестрироваться!!</a>
</div>
</form> 
<!--<script src="/js/registration.js"> </script>-->

<script> 
var main = document.getElementById('Registr_container'); 
var div_reg = document.createElement('div'); 

div_reg.id = "ServerRegistrationResponse"; 
main.appendChild(div_reg); 



function go() {
	
	

var nick = document.getElementById('nick').value; 
var password = document.getElementById('password').value; 
var email = document.getElementById('email').value;
var prepod = document.getElementById('prepod').checked;

(prepod) ? prepod=1 : prepod=0; 

var query = "nick="+nick+"&password="+password+"&email="+email+"&prepod="+prepod;


if(nick=="") {
	
	div_reg.innerHTML="Введите корректный ник!"; 
	return false; 
	
}
if(email.indexOf("@")==-1)  {
	div_reg.innerHTML="Введите корректный email!";
	return false; 
	}

if(password.length<6) {
	div_reg.innerHTML="Длина пароля должна быть не менее 6 символов"; 
return false; 
	
}  

var xml = new XMLHttpRequest(); 

xml.open("GET", "/registration/validate/?"+query, true); 

xml.onreadystatechange = function() {
	

	if(xml.readyState==4) 
	{
		
		
		div_reg.innerHTML = xml.responseText; 
		if(xml.responseText.indexOf(" Подтвердить")!=-1) {
			
			hide(); 
		}
		
		
	}
	

}
xml.send(); 

 }


function hide() {
	var label = document.getElementsByTagName('label'); 
	var inputs = document.getElementsByTagName('input'); 
	var a = document.getElementsByClassName("button")[0]; 
	for(i=0; i<label.length; i++) {
		label[i].style.display = "none"; 
		inputs[i].style.display = "none"; 
		
		
		
	}
	a.style.display = "none";
	
	
}




</script>




