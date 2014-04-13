




	var body = document.getElementsByTagName('body')[0]; 
	var aword = document.getElementById('aword'); 
	///initialize of scrollbar
	var notice = document.createElement('p');
	notice.id = 'notice'; 
	notice.innerHTML = 'Передвигайте ползунок, чтобы выбрать определенное количество тестов!'; 
	body.appendChild(notice); 
	var scrollbar = document.createElement('div'); 
	scrollbar.id = 'scroll'; 
	body.appendChild(scrollbar); 
	var slider = document.createElement('div'); 
	slider.id = 'slider';
	scrollbar.appendChild(slider); 
	//////////////
	var inputs = document.getElementsByTagName('input'); 
	var labels = document.getElementsByTagName('p'); 
	var check = 1; 
	var event=event||window.event;
	var form = document.getElementById('form'); 
	var d = document.getElementById('table_name'); 
	var l = document.getElementById('label_table_name');
	var win = document.createElement('div'); 
	var names = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L', '']; 

	window.checker = 0; 
	window.bigLeft = parseFloat(getComputedStyle(scrollbar)['left']); 
	window.bigWidth = parseFloat(getComputedStyle(scrollbar)['width']); 
	window.smallWidth = parseFloat(getComputedStyle(slider)['width']); 
	k = window.bigWidth/names.length; 
	last_mod =0 ; 
	scrollbar.style.visibility = "hidden";
	var questions = document.getElementById('questions');
	questions.style.height = "10px"; 
	
	
hide2('hidden'); 

function olo() { 

								if(d.value=='') {popup_add();  return; }  // check if the field this db name is correct

								var c = document.getElementById('form');
								var dat = new FormData(c); 

								for(var key in inputs) {
									if(inputs[key].type=="checkbox"&&inputs[key].checked==false||inputs[key].value===undefined||inputs[key].value=='') continue; //if checkbox arn`t checked
									switch(inputs[key].name) {
										case 'table_name':
										url = '/teacher/handler'; 
										break; 
										case 'question': 
										url = '/teacher/Htest'; 
									} //понять куда отправлять запрос
									dat.append(inputs[key].name, inputs[key].value ); 	 
}



var 	RT = document.getElementById('RT'); 

var xml = new XMLHttpRequest(); 
xml.open("POST", url , true); 

xml.onreadystatechange = function() {
	if(xml.readyState==4&&xml.status==200) {
		

if(xml.responseText!='') { //check the response from the server
	RT.innerHTML = xml.responseText; // to handle the errors
	
} else {
	
	hide();
	hide2('visible'); 
	RT.innerHTML = xml.responseText;
	clean_fields();
}
	}
	
	

	
}


xml.send(dat); 









	
	
	
	
}



function hide() {
	

	if(check==1&&d.value!='') { //check if the d.value exist & it`s havn`t removed yet
	check=0; 
			form.removeChild(d); 
			form.removeChild(l); 
			aword.style.display = "none";
			scrollbar.style.visibility = "visible"; 
			if(document.getElementById('win')) {
			form.removeChild(document.getElementById('win')); 
							
			}
		} 
		
		


}


function popup_add() {
	form.appendChild(win); 
		win.style.position = "relative"; 
		win.style.top = "10%";
		win.style.textAlign= "center";
		win.innerHTML = " &nbsp Input some value";
		win.style.border="2px solid #e78f18"; 
		win.id = 'win'; 
	
	
}


function hide2(param) {
	notice.style.visibility=param;
	q.style.visibility = param;
	var inputs = document.getElementsByTagName('input'); 
	
	param=='hidden'? (i=1):(i=0); 
		//from what element execute hidden
for(;i<2;i++) {
	if(inputs[i]) {
		
			inputs[i].style.visibility=param; 
	//labels[i].style.visibility = param;
	}

	
	
}


	
	
	
}


function clean_fields() {
	
	for(i=0; i<inputs.length; i++) {
		
		inputs[i].value=""; 
		if(inputs[i].type=="checkbox") {
			
			inputs[i].checked = false; 
			
		}
		
	}
	
	
	
}

