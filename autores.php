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
    <title>Autores</title>

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

		      if(isset($_POST['salvar'])):

		        $nome = $_POST['nome'];

		        $autor->setNome($nome);

		        if ($autor->insert()) {
		          echo "Autor cadastrado com sucesso!";
		        } 
		      endif;
		    ?>

		<header>
			<h1>PHP OO</h1>
			<nav class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="active"><a href="index.php">Página inicial</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>

		<?php 
		if(isset($_POST['atualizar'])):
			$id 	= 'id_autor';
			$valor	= $_POST['id'];
			$nome 	= $_POST['nome'];
			$autor->setNome($nome);
			if($autor->update($id, $valor)){
				echo "Atualizado com sucesso!" . $nome;
			}
		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
			$id 	= 'id_autor';
			$valor 	= (int)$_GET['id'];
			if($autor->delete($id, $valor)){
				echo "Deletado com sucesso!";
			}
		endif;
		?>

		<?php
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
			$id 	= 'id_autor';
			$valor 	= (int)$_GET['id'];
			$resultado = $autor->find($id, $valor);
		?>

		<form method="post" action="">
			<div class="form-group col-md-4">
				<input class="form-control" type="text" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Nome:" />
				<input type="hidden" name="id" value="<?php echo $resultado->id_autor ?>">
			</div>
			<br/>
			<div>
				<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">
			</div>
								
		</form>

		<?php }else{ ?>


		<form method="post" action="">
			<div class="form-group col-md-4">
                <label>Nome</label>
                <input name="nome" type="text" class="form-control" placeholder="Nome do autor">
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
			
			<?php foreach($autor->findAll() as $key => $value): ?>

			<tbody>
				<tr>
					<td><?php echo $value->id_autor; ?></td>
					<td><?php echo $value->nome; ?></td>
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel"></h4>
					      </div>
					      <div class="modal-body">
					      	<p><?php echo $value->id_autor; ?></p>
					      	<p><<?php echo $value->nome; ?></p>
					      </div>
					    </div>
					  </div>
					</div>
					<td>
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" value="$value->id_autor">
						  Visualizar
						</button>
						<?php echo "<a class='btn btn-warning btn-xs' href='autores.php?acao=editar&id=" . $value->id_autor . "'>Editar</a>"; ?>
						<?php echo "<a class='btn btn-danger btn-xs' href='autores.php?acao=deletar&id=" . $value->id_autor . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>

	</div>
</body>
</html>