<?php

	require_once 'crudAbstract.php';

	class Autor extends Crud {

		protected $table = 'autor';
		private $nome;

		public function setNome($nome) {
			$this->nome = $nome;
		}

		public function insert() {
			$sql 	= "INSERT INTO $this->table (nome) VALUES (:nome)";
			$stmt	= DB::prepare($sql);
			$stmt->bindParam(':nome', $this->nome);
			return $stmt->execute();
		}

		public function update($id, $valor) {
			$sql = "UPDATE $this->table SET nome = :nome WHERE $id = $valor";
			$stmt	= DB::prepare($sql);
			$stmt->bindParam(':nome', $this->nome);
			//$stmt->bindParam(':id', $id);
			return $stmt->execute();
		}
	}

?>