////*34434344444444444444444
slider.onmousedown = function(e) {
	console.log(window.bigWidth);
	console.log(window.smallWidth);
	window.checker = 1; 
	window.x = e.clientX;

}

document.getElementsByTagName('body')[0].onmousemove = function(e) {//for easy drag and drop

	if(window.checker==1&&e.clientX>window.x) {//right move

		if(parseFloat(getComputedStyle(slider)['left'])>window.bigWidth-40) {//если положение левой стороны больше ширины полоски  с запасом в 40 px

			slider.style.left = window.bigWidth  - window.smallWidth + 'px'; // вернуть ее в крайне правое положение
		
		return; 
			
			
		}
		
	
		if(e.clientX>window.bigLeft + window.bigWidth - window.smallWidth) {//если слайдер достиг левого предела
			window.x = window.bigLeft + window.bigWidth - window.smallWidth; //назначить новую точку отчета в крайней левой позиции
		
			
		} else {
				window.x = e.clientX;
		}
		slider.style.left = window.x - window.bigLeft + 'px';
		
		if(Math.ceil((parseFloat(getComputedStyle(slider)['left']))/k)>last_mod) {
	
		diff = Math.ceil(parseFloat(getComputedStyle(slider)['left'])/k) - last_mod; 
			
			for(i=0; i<diff; i++) {
				input_build(names[last_mod+i]);
				
			}
			
			last_mod=Math.ceil(parseFloat(window.x-window.bigLeft)/k); 
			
			
		}//set the borders of created input

	
	
	}
		if(window.checker==1&&e.clientX<window.x) {//left move
		
	if(parseFloat(getComputedStyle(slider)['left'])<20) {//if the slider is at the border of the start
					var g = document.getElementsByTagName('input'); 

		if(g[2]) {
			
		input_destroy();
		last_mod--; //to set counter form the inception
			
		}
			
		slider.style.left = '1px';
		return; 
		
	} 
if(e.clientX<window.bigLeft) {//to 
			window.x = window.bigLeft; 
			
		} else {
				window.x = e.clientX;
		}



		slider.style.left = window.x - window.bigLeft  + 'px';
		
			if(Math.ceil(parseFloat(getComputedStyle(slider)['left'])/k)<last_mod) {
				
				diff = -Math.ceil(parseFloat(getComputedStyle(slider)['left'])/k) + last_mod; 
				for(i=0; i<diff; i++) {
					input_destroy();
					last_mod--;	
				}
				
				
				
				
			}
		
	}
	
	
	
}

document.getElementsByTagName('body')[0].onmouseup = function() {

	window.checker = 0; 
	
}



function input_build(name) {
	
		questions.style.height = "auto"; //to set the interval beetween anchors and embed
	var field = document.createElement('input'); 
	questions.style.margin = "20px";
	var correct = document.createElement('input'); 
	var label = document.createElement('p'); 
	field.style.width = "75%";
	correct.type="checkbox";
	correct.name = "c"+name; 
	correct.className = "cor"; 
	correct.value= name; 
	var br  = document.createElement('br');
	field.name = name; 
	field.type = "text"; 
	correct.style.position = "relative"; 
	correct.style.float = "right";
	correct.style.verticalAlign = "bottom";
	label.innerHTML = name;
	label.style.display="inline-block";
	label.style.width = "7%";
	label.style.marginTop = "-5px";
	questions.appendChild(label);
	questions.appendChild(field);

	questions.appendChild(correct); 
questions.appendChild(br);
}


function input_destroy() {
	e = event||window.event; 
	var getto = document.getElementById('questions');
			
			var br = getto.getElementsByTagName('br'); 
	var field = getto.getElementsByTagName('input'); 
		var label = getto.getElementsByTagName('p'); 
	questions.removeChild(field[field.length-1]);
		questions.removeChild(field[field.length-1]);
	questions.removeChild(label[label.length-1]);
	questions.removeChild(br[br.length-1]);

		

}




