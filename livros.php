<?php
	function __autoload($class_name){
		require_once '' . $class_name . '.php';
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Livros</title>

    <link href="css/style.css" rel="stylesheet">

    <!-- Ícone do título HTML -->
    <link rel="shortcut icon" href="images/logo.svg">

    <!-- Incluindo o CSS do Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />

    <!-- Incluindo o CSS Personalizado -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <!-- Incluindo Biblioteca JQuery (Link Externo) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Incluindo o JavaScript do Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">

		<?php

			$autor = new Autor();

		    $livro = new Livro();

		    if(isset($_POST['salvar'])):

		      $titulo             = $_POST['titulo'];
		      $autor              = $_POST['autor'];
		      $qtd_exemplares     = $_POST['qtd_exemplares'];
		      //$dt_locacao         = $_POST['dt_locacao'];
		      //$dt_devolucao       = $_POST['dt_devolucao'];

		      $livro->setTitulo($titulo);
		      $livro->setAutor($autor);
		      $livro->setQtd_exemplares($qtd_exemplares);
		      //$livro->setDt_locacao($dt_locacao );
		      //$livro->setDt_devolucao($dt_devolucao );

		      if ($livro->insert()) {
		        echo "Livro Inserido com sucesso!";
      }

     // if ($livro->insert2()) {
       // echo "N para N cadastrado";
      //}
    endif;

    ?>

		<?php 
		if(isset($_POST['atualizar'])):
			$id 			= 'id_livro';
			$valor			= $_POST['id'];
			$titulo 		= $_POST['titulo'];
			$autor 			= $_POST['autor'];
			$qtd_exemplares = $_POST['qtd_exemplares'];
			$livro->setTitulo($titulo);
			$livro->setAutor($autor);
			$livro->setQtd_exemplares($qtd_exemplares);
			if($livro->update($id, $valor)){
				echo "Atualizado com sucesso!" . $nome;
			}
		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
			$id 	= 'id_livro';
			$valor 	= (int)$_GET['id'];
			if($livro->delete($id, $valor)){
				echo "Deletado com sucesso!";
			}
		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
			$id 	= 'id_livro';
			$valor 	= (int)$_GET['id'];
			$resultado = $livro->find($id, $valor);
		?>

		<form method="post" action="">
			<div class="input-prepend">
				<input type="text" name="titulo" value="<?php echo $resultado->titulo; ?>" placeholder="Título:" />
			</div>
			<div class="input-prepend">
				<input type="text" name="autor" value="<?php echo $resultado->autor; ?>" placeholder="Título:" />
			</div>
			<div class="input-prepend">
				<input type="text" name="qtd_exemplares" value="<?php echo $resultado->qtd_exemplares; ?>" placeholder="Título:" />
			</div>
			<input type="hidden" name="id" value="<?php echo $resultado->id_livro ?>">
			<br/>
			<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">					
		</form>

		<?php }else{ ?>


		<form method="post" action="">
			<div class="form-group col-md-4">
                <label>Título</label>
                <input name="titulo" type="text" class="form-control" placeholder="Título do livro">
            </div>
            <div class="form-group col-md-4">
                <label>Autor</label>
				  <select name="autor" value="<?php echo $value->id_autor; ?>" class="form-control" placeholder="Autor do livro">
				    <?php foreach($autor->findAll() as $key => $value): ?>
					    <option value=""><?php echo $value->nome; ?></option>
					<?php endforeach; ?>
				  </select>
            </div>
           <div class="form-group col-md-4">
                <label>Quantidade de exemplares</label>
                <input name="qtd_exemplares" type="text" class="form-control" placeholder="Quantidade de exemplares">
            </div>
			<br/>
			<input type="submit" name="salvar" class="btn btn-primary" value="Cadastrar dados">					
		</form>

		<?php } ?>

		<table class="table table-hover">
			
			<thead>
				<tr>
					<th>#</th>
					<th>Título:</th>
					<th>Autor:</th>
					<th>Exemplares:</th>
					<th>Ações:</th>
				</tr>
			</thead>
			
			<?php foreach($livro->findAll() as $key => $value): ?>

			<tbody>
				<tr>
					<td><?php echo $value->id_livro; ?></td>
					<td><?php echo $value->titulo; ?></td>
					<td><?php echo'SELECT nome FROM autor WHERE id_autor = ' .$value->autor?></td>
					<td><?php echo $value->qtd_exemplares; ?></td>
					<td>
						<?php echo "<a class='btn btn-primary btn-xs' href='livros.php?acao=visualizar&id=" . $value->id_livro . "'>Visualizar</a>"; ?>
						<?php echo "<a class='btn btn-warning btn-xs' href='livros.php?acao=editar&id=" . $value->id_livro . "'>Editar</a>"; ?>
						<?php echo "<a class='btn btn-danger btn-xs' href='livros.php?acao=deletar&id=" . $value->id_livro . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>

	</div>
</body>
</html>