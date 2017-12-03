<?php

	include("db.php");

	//Criação de sessão
		session_start();
		if(!isset($_SESSION['usuario'])){
			header("location: login.php");
		}
		else{
			$id = $_SESSION['id'];
			$user = $_SESSION['usuario'];
			$nome = mysqli_query ($conexao,"SELECT * FROM usuario WHERE id = $id");
			$linha = mysqli_fetch_array($nome);
			$name=$linha["nome"];
			$sname = $linha["sobrenome"];
		}

		//Criação da pasta com as imagens de perfil e painel
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$erro = false;
			if(!file_exists('usuarios/'.$user)){
				mkdir('usuarios/'.$user);
			}
			if(isset($_FILES['perfil'])){
				$nome_perfil= $_FILES['perfil']['name'];
				$nome_perfil="perfil.jpg";
				copy($_FILES['perfil']['tmp_name'],'usuarios/'.$user.'/'. $nome_perfil);
			}
			if(isset($_FILES['painel'])){
				$nome_painel= $_FILES['painel']['name'];
				$nome_painel="painel.jpg";
				copy($_FILES['painel']['tmp_name'],'usuarios/'.$user.'/'. $nome_painel);
			}
		}

		//Verificando acesso aos outros perfis
		if($_SERVER['REQUEST_METHOD']=="GET"){
			if(isset($_GET['user'])){
				$id = $_GET['id'];
				$nome = mysqli_query ($conexao,"SELECT * FROM usuario WHERE id = $id");
				$linha = mysqli_fetch_array($nome);
				$user = $linha["user"];
				$name = $linha["nome"];
				$sname = $linha["sobrenome"];
			}
		}else{
			$id = $_SESSION['id'];
			$user = $_SESSION['usuario'];
		}
	?>
	<!doctype html>
	<html>
		<head>
			<meta charset="utf-8"/>
			<link rel="stylesheet" href="./css/style.css"/>
			<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
			<script src="./js/jquery.min.js"></script>
			<script>
				$(function(){
					$(".perfil").attr("src","./usuarios/<?php echo $user?>/perfil.jpg");
					$(".painel").attr("src","./usuarios/<?php echo $user?>/painel.jpg");
					$(".aparecer").click(function(){
						$(".fotos").css("display","block");
						$("body :not(.exc)").css("filter","blur(15px)");
					});
					$(".enviar").click(function(){
						$(".fotos").css("display","none");
						$("body :not(.exc)").css("filter","none");
					});
					$(".exibir_amigos").click(function(){
						$(".amigos").css("display","block");
						$(".solicitacao").css("display","none");
					});
					$(".exibir_solicitacoes").click(function(){
						$(".solicitacao").css("display","block");
						$(".amigos").css("display","none");
					});
					$(".add").click(function(){
						$(this).text("AGUARDANDO");
					});
				})
			</script>
		</head>
		<body style="background-image: none;">
			<?php
			include("barra.php");
			if(isset($_SESSION['usuario'])){
			?>

			<img class="capa" src="./usuarios/<?php echo $user?>/painel.jpg" style="height: 350px; width: 100%;"/>
			<div class="info">
				<img src="./usuarios/<?php echo $user?>/perfil.jpg" class="perfil"/>
				<h1 class="nome"> <?php echo $name." ". $sname?></h1>
				<h4 class="nome"><?php echo $user?></h4>
				<?php
				//Verificação se está no perfil logado
				if($id == $_SESSION['id']){
			?>
				<button class="exibir_solicitacoes"> Solicitações </button>
				<a class="people" href="people.php">Pesssoas</a>
			<?php
				}
				else{
					$getId= $_GET['id'];
					$id_logado = $_SESSION['id'];
			?>
				<a class="back" href="http://localhost/socializer/home.php?id=<?php echo $id ?>"> Voltar </a>
			<?php
				$selecao = mysqli_query ($conexao,"SELECT count(*) FROM amizades
			WHERE de = $getId and para = $id_logado and aceite='sim' or aceite='nao' or de = $id_logado and para = $getId and aceite='sim' or aceite='nao'");
					$linha = mysqli_fetch_array($selecao);
					if($linha["count(*)"]==0){
			?>
				<a class="add" href="adicionar.php?user=<?php echo $getId;?>"> Adicionar</a>

			<?php
					}
				}
			?>
			<button class="exibir_amigos"> Amigos </button>

			</div>
			<div class="amigos">
				<?php
				//Vendo os amigos
				$selecao = mysqli_query ($conexao,"SELECT * FROM amizades
					WHERE de = $id or para = $id and aceite='sim' ORDER BY DESC");
				?>
					<h3 class="titulo"> Amigos:</h3>
				<?php
					while($linha = mysqli_fetch_array($selecao)){
						if($id == $linha["de"]){
							$convidado = $linha["para"];
							$descobrir =  mysqli_query ($conexao,"SELECT * FROM usuario
							WHERE id = $convidado");
							$amigo = mysqli_fetch_array($descobrir);

					?>

						<div class="friend">
							<p  class="amigo_nome"><strong><?php echo $amigo["nome"]." ".$amigo["sobrenome"];?></strong></p>
							<p  class="amigo_nome"> <?php echo $amigo["username"];?></p>
							<a  href="http://localhost/socializer/home.php?user=<?php echo $convidado ?>"><img src="./usuarios/<?php echo $amigo["username"]?>/painel.jpg" class="amigo_painel" id="<?php echo $convidado ?>"/></a>
							<a  href="http://localhost/socializer/home.php?user=<?php echo $convidado ?>"><img src="./usuarios/<?php echo $amigo["username"]?>/perfil.jpg" class="amigo_perfil" id="<?php echo $convidado ?>"/></a>
						</div>
					<?php
						}
						else{
							$convite = $linha["de"];
							$descobrir =  mysqli_query ($conexao,"SELECT * FROM usuario
							WHERE id = $convite");
							$amigo = mysqli_fetch_array($descobrir);
					?>
						<div class="friend">
							<p  class="amigo_nome"><strong> <?php echo $amigo["nome"]." ".$amigo["sobrenome"];?></strong></p>
							<p class="amigo_nome"> <?php echo $amigo["username"];?></p>
							<a  href="http://localhost/socializer/home.php?user=<?php echo $convite ?>"><img src="./usuarios/<?php echo $amigo["username"]?>/painel.jpg" class="amigo_painel" id="<?php echo $convite ?>"/></a>
							<a  href="http://localhost/socializer/home.php?user=<?php echo $convite ?>"><img src="./usuarios/<?php echo $amigo["username"]?>/perfil.jpg" class="amigo_perfil" id="<?php echo $convite ?>"/></a>
						</div>
					<?php
						}

					}
					?>
			</div>
			<div class="solicitacao">
			<?php
				//Verificação se está no perfil logado
				if($id == $_SESSION['id']){
				//Vendo as solicitações de amizade
			?>
				<h3 class="titulo"> Solicitações:</h3>
			<?php
				$selecao = mysqli_query ($conexao,"SELECT * FROM amizades
					WHERE de = $id and aceite='aguardo'");
					while($linha = mysqli_fetch_array($selecao)){
						$convite = $linha["de"];
						$descobrir =  mysqli_query ($conexao,"SELECT * FROM usuario
						WHERE id = $convite");
						$amigo = mysqli_fetch_array($descobrir);
					?>
					<div class="friend">
						<p class="amigo_nome"><strong><?php echo $amigo["nome"]." ".$amigo["sobrenome"];?></strong></p>
						<p class="amigo_nome"><?php echo $amigo["username"];?></p>
						<a  href="http://localhost/socializer/home.php?user=<?php echo $convite ?>"><img src="./usuarios/<?php echo $amigo["username"]?>/painel.jpg" class="amigo_painel" id="<?php echo $convite ?>"/></a>
						<a  href="http://localhost/socializer/home.php?user=<?php echo $convite ?>"><img src="./usuarios/<?php echo $amigo["username"]?>/perfil.jpg" class="amigo_perfil" id="<?php echo $convite ?>"/></a>
						<a class="aceitar" href="http://localhost/socializer/aceitar.php?user=<?php echo $amigo['id'] ?>"> Aceitar</a>
					</div>
					<?php
					}
					?>
			</div>
			<?php

			?>
				<button class="aparecer" style="top:350px;"> Trocar imagens </button>
				<form action="home.php" method="post" enctype="multipart/form-data" class="fotos exc">
					Escolha a foto de perfil<input name="perfil" type="file" value="Escolha a foto de perfil" class="exc"/><br>
					Escolha o painel<input name="painel" type="file" value="Escolha a foto de painel" class="exc"/><br>
					<input type="submit" class="enviar exc"/>
				</form>
			<?php
				}
			}
			else{
			?>
				<p> Você ainda não está cadastrado </p>
				<a href="login.php"> Fazer login </a>

			<?php

			}
			?>

		</body>
	</html>
