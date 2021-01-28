<?php require_once('database.php');

class Format{
	private $db;
	public function __construct()
	{
		 $this->db=new Database;
		 //var_dump( $this->db) ;
	}
	public  function validatehack($data)
	{
	  $data = trim($data);
	  $data = stripcslashes($data);
	  $data = htmlspecialchars($data);
	  $data=mysqli_real_escape_string($this->db->mysqli,$data);	  
	  return $data;
	}
}//class
?>