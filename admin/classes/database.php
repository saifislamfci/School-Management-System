<?php 

class Database {

	public $mysqli;
	protected $errors;
	protected $query;
	
	public function __construct () {		
		$this->connectDB();
	}
	private function connectDB()
	{
		$this->mysqli = new mysqli('localhost', 'root', '', 'scms');
		if($this->mysqli->connect_error) {
			die('<div style="background-color:red; padding:10px; color: #fff;">Connection Failed</div>');
		}
	}

	protected function insert ($table, $column, $columnValue) {
	
		$column 		= implode(', ', $column);
		$columnValues	= [];

		foreach ($columnValue as $key => $value) {
			$columnValues[] = "'$value'";
		}

		$columnValues 	= implode(', ', $columnValues);	
		
		$sql 			= "INSERT INTO $table ($column) VALUES ($columnValues) ";		

		if($this->mysqli->query($sql)) {
			return true;
		} else {
			$this->errors = $this->mysqli->error;
			return false;			
		}
		
	}

	protected function select ($columnName, $table, $where) {

		
		$columnName		= implode(', ', $columnName);
		$sql = "SELECT $columnName FROM $table ";
		if($where) {			
			$chunk 		= array_chunk($where, 3);
			$arr 		= array();			
				
			foreach ($chunk as $key => $value) {					
					if(is_string($value[2])) {
						$value[2] = "'$value[2]'";
					} else {
						$value[2] = $value[2];
					}
				$arr[] = implode(' ', $value);
			}

			$whereValue =  implode(' AND ', $arr);		
			$sql		.= " WHERE $whereValue";	

		}
		
		if($this->mysqli->query($sql)) {
			$this->query = $this->mysqli->query($sql);	
			return true;
		} else {
			print_r("it's false");
			$this->errors = $this->mysqli->error;
			return false;			
		}
	}


	public function update ($table, $colNameValue, $where) {

		$colNameValues = [];
		foreach ($colNameValue as $key => $value) {
			$colNameValues[] = "$key = '$value'";
		}

		$colNameValues = implode(' , ', $colNameValues);		

		$sql =  "UPDATE $table SET $colNameValues";
	
		if($where) {
			
			$chunk 		= array_chunk($where, 3);
			$arr 		= array();				
				
			foreach ($chunk as $key => $value) {
				$arr[] = implode(' ', $value);
			}			
			$whereValue =  implode(' AND ', $arr);		
			$sql		.= " WHERE $whereValue";	
		}		
		

		if($this->mysqli->query($sql)) {				
			return true;
		} else {
			$this->errors = $this->mysqli->error;
			return false;			
		}		
	}

	public function delete ($table, $where) {

		$sql =  "DELETE FROM $table ";
		
		$chunk 		= array_chunk($where, 3);
		$arr 		= array();				
			
		foreach ($chunk as $key => $value) {
			$arr[] = implode(' ', $value);
		}			
		$whereValue =  implode(' AND ', $arr);		
		$sql		.= " WHERE $whereValue";	

		if($this->mysqli->query($sql)) {				
			return true;
		} else {
			$this->errors = $this->mysqli->error;
			return false;			
		}	
			
	}

}