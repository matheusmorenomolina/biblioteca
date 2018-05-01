<?php

	require_once 'crudAbstract.php';

	class Livro_genero extends Crud {

		protected $table = 'livro_genero';
		private $id_livro;
		private $id_genero;

		public function setId_livro($id_livro) {
			$this->id_livro = $id_livro;
		}

		public function setId_genero($id_genero) {
			$this->id_genero = $id_genero;
		}

		public function insert() {
			$sql 	= "INSERT INTO $this->table (id_livro, id_genero) VALUES (:id_livro, :id_genero)";
			$stmt	= DB::prepare($sql);
			$stmt->bindParam(':id_livro', $this->id_livro);
			$stmt->bindParam(':id_genero', $this->id_genero);
			return $stmt->execute();
		}

		public function update($id, $valor) {
		//	$sql = "UPDATE $this->table SET nome = :nome WHERE $id = $valor";
		//	$stmt	= DB::prepare($sql);
		//	$stmt->bindParam(':nome', $this->nome);
			//$stmt->bindParam(':id', $id);
		//	return $stmt->execute();
		}
	}

?>