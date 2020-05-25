<?php
	session_start();

	if(!$_SESSION['usuario']){
		header('Location: index.php?erro=1');
	}

?>

<!DOCTYPE HTML>
<html lang="pt-br">
<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>

		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<script type="text/javascript">

			$(document).ready(function(){

				$('#btn_tweet').click(function(){

					if($('#texto_tweet').val().length > 0){

						$.ajax({

							url: 'inclui_tweet.php',

							method: 'POST',

							data: $('#form_tweet').serialize(),

							success: function(data){

								$('#texto_tweet').val('');
								
								atualizaTweet();
								refreshtweets();
								refreshseguidores();
							}

						});

					}

				});


				function atualizaTweet(){

					//carregar os tweets e deletar
					$.ajax({

						url: 'get_tweet.php',
						method: 'POST',
						success: function(data){

							//atribui os tweets para o elemento do html com ID tweets
							//o data é o que está vindo de get_tweet.php
							$('#tweets').html(data);

							//neste evento de click, já deleta na hora o post clicado
							$('.btn_deletar').click( function(){

							//esta variavel que coleta usando (this), serve para capturar o data-id_tweet="' . $registro['id_tweet'] . '"
							//do script get_tweet.php
							var id_tweet = $(this).data('id_tweet');

								$.ajax({
									url: 'deletar_tweet.php',
									method: 'post',

									//neste data, atribui o id_delete com o valor do id_tweet
									//capturado com o click no botão, onde está guardado o id do tweet
									data: { id_delete : id_tweet },
									success: function(data){
		
										alert(id_tweet);
										atualizaTweet();
										refreshtweets();
										refreshseguidores();

									} 
								});
							});

						}

					});

				}

				function refreshtweets(){

					$.ajax({
						url: 'atualiza_pag.php',
						success: function(data){
							$('#tweetadas').html(data);
							
						}
				 
					});
				}

				function refreshseguidores(){
					$.ajax({
						url: 'atualiza_seg.php',
						success: function(data){
							$('#seguidores').html(data);

						}
				 
					});
				}

				refreshseguidores();
				refreshtweets();
				atualizaTweet();

			});

		</script>

</head>

	<body>

		<!-- Static navbar -->
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<img src="imagens/icone_twitter.png" />
				</div>

				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="sair.php">Sair</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</nav>


		<div class="container">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div id="painel_usuario" name="painel_usuario" class="panel-body">
						<h4><?= $_SESSION['usuario'] ?></h4>
						<hr />
						<div id="tweetadas" name="tweetadas" class="col-md-6">
							
						</div>
						<div id="seguidores" name="seguidores" class="col-md-6">
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<form id="form_tweet" class="input-group">
							<input type="text" id="texto_tweet" name="texto_tweet" class="form-control" placeholder="O que você está pensando?" maxlength="140" />
							<span class="input-group-btn">
								<button class="btn btn-default" id="btn_tweet" type="button">Tweet</button>
							</span>
						</form>
					</div>
				</div>
				<div id="tweets" class="list-group">
					
				</div>
				
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4><a href="procurar_pessoas.php">Procurar por pessoas</a></h4>
					</div>
				</div>
			</div>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</body>
</html>