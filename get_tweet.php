<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

    require_once('db.class.php');

    $id_usuario = $_SESSION['id_usuario'];
    
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    

    //IMPORTANTE FAZER O SELECT NO BANCO DOS DADOS QUE VAI USAR
    $sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.tweet, u.usuario, t.id_tweet,u.id ";
    $sql.= " FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";
    $sql.= " WHERE id_usuario = $id_usuario ";

    //Selecione os tweets de usuários que você segue, com o OR(ou) id_usuario IN(dentro) e então é realizada uma subquery
    //para selecionar os posts dos usuários que você segue
    $sql.= " OR id_usuario IN (select seguindo_id_usuario from usuarios_seguidores where id_usuario = $id_usuario) ";
    $sql.= " ORDER BY data_inclusao DESC ";

    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){
    
        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

        echo '<a href="#" class="list-group-item">';
   
            echo '<h4 class="list-group-item-heading">' . $registro['usuario'] . ' <small> - ' . $registro['data_inclusao_formatada'] . '</small></h4>';
                
            echo '<p class="list-group-item-text">' . $registro['tweet'] . '</p>';
            
            //condição simples verificando se o ID logado é o ID do post
            //se sim ele faz display do button DELETE
            if($registro['id'] == $id_usuario){
                echo '<button type="button" "name="id_delete" id="btn_deletar_'.$registro['id_tweet'].'" style="display: block" class="btn btn-default btn_deletar" data-id_tweet="' . $registro['id_tweet'] . '">Deletar</button>';
            } else {
                echo '<button type="button" "name="id_delete" id="btn_deletar_'.$registro['id_tweet'].'" style="display: none" class="btn btn-default btn_deletar" data-id_tweet="' . $registro['id_tweet'] . '">Deletar</button>';
            }
        echo '</a>';
    }   
    }else {
    
        echo 'Erro na consulta de tweets no banco de dados!';

    }


?>