<?php

	require_once 'system/config.php';
	require_once 'system/database.php';
//sei la mano
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Sistema de Postagens</title>
         <link rel="stylesheet" type="text/css" href="estilo/estilo.css" >
</head>

<body>

    
    
  
    
    
    
	<?php

		include 'menu.php';

		$posts = DBRead( 'posts', "WHERE status = 1 ORDER BY data DESC" );

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
</html>