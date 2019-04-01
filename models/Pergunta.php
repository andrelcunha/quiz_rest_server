<?php
	class Pergunta{

		private $conn;
		private $table = 'perguntas';

		public $id;
		public $quiz_id;
		public $enunciado;
		public $peso; //  dificulty


		public function __construct($db){
			$this->conn = $db;
		}

		public function create(){
			$query = 'INSERT INTO ' .$this->table.
			' SET quiz_id = :quiz_id,
				pergunta_enunciado = :enunciado,
				pergunta_peso = :peso';

			$stmt = $this->conn->prepare($query);

			$this->quiz_id = htmlspecialchars(strip_tags($this->quiz_id));
			$this->enunciado = htmlspecialchars(strip_tags($this->enunciado));
			$this->peso = htmlspecialchars(strip_tags($this->peso));

			$stmt->bindParam(':quiz_id', $this->quiz_id);
			$stmt->bindParam(':enunciado', $this->enunciado);
			$stmt->bindParam(':peso', $this->peso);

			if($stmt->execute()){
				return true;
			}

			printf("Error: %s.\n", $stmt->error);
			return false;
		}

		public function read(){
			$query = 'SELECT
			pergunta_id,
			quiz_id,
			pergunta_enunciado,
			pergunta_peso
			FROM ' . $this->table . ' ORDER BY pergunta_id DESC';

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		}

		public function update($id, $enunciado, $peso){
			$query = 'UPDATE ' .$this->table.
			' SET pergunta_enunciado = :enunciado,
			pergunta_peso = :peso
			WHERE pergunta_id = :id';

			$stmt = $this->conn->prepare($query);
			$this->id = htmlspecialchars(strip_tags($id));
			$this->enunciado = htmlspecialchars(strip_tags($enunciado));
			$this->peso = htmlspecialchars(strip_tags($peso));

			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':enunciado', $this->enunciado);
			$stmt->bindParam(':peso', $this->peso);


			if($stmt->execute()){
				return true;
			}
			return false;
		}

		public function delete(){
			$query = 'DELETE
			FROM ' . $this->table . ' WHERE pergunta_id = :id';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()){
				return true;
			}
			return false;
		}

	}
