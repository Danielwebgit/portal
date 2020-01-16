<<<<<<< Updated upstream
<?php

	require_once '../system/config.php';
	require_once '../system/database.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
        
	      <title>..::Adicionar Categoria::..</title>
              <link rel="stylesheet"type="text/css" href="estilo/estilo.css" >
      
        
</head>

<body>

	<h2>
		Adicionar Categoria | <a href="categorias.php" title="Gerenciar Categorias">Gerenciar Categorias</a>
               <a href="categorias.php" title="Gerenciar Categorias">Gerenciar Categorias</a>
	</h2>
	<hr>

	<?php

		if( isset( $_POST['cadastrar'] ) ){

			$form['data'] = date( 'Y-m-d H:i:s' );
			$form['titulo'] = DBEscape( strip_tags( trim( $_POST['titulo'] ) ) );
			$form['descricao'] = DBEscape( strip_tags( trim( $_POST['descricao'] ) ) );

			if( empty( $form['titulo'] ) )
				echo 'Preencha o campo titulo!';
			else if( empty( $form['descricao'] ) )
				echo 'Preencha o campo descrição!';
			else {

				$check = DBRead( 'categorias', "WHERE titulo = '". $form['titulo'] ."'" );

				if( $check )
					echo 'Desculpe, mas já existe uma categoria com este titulo!';
				else {

					if( DBCreate( 'categorias', $form ) )
						echo 'Categoria cadastrada com sucessso!';
					else
						echo 'Desculpe, ocorreu um erro...';

				}

			}

			echo '<hr>';

		}

	?>

	<form action="" method="post">
		
         
		<p>
			<label>Titulo</label><br>
			<input type="text" name="titulo">
		</p>

		<p>
			<label>Descrição</label><br>
			<textarea name="descricao" cols="50" rows="15"></textarea>
		</p>

		<input class="bot_cadas" type="submit" name="cadastrar" value="Cadastrar">
                
	</form>
	
</body>
=======
<?php

	require_once '../system/config.php';
	require_once '../system/database.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
        
	      <title>..::Adicionar Categoria::..</title>
              <link rel="stylesheet"type="text/css" href="estilo/estilo.css" >
      
        
</head>

<body>

	<h2>
		Adicionar Categoria | <a href="categorias.php" title="Gerenciar Categorias">Gerenciar Categorias</a>
               <a href="categorias.php" title="Gerenciar Categorias">Gerenciar Categorias</a>
	</h2>
	<hr>

	<?php

		if( isset( $_POST['cadastrar'] ) ){

			$form['data'] = date( 'Y-m-d H:i:s' );
			$form['titulo'] = DBEscape( strip_tags( trim( $_POST['titulo'] ) ) );
			$form['descricao'] = DBEscape( strip_tags( trim( $_POST['descricao'] ) ) );

			if( empty( $form['titulo'] ) )
				echo 'Preencha o campo titulo!';
			else if( empty( $form['descricao'] ) )
				echo 'Preencha o campo descrição!';
			else {

				$check = DBRead( 'categorias', "WHERE titulo = '". $form['titulo'] ."'" );

				if( $check )
					echo 'Desculpe, mas já existe uma categoria com este titulo!';
				else {

					if( DBCreate( 'categorias', $form ) )
						echo 'Categoria cadastrada com sucessso!';
					else
						echo 'Desculpe, ocorreu um erro...';

				}

			}

			echo '<hr>';

		}

	?>

	<form action="" method="post">
		
         
		<p>
			<label>Titulo</label><br>
			<input type="text" name="titulo">
		</p>

		<p>
			<label>Descrição</label><br>
			<textarea name="descricao" cols="50" rows="15"></textarea>
		</p>

		<input class="bot_cadas" type="submit" name="cadastrar" value="Cadastrar">
                
	</form>
	
</body>
>>>>>>> Stashed changes
</html>