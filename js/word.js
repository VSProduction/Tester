

	function XMLHTTP() {
		
		var d = new XMLHttpRequest(); 
		if(!d) {
			var d = new ActiveXObject("Msxml2.XMLHTTP"); 
			if(!d) {
				
				var d = new ActiveXObject("Microsoft.XMLHTTP");
				
			} else {
				
				alert("The programm cannot recognize the type of your browser"); 
				
			}
			
			
			
		}
		
		
		
		return d; 
		
	}
	
var d = XMLHTTP(); 

function generate() {
animation = document.getElementById('animation'); 
animation.innerHTML+="."; 
if(animation.innerHTML.length>10) {
	animation.innerHTML="Loading"; 
}
	
	
}

function olo() {
	
	var main_input = document.getElementById('table_n'); 
	if(main_input.value=="") {
		
		alert("¬ведите название таблицы"); 
		return false; 
	}
	ddd = setInterval(generate, 500); 
	animation.innerHTML="Loading"; 
var f = new FormData(); 
f.append("file", document.getElementById('file').files[0]);
f.append("table_name", document.getElementById('table_n').value); 
d.open("POST", "/teacher/Hword", true); 
//d.setRequestHeader('Content-Type', 'multipart/form-data');
d.onreadystatechange = function() {


	if(d.readyState==4) {
		
		clearInterval(ddd);
		if(d.responseText=="") {
			
			animation.innerHTML = "The test is successfull added"; 
		} else {
			
				animation.innerHTML = d.responseText; 

		}
		
		
	}
	
	
	
}

d.send(f);




	
	
}




