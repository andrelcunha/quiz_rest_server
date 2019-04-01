<?php
	class Player{

		private $conn;
		private $table = 'players';

		public $id;
		public $name;
		public $score;
		public $alreadyPlayed;

		public function __construct($db){
			$this->conn = $db;
		}

		public function read(){
			$query = 'SELECT
			id,
			name,
			score
			FROM ' . $this->table . ' ORDER BY score DESC';

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		}

		/*public function read_single(){
			$query = 'SELECT
			id,
			name,
			score,
			alreadyPlayed
			FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(1, $this->id);
			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$this->name = $row['name'];
			$this->score = $row['score'];
			$this->score = $row['alreadyPlayed'];
		}*/

		public function check_for_permission($playerName){
			$query = 'SELECT id FROM not_permitted
			WHERE name LIKE :name';

			$stmt = $this->conn->prepare($query);
			$this->name = htmlspecialchars(strip_tags($playerName));
			$stmt->bindParam(':name', $this->name);

			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row;
		}

		public function check_if_played($playerName){
			$query = 'SELECT
			alreadyPlayed
			FROM ' . $this->table . ' WHERE name LIKE :name';
			$stmt = $this->conn->prepare($query);

			$this->name = htmlspecialchars(strip_tags($playerName));
			$stmt->bindParam(':name', $this->name);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row['alreadyPlayed']){
				return true;
			}
			return false;
		}


		public function check_if_exists($playerName){
			$query = 'SELECT
			name,
			alreadyPlayed
			FROM ' . $this->table . ' WHERE name LIKE :name';
			$stmt = $this->conn->prepare($query);

			$this->name = htmlspecialchars(strip_tags($playerName));
			$stmt->bindParam(':name', $this->name);

			$stmt->execute();

			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//return $row['alreadyPlayed'];
			if($row > 0){
				return true;
			}
			return false;
		}

		public function update($playerName, $score){
			$query = 'UPDATE ' .$this->table.
			' SET alreadyPlayed = :alreadyPlayed,
			score = :score
			WHERE name = :name';

			$stmt = $this->conn->prepare($query);
			$this->name = htmlspecialchars(strip_tags($playerName));
			$this->score = htmlspecialchars(strip_tags($score));
			$this->alreadyPlayed = 1;

			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':score', $this->score);
			$stmt->bindParam(':alreadyPlayed', $this->alreadyPlayed);


			if($stmt->execute()){
				return true;
			}
			return false;
		}

		public function create(){
			$query = 'INSERT INTO ' .$this->table.
			' SET name = :name,
				score = :score,
				alreadyPlayed = :alreadyPlayed';

			$stmt = $this->conn->prepare($query);

			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->score = 0;
			$this->alreadyPlayed = 0;

			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':score', $this->score);
			$stmt->bindParam(':alreadyPlayed', $this->alreadyPlayed);

			if($stmt->execute()){
				return true;
			}

			printf("Error: %s.\n", $stmt->error);
			return false;
		}
	}
