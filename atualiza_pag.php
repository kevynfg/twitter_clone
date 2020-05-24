<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
    }
    
    require_once('db.class.php');

	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$id_usuario = $_SESSION['id_usuario'];

	//qtde de tweets
	$sql = " SELECT COUNT(*) AS qtde_tweets FROM tweet WHERE id_usuario = $id_usuario ";
	$resultado_id = mysqli_query($link, $sql);

	$qtde_tweets = 0;

	if($resultado_id){
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
        $qtde_tweets = $registro['qtde_tweets'];
			echo 'TWEETS <br />' .$qtde_tweets;
			
	} else {
		echo 'Erro no banco de dados';
	}
?>