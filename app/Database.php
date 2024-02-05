<?php


//include_once('./config/dbconfig.php');

class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'sales_management';

    private $link;
    private $stmt;
    public $error;

    public function __construct() {
        $this->dbConnect();
    }

    protected function dbConnect(){
        try
        {
            $this->link = new PDO("mysql:host=".$this->host.";dbname=".$this->database,$this->user,$this->password);
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo("Error: " . $e->getMessage());
        }
    }

    public function query($query)
	{
		$this->stmt = $this->link->prepare($query);
	}	
	
	public function bind($param, $value, $type = null)
	{
		if(is_null($type))
		{
			switch(true)
			{
				case is_int($value);
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value);
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value);
					$type = PDO::PARAM_NULL;
					break;
				default;
					$type = PDO::PARAM_STR;
				
			}
		}
		$this->stmt->bindValue($param, $value, $type); 	
	}

	public function execute($array = null)
	{
		return $this->stmt->execute($array);
	}

	public function lastInsertId()
	{
		return $this->link->lastInsertId();
	}

    public function result($array = null)
	{
		$this->execute($array);
		return $this->stmt->fetch();
	}

}