<?php
	
	require '../system/config.php';
	require '../system/database.php';

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Adicionar Postagem</title>
         <link rel="stylesheet" type="text/css" href="estilo/estilo.css" >

</head>

<body>
	
    
    
    <h2>
		Adicionar Postagem | <a href="index.php" title="Voltar">Voltar</a>
	</h2>
	<hr>

	<?php

		$categorias = DBRead( 'categorias', 'ORDER BY data DESC' );

		if( !$categorias )
			echo '<h2>Você não possui categorias cadastradas, <a href="add-categ.php">clique aqui para resolver isto</a>!<h2>';
		else {

			if( isset( $_POST['publicar'] ) ){

				$form['titulo'] 	= DBEscape( strip_tags( trim( $_POST['titulo'] ) ) );
				$form['autor'] 		= DBEscape( strip_tags( trim( $_POST['autor'] ) ) );
				$form['categoria'] 	= DBEscape( strip_tags( trim( $_POST['categoria'] ) ) );
				$form['status'] 	= DBEscape( strip_tags( trim( $_POST['status'] ) ) );
				$form['data']		= date('Y-m-d H:i:s');
				$form['conteudo'] 	= str_replace( '\r\n', "\n", DBEscape( trim( $_POST['conteudo'] ) ));

				if( empty( $form['titulo'] ) )
					echo 'Preencha o campo titulo!';
				else if( empty( $form['autor'] ) )
					echo 'Preencha o campo autor!';
				else if( empty( $form['categoria'] ) )
					echo 'Preencha o campo categoria!';
				else if( empty( $form['status'] ) && $form['status'] != '0' )
					echo 'Preencha o campo status!';
				
				else if( empty( $form['conteudo'] ) )
					echo 'Preencha o campo conteúdo!';
				else {

					$dbCheck = DBRead( 'posts', "WHERE titulo = '". $form['titulo'] ."'" );

					if( $dbCheck )
						echo 'Desculpe, mas já existe uma postagem com este titulo!';
					else {

						if( DBCreate( 'posts', $form ) )
							echo 'Sua postagem foi enviada co sucesso!';
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
			<label>Autor</label><br>
			<input type="text" name="autor">
		</p>

		<p>
			<label>Categoria</label><br>

			<select name="categoria">
				<option value="0" selected>Selecione uma categoria...</option>

				<?php

					foreach ( $categorias as $categ ) {
						 echo '<option value="'. $categ['id'] .'">'. $categ['titulo'] .'</option>';
					}
$categoria = "<select class='$categoria'>". $resposta."</select>";
				?>
			</select>
		</p>

		<p>
			<label>Status</label><br>
			
			<select name="status">
				<option value="1" selected>Ativo</option>
				<option value="0">Inativo</option>
			</select>
		</p>

		<p>
			<label>Conteúdo</label><br>
			<textarea name="conteudo" cols="50" rows="15"></textarea>
		</p>

                <input  class="btn-1" type="submit" name="publicar" value="Publicar">
               
                
	</form>
        
        
        
        
	<?php } ?>

</body>
</html>