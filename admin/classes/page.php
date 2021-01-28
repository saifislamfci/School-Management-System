<?php 
class Page extends Database{
	public $query;
	public function addPage ($table, $column, $columnValue) {
		if($this->insert($table, $column, $columnValue)) {
			$this->query = $this->query;
			return true;
		}
		$this->errors = $this->errors;
		return false;
		}

	public function getPage ($columnName, $table, $where = null) {
		if($this->select($columnName, $table, $where)) {
			$this->query = $this->query;
			return true;
			}
		return false;
			}

	public function updatePage ($table, $colNameValue, $where = null) {
		if($this->update($table, $colNameValue, $where)) {			
			return true;
		}
		return false;
		}
	public function deletePage ($table, $where) {
		if($this->delete($table, $where)) {			
			return true;
		}
		return false;
	}
			
		}//class
