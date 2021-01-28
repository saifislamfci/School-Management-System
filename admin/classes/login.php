<?php 

class Login extends Database {

	public $query;
	public function checkLogin($columnName, $table, $where = null) {
		if($this->select($columnName, $table, $where)) {
			$this->query = $this->query;
			return true;
		}
		return false;
	}	
}