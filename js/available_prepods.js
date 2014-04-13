
function go(a) {
	
	
var data = "p_nick="+a.innerHTML; 

var prepods = document.getElementById('prepods'); 
var xml = new XMLHttpRequest(); 
xml.open("POST", "/main/variants", true); 
xml.setRequestHeader("Content-type", 'application/x-www-form-urlencoded'); 
xml.onreadystatechange = function() {
	
	
	if(xml.readyState==4&&xml.status==200) {
		
		parser = new DOMParser(); 
		var text = parser.parseFromString(xml.responseText, 'text/html');
		text = text.getElementById('box').innerHTML; 
		prepods.innerHTML =  text;
		
	}
	
}
xml.send(data); 

}
