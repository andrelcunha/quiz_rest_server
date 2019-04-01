<?php
	class Database{

		private $host;
		private $username;
		private $password;
		private $db_name;
		private $conn;

		function __construct() {
			$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
			$this->host = $cleardb_url["host"];
			$this->username = $cleardb_url["user"];
			$this->password = $cleardb_url["pass"];
			$this->db_name = substr($cleardb_url["path"],1);
		}

		public function connect(){
			$this->conn = null;

			try{
				$this->conn = new PDO('mysql:host=' . $this->host .
					';dbname=' . $this->db_name. ';charset=utf8', $this->username, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){
				echo 'Connection Error: ' . $e->getMessage();

			}
			return $this->conn;
		}
	}
