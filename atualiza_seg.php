<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
    }
    
    require_once('db.class.php');

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];

	//qtde de seguidores
	$sql = " SELECT COUNT(*) AS qtde_seguidores FROM usuarios_seguidores WHERE id_usuario = $id_usuario ";
	$resultado_id = mysqli_query($link, $sql);

	$qtde_seguidores = 0;

	if($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		$qtde_seguidores = $registro['qtde_seguidores'];
			echo 'SEGUIDORES <br />'.$qtde_seguidores;
		
		
	} else {
		echo 'Erro no banco de dados';
    }
    
?>