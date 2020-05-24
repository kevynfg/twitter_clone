<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

    require_once('db.class.php');

    $id_usuario = $_SESSION['id_usuario'];
    $id_delete = $_POST['id_delete'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    
    $sql = " DELETE FROM tweet WHERE id_tweet = $id_delete AND id_usuario = $id_usuario ";

    $registro = mysqli_query($link, $sql);
    
    
    




?>