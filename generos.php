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
    <title>Gêneros</title>

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
		    $genero = new Genero();

		      if(isset($_POST['salvar'])):

		        $nome = $_POST['nome'];

		        $genero->setNome($nome);

		        if ($genero->insert()) {
		          echo "Gênero cadastrado com sucesso!";
		        } 
		      endif;
		    ?>

		<header class="masthead">
			<h1 class="muted">PHP OO</h1>
			<nav class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="active"><a href=".php">Página inicial</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<?php 
		if(isset($_POST['atualizar'])):
			$id 	= 'id_genero';
			$valor	= $_POST['id'];
			$nome 	= $_POST['nome'];
			$genero->setNome($nome);
			if($genero->update($id, $valor)){
				echo "Atualizado com sucesso!" . $nome;
			}
		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
			$id 	= 'id_genero';
			$valor 	= (int)$_GET['id'];
			if($genero->delete($id, $valor)){
				echo "Deletado com sucesso!";
			}
		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
			$id 	= 'id_genero';
			$valor 	= (int)$_GET['id'];
			$resultado = $genero->find($id, $valor);
		?>

		<form method="post" action="">
			<div class="input-prepend">
				<input type="text" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Nome:" />
			</div>
			<input type="hidden" name="id" value="<?php echo $resultado->id_genero ?>">
			<br/>
			<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">					
		</form>

		<?php }else{ ?>


		<form method="post" action="">
			<div class="form-group col-md-4">
                <label>Nome</label>
                <input name="nome" type="text" class="form-control" placeholder="Nome do gênero">
            </div>
			<br/>
			<input type="submit" name="salvar" class="btn btn-primary" value="Cadastrar dados">					
		</form>

		<?php } ?>

		<table class="table table-hover">
			
			<thead>
				<tr>
					<th>#</th>
					<th>Nome:</th>
					<th>Ações:</th>
				</tr>
			</thead>
			
			<?php foreach($genero->findAll() as $key => $value): ?>

			<tbody>
				<tr>
					<td><?php echo $value->id_genero; ?></td>
					<td><?php echo $value->nome; ?></td>
					<td>
						<?php echo "<a class='btn btn-primary btn-xs' href='autores.php?acao=visualizar&id=" . $value->id_autores . "'>Visualizar</a>"; ?>
						<?php echo "<a class='btn btn-warning btn-xs' href='generos.php?acao=editar&id=" . $value->id_genero . "'>Editar</a>"; ?>
						<?php echo "<a class='btn btn-danger btn-xs' href='generos.php?acao=deletar&id=" . $value->id_genero . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>

	</div>
</body>
</html>