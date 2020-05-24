<?php

    session_start();

    if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

    require_once('db.class.php');

    $nome_pessoa = $_POST['nome_pessoa'];
    $id_usuario = $_SESSION['id_usuario'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();
    
    $sql = " SELECT u.*, us.* ";
    $sql.= " FROM usuarios as u ";
    $sql.= " LEFT JOIN usuarios_seguidores AS us ";
    $sql.= " ON (us.id_usuario = $id_usuario AND u.id = us.seguindo_id_usuario) ";
    $sql.= " WHERE u.usuario like '%$nome_pessoa%' AND u.id <> $id_usuario ";




    $resultado_id = mysqli_query($link, $sql);

    if($resultado_id){

        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){

            echo '<a href="#" class="list-group-item">';

                echo '<strong>' . $registro['usuario'] . '</strong> <small> - ' . $registro['email'] . ' </small>';

                echo '<p class="list-group-item-text pull-right">';

                    //cria uma variável para verificar se o registro com id do usuario tem algo e(&&) não está vazio = se S(sim) ou N(nao)
                    $esta_seguindo_usuario_sn = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';

                    //transforma o display dos buttons em variável para poder modifica-las com condições,
                    $btn_seguir_display = 'block';
                    $btn_deixar_seguir_display = 'block';

                    //dependendo da resposta da condição ternária acima, exibe os buttons abaixo, etc
                    if($esta_seguindo_usuario_sn == 'N'){
                        $btn_deixar_seguir_display = 'none';
                    } else {
                        $btn_seguir_display = 'none';
                    }

                    //Quando ocultar um button, todos os usuários vão ser afetados pelo display:none
                    //Porém para diferenciar um button oculto de todos os usuários, deve-se
                    //concatenar o id do usuário que é único, com o button, abaixo: btn_seguir_'.$registro['id'].'
                    echo '<button type="button" id="btn_seguir_'.$registro['id'].'" style="display:'.$btn_seguir_display.'" class="btn btn-default btn_seguir" data-id_usuario="' . $registro['id'] . '">Seguir</button>';
                    echo '<button type="button" id="btn_deixar_seguir_'.$registro['id'].'" style="display:'.$btn_deixar_seguir_display.'" class="btn btn-primary btn_deixar_seguir" data-id_usuario="' . $registro['id'] . '">Deixar de Seguir</button>';

                echo '</p>';

                echo '<div class="clearfix"></div>';

            echo '</a>';

        }

    }else{
    
        echo 'Erro na consulta de usuários no banco de dados!';

    }

?>