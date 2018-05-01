<?php

	require_once 'conexao.php';

	abstract class Crud extends DB{
		
		protected $table;

		abstract public function insert();
		abstract public function update($id, $valor);

		public function find($id, $valor) {
			$sql	= "SELECT * FROM $this->table WHERE $id = $valor";
			$stmt	= DB::prepare($sql);
			//$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetch(); 
		}

		public function findAll() {
			$sql	= "SELECT * FROM $this->table";
			$stmt	= DB::prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function delete($id, $valor) {
			$sql	= "DELETE FROM $this->table WHERE $id = $valor";
			$stmt	= DB::prepare($sql);
			//$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			return $stmt->execute();
		}
	}

?>