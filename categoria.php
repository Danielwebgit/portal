<<<<<<< Updated upstream


<?php

	require_once 'system/config.php';
	require_once 'system/database.php';

	if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) )
		header( 'Location: index.php' );
	else {

		$id 		= DBEscape( strip_tags( trim( $_GET['id'] ) ) );
		$categoria 	= DBRead( 'categorias', "WHERE id = '{$id}'" );

		if( !$categoria )
			header( 'Location: index.php' );
		else
			$categoria = $categoria[0];

	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
        
	<title><?php echo $categoria['titulo'] ?></title>
        <link rel="stylesheet" type="text/css" href="estilo/estilo.css" >
</head>

<body>
	
	<?php include 'menu.php'; ?>

	<h2><?php echo $categoria['titulo'] ?></h2>
	<p><?php echo $categoria['descricao'] ?></p>
	<hr>

	<?php

		$posts = DBRead( 'posts', "WHERE status = 1 AND categoria = '". $categoria['id'] ."' ORDER BY data DESC" );

		if( !$posts )
			echo '<h2>Nenhuma postagem encontrada!</h2>';
		else
			foreach ( $posts as $post ):
				$categ = DBRead( 'categorias', "WHERE id = '". $post['categoria'] ."'" );
				$categ = ( $categ ) ? $categ[0]['titulo'] : 'SEM CATEGORIA';
	?>

	<h2>
		<a href="single.php?id=<?php echo $post['id']; ?>" title="<?php echo $post['titulo']; ?>">
			<?php echo $post['titulo']; ?>
		</a>
	</h2>

	<p>
		por <b><?php echo $post['autor']; ?></b>
		em <b><?php echo date('d/m/Y', strtotime( $post['data'] )) ?></b> |
		<b><?php echo $categ; ?></b> |
		Visitas <b><?php echo $post['visitas']; ?></b>
	</p>

	<p>
		<?php

			$str = strip_tags( $post['conteudo'] );
			$len = strlen( $str );
			$max = 500;

			if( $len <= $max )
				echo $str;
			else
				echo substr( $str, 0, $max ) . '...';

		?>
	</p>
	<hr>

	<?php endforeach; ?>
	
</body>
=======


<?php

	require_once 'system/config.php';
	require_once 'system/database.php';

	if( !isset( $_GET['id'] ) || empty( $_GET['id'] ) )
		header( 'Location: index.php' );
	else {

		$id 		= DBEscape( strip_tags( trim( $_GET['id'] ) ) );
		$categoria 	= DBRead( 'categorias', "WHERE id = '{$id}'" );

		if( !$categoria )
			header( 'Location: index.php' );
		else
			$categoria = $categoria[0];

	}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
        
	<title><?php echo $categoria['titulo'] ?></title>
        <link rel="stylesheet" type="text/css" href="estilo/estilo.css" >
</head>

<body>
	
	<?php include 'menu.php'; ?>

	<h2><?php echo $categoria['titulo'] ?></h2>
	<p><?php echo $categoria['descricao'] ?></p>
	<hr>

	<?php

		$posts = DBRead( 'posts', "WHERE status = 1 AND categoria = '". $categoria['id'] ."' ORDER BY data DESC" );

		if( !$posts )
			echo '<h2>Nenhuma postagem encontrada!</h2>';
		else
			foreach ( $posts as $post ):
				$categ = DBRead( 'categorias', "WHERE id = '". $post['categoria'] ."'" );
				$categ = ( $categ ) ? $categ[0]['titulo'] : 'SEM CATEGORIA';
	?>

	<h2>
		<a href="single.php?id=<?php echo $post['id']; ?>" title="<?php echo $post['titulo']; ?>">
			<?php echo $post['titulo']; ?>
		</a>
	</h2>

	<p>
		por <b><?php echo $post['autor']; ?></b>
		em <b><?php echo date('d/m/Y', strtotime( $post['data'] )) ?></b> |
		<b><?php echo $categ; ?></b> |
		Visitas <b><?php echo $post['visitas']; ?></b>
	</p>

	<p>
		<?php

			$str = strip_tags( $post['conteudo'] );
			$len = strlen( $str );
			$max = 500;

			if( $len <= $max )
				echo $str;
			else
				echo substr( $str, 0, $max ) . '...';

		?>
	</p>
	<hr>

	<?php endforeach; ?>
	
</body>
>>>>>>> Stashed changes
</html>