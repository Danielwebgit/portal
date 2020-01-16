

<nav>

</nav>

<?php

	require_once '../system/config.php';
	require_once '../system/database.php';
        
  
	if( isset( $_GET['delete'] ) && !empty( $_GET['delete'] ) ){

		$id 	= DBEscape( strip_tags( trim( $_GET['delete'] ) ) );
		$exist	= DBRead( 'categorias', "WHERE id = '{$id}'" );

		if( $exist ){

			if( DBRead( 'posts', "WHERE categoria = '{$id}'" ) )
				DBUpDate( 'posts', array( 'status' => 0 ), "categoria = '{$id}'" );

			DBDelete( 'categorias', "id = '{$id}'" );

		}

		header( 'Location: categorias.php' );

	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Gerenciar Categorias</title>
</head>

<body>
	
	<h2>
		Gerenciar Categorias |
		<a href="index.php" title="Gerenciar Postagens">Gerenciar Postagens</a> |
		<a href="add-categ.php" title="Adicionar Categoria">Adicionar Categoria</a>
	</h2>
	
	<?php

		$categorias = DBRead( 'categorias', 'ORDER BY data DESC' );

		if( !$categorias )
			echo '<h2>Nenhuma categoria cadastrada!</h2>';
		else
			foreach( $categorias as $categ ):
				$posts = DBRead( 'posts', "WHERE categoria = '". $categ['id'] ."'" );
				$posts = ( !$posts ) ? 0 : count( $posts );

	?>
	<hr>
	<h2><?php echo $categ['titulo'] . ' ['. $posts .']'; ?></h2>
	<p>
		<?php

			$str = strip_tags( $categ['descricao'] );
			$len = strlen( $str );
			$max = 500;

			if( $len <= $max )
				echo $str;
			else
				echo substr( $str, 0, $max ) . '...';

		?>
	</p>
	
	<b><?php echo date( 'd/m/Y', strtotime( $categ['data'] ) ); ?></b> |
	<a href="edit-categ.php?id=<?php echo $categ['id']; ?>" title="Editar">Editar</a> |
	<a href="?delete=<?php echo $categ['id']; ?>" title="Deletar">Deletar</a>
	<?php endforeach; ?>

</body>
</html>