
<?php

header("Content-type: text/html; charset=utf-8");
?>
<div id="test_view_container"> 


</div>
<script src="/js/main_functions.js"> </script>
<script> 

var container = document.getElementById('test_view_container'); 
var letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'L']; 
var name = location.search.slice(); 
var http = XMLHTTP(); 
var all_variants = new Array(); 
var count_vars = 0; //number of questions
var summ=0; 
var right_answer ='';  
var body = document.getElementsByTagName('body')[0]; 
function xml_go() {
	check_check(); // to check the roght answer; 


		if(count_vars==0) { // check for number of http request 
			url = "tests"; 
			post=name.slice(1);  
			} else {
				 url="numbers"; 
				post =  "number="+ count_vars + "&var="+right_answer; 
				 }
				

											http.open("POST", url, true); 
											http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
											http.onreadystatechange = function() {
								
								////the first questions
								
																if(http.readyState==4&&http.status==200) {
																if(!window.temp_questions) {
																	var temp = http.responseText; 
																window.temp_questions = json_decode(temp.slice(0,temp.indexOf('___')));
																window.temp_vars = 	json_decode(temp.slice(temp.indexOf('###')+3, temp.indexOf('@@@'))); //variants
																window.temp_count_vars = json_decode(temp.slice(temp.indexOf('___')+3, temp.indexOf('###') )); //counts
																			window.temp_number = json_decode(temp.slice(temp.indexOf('@@@')+3, temp.indexOf('NNN')));
																			window.temp_number = window.temp_number[window.temp_number.length-1];
																					window.temp_c_r = temp.slice(temp.indexOf('NNN')+3 ).split(',');
																					 
																	container.innerHTML = '<p id="quest">Вопрос:  </p>'; 
																(temp_c_r[count_vars]==1)? type='checkbox':type='radio';  // string that message us how many correct questions are
																		var qq = document.getElementById('quest'); 
																			qq.innerHTML+=window.temp_questions[count_vars];
																			
																	for(i=summ; i<window.temp_count_vars[count_vars]; i++) {
																		
																		
																		container.innerHTML+="<input type='"+type+"' name=2> "+window.temp_vars[i] + "<br>"; 
																		
																	
																}
																
																summ+=+window.temp_count_vars[count_vars]; 
																 
																count_vars++;
																
				container.innerHTML+='<p><a href="#" style="vertical-align:middle" class="button" id="st" onclick="xml_go()"> Дальше </a></p>';		
////the first questions


			for(i=1; i<+window.temp_number+ +1; i++) {
				
				create_elemetns(i);
			}


																} 	else { /////// other questions
															
																	if(!window.temp_questions[count_vars]) {
																		
																		container.innerHTML = "<p id='end_tests'>The tests End<br><a href='/main'> Перейти на главную!</a></p>"; 
																		colors(count_vars-1, http.responseText); 
																		return false; 
																		
																	}
																	
																		
																	container.innerHTML = '<p id="quest">Вопрос:  </p>'; 
																	var qq = document.getElementById('quest'); 
																		qq.innerHTML+=window.temp_questions[count_vars];
																(temp_c_r[count_vars]==1)? type='checkbox':type='radio'; 
																	for(i=summ; i<+summ + +window.temp_count_vars[count_vars]; i++) {
																		
																
																		container.innerHTML+="<input type='"+type+"' name=2> "+window.temp_vars[i] + "<br>"; 
																		
																		
																		
																		
																}
																		
																		colors(count_vars-1, http.responseText); 
																		summ+=+window.temp_count_vars[count_vars]; 
																		count_vars++;
																		container.innerHTML+='<p><a href="#" style="vertical-align:middle" class="button" id="st" onclick="xml_go()"> Дальше </a></p>';		
																/////// other questions
															} 
																
													
															
															}
 															
															
															
															
											}
											http.send(post); 
					
}



xml_go(); 

function create_elemetns(number) {
	
	
	
	window.elem = c_e({tag:'div',bg:'grey', position:'relative', top:'20%', left: '30%', body: body, color: 'white', shadow:'2px 1px 0px rgba(0,0,0,0.4)', bRadius: '2px' }); 
	window.elem.innerHTML = number;
	window.elem.style.textAlign = 'center'; 
	window.elem.style.float = "left";
	window.elem.style.padding = '0.4%';
	window.elem.style.margin= '3px';
	window.elem.className = 'Awesome'; 
	
}






function check_check() {
	right_answer = ''; 
	inputs = document.getElementsByTagName('input'); 
	for(i=0; i<inputs.length; i++) {
		if(inputs[i].checked) right_answer+=letters[i]+','; 
		
		
	}
	if(right_answer!='') {
		right_answer = right_answer.slice(0, -1); 
	}
}


function colors(number, response) {
	
	var bricks = document.getElementsByClassName('awesome'); 
	if(response.indexOf("good")!=-1) {
		bricks[number].style.backgroundColor = "green"; 
	} else {
		
				bricks[number].style.backgroundColor = "red"; 

	}
	
	
	
}



</script> 