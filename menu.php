<link rel="stylesheet" type="text/css" href="estilo/estilo.css" >

    
    
    
    
    <?php
	
	require_once 'system/config.php';
	require_once 'system/database.php';

	$categorias = DBRead('categorias', 'ORDER BY data DESC' );

	if( $categorias ) {

		foreach ( $categorias as $categ ) {

			if( DBRead( 'posts', 'WHERE status = 1 AND categoria = '. $categ['id'] ) )
				$menu[] = '<a href="categoria.php?id='. $categ['id'] .'" title="'. $categ['titulo'] .'">'. $categ['titulo'] .'</a>';
		
		}

		echo implode( ' | ', $menu );

	}
      ?>  
         