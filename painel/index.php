<?php

	require_once "../system/config.php";
	require_once "../system/database.php";

	if( isset( $_GET['action'] ) && isset( $_GET['id'] ) && !empty( $_GET['action'] ) && !empty( $_GET['id'] ) ){

		$id = DBEscape( strip_tags( trim( $_GET['id'] ) ) );

		switch ( $_GET['action'] ) {
			case 1:

				$post = DBRead( 'posts', "WHERE id = '{$id}'" );

				if( DBRead( 'categorias', "WHERE id = '". $post[0]['categoria'] ."'" ) )
					DBUpDate( 'posts', array('status' => 1), "id = '{$id}'" );
				else {
					header( 'Location: edit-post.php?id=' . $id . '&&changeCateg' );
					die;
				}

				break;

			case 2:
				DBUpDate( 'posts', array('status' => 0), "id = '{$id}'" );
				break;

			case 3:
				DBDelete( 'posts', "id = '{$id}'" );
				break;
		}

		header('Location: index.php');

	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Gerenciar Postagens</title>
</head>

<body>
    
	
	<h2>
		Gerenciar Postagens |
		<a href="categorias.php" title="Gerenciar Categorias">Gerenciar Categorias</a> |
		<a href="add-post.php" title="Adicionar">Adicionar</a>
	</h2>

	<?php

		$posts = DBRead( 'posts', 'ORDER BY data DESC' );

		if( !$posts )
			echo '<h2>Nenhuma postagem encontrada!</h2>';
		else
			foreach ( $posts as $post ):
				$categ = DBRead( 'categorias', "WHERE id = '". $post['categoria'] ."'" );
				$categ = ( $categ ) ? $categ[0]['titulo'] : 'SEM CATEGORIA';
	?>
	
	<hr>
	<h2>
		<?php echo $post['titulo']; ?>
	</h2>

	<p>
		por <b><?php echo $post['autor']; ?></b>
		em <b><?php echo date('d/m/Y', strtotime( $post['data'] )) ?></b> |
		<b><?php echo $categ; ?></b> |
		Visitas <b><?php echo $post['visitas']; ?></b>
	</p>

	<p>
		<?php

			if( !$post['status'] )
				echo '<a href="?action=1&&id='. $post['id'] .'" title="Ativar">Ativar</a> |';
			else
				echo '<a href="?action=2&&id='. $post['id'] .'" title="Desativar">Desativar</a> |';

		?>

		<a href="edit-post.php?id=<?php echo $post['id']; ?>" title="Editar">Editar</a> |
		<a href="?action=3&&id=<?php echo $post['id']; ?>" title="Deletar">Deletar</a>
	</p>
	<?php endforeach; ?>

</body>
</html>