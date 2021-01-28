<?php 
class Banner extends Database{
	public $query;
	public function addBanner ($table, $column, $columnValue) {
		if($this->insert($table, $column, $columnValue)) {
			$this->query = $this->query;
			return true;
		}
		$this->errors = $this->errors;
		return false;
		}

	public function getBanner ($columnName, $table, $where = null) {
		if($this->select($columnName, $table, $where)) {
			$this->query = $this->query;
			return true;
			}
		return false;
			}

	public function updateBanner ($table, $colNameValue, $where = null) {
		if($this->update($table, $colNameValue, $where)) {			
			return true;
		}
		return false;
		}
	public function deleteBanner ($table, $where) {
		if($this->delete($table, $where)) {			
			return true;
		}
		return false;
	}
			
		}//class