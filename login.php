<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="./css/login.css"/>
		<link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway" rel="stylesheet">
		<script src="./js/jquery.min.js"></script>
	</head>
	<body>
	<?php
		if($_SERVER['REQUEST_METHOD']=="POST"){

			$username = $_POST['user'];
			$email = $_POST['email'];
			$passw = $_POST['senha'];

			include("db.php");
		// Verificação para certificar que o usuario está cadastrado
			$select = mysqli_query ($conexao,'SELECT * FROM usuario');
			$passw = hash("sha512",$passw);
				while($linha = mysqli_fetch_array($select)){
					if($linha["email"] == $username || $linha["user"] == $username && $linha["senha"] == $passw){
						$c = true;
						$id = $linha["email"];
						$username = $linha["user"];
						break;
					}
				}
				if($c == true){
					if(isset($_SESSION['usuario'])){
						//session_destroy();
						session_start();
						$_SESSION['id'] = $id;
						$_SESSION['usuario'] = $username;
						print_r($_SESSION['usuario[1]']);
						//header ("Location: home.php");
					}
					else{
						session_start();
						$_SESSION['id'] = $id;
						$_SESSION['usuario'] = $username;
						$iduser = $linha['id'];
						header ("Location: home.php?id=".$iduser);
						exit();
					}
				}
				else{
					header ("Location: erro.php");
					exit();
				}
		}
	?>
		<h1> Entrar </h1>

		<?php
			session_start();
			if(!isset($_SESSION['usuario'])){
		?>
		<div class="login">

				<form method="post">
					<input name='user' placeholder="Email/User" type="text"/><br/>
					<input name= 'senha' placeholder="Senha" type="password"/><br/>
					<input class="sub" type="submit" name="Entrar" id="entrar"/><br/>
				</form>
				<div class="botao">
					<a class="entrar-cadastrar"  href="cadastrar.php"> Cadastre-se </a>
				</div>

		</div>
		<?php
		}
		else{
			$usuario = $_SESSION['usuario'];
			echo "Você já está cadastrado como $usuario <br/>";
		}
		?>
	</body>
</html>
