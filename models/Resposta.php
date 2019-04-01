<?php
	class Resposta{

		private $conn;
		private $table = 'respostas';

		public $id;
		public $pergunta_id;
		public $texto;
		public $certa;


		public function __construct($db){
			$this->conn = $db;
		}

		public function create(){
			$query = 'INSERT INTO ' .$this->table.
			' SET pergunta_id = :pergunta_id,
				resposta_texto = :texto,
				resposta_certa = :certa';

			$stmt = $this->conn->prepare($query);

			$this->pergunta_id = htmlspecialchars(strip_tags($this->pergunta_id));
			$this->texto = htmlspecialchars(strip_tags($this->texto));
			$this->certa = htmlspecialchars(strip_tags($this->certa));

			$stmt->bindParam(':pergunta_id', $this->quiz_id);
			$stmt->bindParam(':texto', $this->texto);
			$stmt->bindParam(':certa', $this->certa);

			if($stmt->execute()){
				return true;
			}

			printf("Error: %s.\n", $stmt->error);
			return false;
		}

		public function read(){
			$query = 'SELECT
			resposta_id,
			pergunta_id,
			resposta_texto,
			resposta_certa
			FROM ' . $this->table;

			if (!empty( $this->pergunta_id)){
				$query .= ' WHERE pergunta_id = :pergunta_id';
			}
			$query .= ' ORDER BY pergunta_id DESC';
			$stmt = $this->conn->prepare($query);

			if (!empty( $this->pergunta_id)){
				$stmt->bindParam(':pergunta_id', $this->pergunta_id);
			}
			$stmt->execute();

			return $stmt;
		}

		public function update($id, $texto, $certa){
			$query = 'UPDATE ' .$this->table.
			' SET resposta_texto = :texto,
			resposta_certa = :certa
			WHERE resposta_id = :id';

			$stmt = $this->conn->prepare($query);
			$this->id = htmlspecialchars(strip_tags($id));
			$this->enunciado = htmlspecialchars(strip_tags($enunciado));
			$this->peso = htmlspecialchars(strip_tags($peso));

			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':texto', $this->enunciado);
			$stmt->bindParam(':certa', $this->certa);


			if($stmt->execute()){
				return true;
			}
			return false;
		}

		public function delete(){
			$query = 'DELETE
			FROM ' . $this->table . ' WHERE resposta_id = :id';

			$stmt = $this->conn->prepare($query);

			$stmt->bindParam(':id', $this->id);

			if($stmt->execute()){
				return true;
			}
			return false;
		}

	}
