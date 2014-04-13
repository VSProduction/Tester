<?php
class Controller_rating extends Controller {
	
	public function Action_index() {
		
		$this->model = new Model_rating; 
		$this->view->getView(TEMPL.'All_students.html.php', $this->model->getData()); 

	}
	
	public function Action_table() {
		
		$this->model = new Model_rating; 
			$this->data = $this->model->getTableData(); 
			$data = $this->model->table.
						$this->model->tr.$this->model->th."Название пройденного теста".$this->model->th."Средний бал, полученный за тест".$this->model->th."Максимальный бал за тест".$this->model->th."Процент правильных ответов"; 
						for($i=0; $i<count($this->data); $i++) {
							$data.=$this->model->tr.$this->model->passed.$this->data[$i]['name'].$this->model->td.$this->data[$i]['rating'].$this->model->td.$this->data[$i]['summ'].$this->model->td.round($this->data[$i]['rating']/$this->data[$i]['summ']); 
							
							
						}
		
	$this->view->getView(TEMPL.'table.html.php', $data);
	}
	
	
	
	
}



?>