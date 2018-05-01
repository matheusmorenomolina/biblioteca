<?php

	require_once 'crudAbstract.php';

	class Livro extends Crud {

		protected $table = 'livro';
		private $titulo;
		private $autor;
		private $qtd_exemplares;
		//private $dt_locacao;
		//private $dt_devolucao;
		//private $id_livro;
		//private $id_genero;

		public function setTitulo($titulo) {
			$this->titulo = $titulo;
		}

		public function setAutor($autor) {
			$this->autor = $autor;
		}

		public function setQtd_exemplares($qtd_exemplares) {
			$this->qtd_exemplares = $qtd_exemplares;
		}

		public function setDt_locacao($dt_locacao) {
			$this->dt_locacao = $dt_locacao;
		}

		public function setDt_devolucao($dt_devolucao) {
			$this->dt_devolucao = $dt_devolucao;
		}

		public function insert() {
			$sql 	= "INSERT INTO $this->table (titulo, autor, qtd_exemplares) VALUES (:titulo, :autor, :qtd_exemplares)";
			$stmt	= DB::prepare($sql);
			$stmt->bindParam(':titulo', $this->titulo);
			$stmt->bindParam(':autor', $this->autor);
			$stmt->bindParam(':qtd_exemplares', $this->qtd_exemplares);
			//$stmt->bindParam(':dt_locacao', $this->dt_locacao);
			//$stmt->bindParam(':dt_devolucao', $this->dt_devolucao);
			return $stmt->execute();
		}

		public function insert2() {
			$sql 	= "INSERT INTO LIVRO_GENERO (id_livro) VALUES (:id_livro)";
			$stmt	= DB::prepare($sql);
			$stmt->bindParam(':id_livro', $id_livro);
			$stmt->bindParam(':id_genero', $id_genero);
			return $stmt->execute();
		}

		public function update($id, $valor) {
			$sql = "UPDATE $this->table SET titulo = :titulo, autor = :autor, qtd_exemplares = :qtd_exemplares WHERE $id = $valor";
			$stmt	= DB::prepare($sql);
			$stmt->bindParam(':titulo', $this->titulo);
			$stmt->bindParam(':autor', $this->autor);
			$stmt->bindParam(':qtd_exemplares', $this->qtd_exemplares);
			//$stmt->bindParam(':dt_locacao', $this->dt_locacao);
			//$stmt->bindParam(':dt_devolucao', $this->dt_devolucao);
			//$stmt->bindParam(':id', $id);
			return $stmt->execute();
		}

		//public function update($id, $valor) {
		//	$sql = "UPDATE $this->table SET nome = :nome WHERE $id = $valor";
		//	$stmt	= DB::prepare($sql);
		//	$stmt->bindParam(':nome', $this->nome);
		//	//$stmt->bindParam(':id', $id);
		//	return $stmt->execute();
		//}

	}

?>