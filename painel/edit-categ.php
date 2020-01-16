<?php

	require_once '../system/config.php';
	require_once '../system/database.php';

	if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) )
		header( 'Location: categorias.php' );
	else {

		$id 	= DBEscape( strip_tags( trim( $_GET['id'] ) ) );
		$categ 	= DBRead( 'categorias', "WHERE id = '$id'" );

		if( !$categ )
			header( 'Location: categorias.php' );
		else
			$categ = $categ[0];

	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Editar Categoria</title>
</head>

<body>

	<h2>
		Editar Categoria | <a href="categorias.php" title="Gerenciar Categorias">Gerenciar Categorias</a>
	</h2>
	<hr>

	<?php

		if( isset( $_POST['salvar'] ) ){

			$form['data'] = date( 'Y-m-d H:i:s' );
			$form['titulo'] = DBEscape( strip_tags( trim( $_POST['titulo'] ) ) );
			$form['descricao'] = DBEscape( strip_tags( trim( $_POST['descricao'] ) ) );

			if( empty( $form['titulo'] ) )
				echo 'Preencha o campo titulo!';
			else if( empty( $form['descricao'] ) )
				echo 'Preencha o campo descrição!';
			else {

				$check = DBRead( 'categorias', "WHERE titulo = '". $form['titulo'] ."' AND id != '$id'" );

				if( $check )
					echo 'Desculpe, mas já existe uma categoria com este titulo!';
				else {

					if( DBUpDate( 'categorias', $form, "id = '$id'" ) ){
						$categ 	= DBRead( 'categorias', "WHERE id = '$id'" );
						$categ 	= $categ[0];
						
						echo 'Alterações salvas com sucesso!';
					}else
						echo 'Desculpe, ocorreu um erro...';

				}

			}

			echo '<hr>';

		}

	?>

	<form action="" method="post">
		
		<p>
			<label>Titulo</label><br>
			<input type="text" name="titulo" value="<?php echo $categ['titulo']; ?>">
		</p>

		<p>
			<label>Descrição</label><br>
			<textarea name="descricao" cols="50" rows="15"><?php echo $categ['descricao']; ?></textarea>
		</p>

		<input type="submit" name="salvar" value="Salvar">

	</form>

</body>
</html>