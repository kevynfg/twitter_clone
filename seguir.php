<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

    require_once('db.class.php');

    $id_usuario = $_SESSION['id_usuario'];
    $seguir_id_usuario = $_POST['seguir_id_usuario'];

    if($id_usuario == '' || $seguir_id_usuario == ''){
        echo 'Usuário não existe ou você já segue ele!';
        die();
    }

    $objDb = new db();
    $link = $objDb->conecta_mysql();
    
    $sql = "INSERT INTO usuarios_seguidores (id_usuario, seguindo_id_usuario) VALUES ($id_usuario, $seguir_id_usuario)";

    mysqli_query($link, $sql);

?>