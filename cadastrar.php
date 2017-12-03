<?php
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$c = false;
			$flag = array();
			$nome = trim($_POST['nome']);
			$snome = trim($_POST['snome']);
			$email = trim($_POST['email']);
			$cemail = trim($_POST['cemail']);
			$username = trim($_POST['user']);
			$pass = trim($_POST['senha']);
			$cpass = trim($_POST['csenha']);

			include("db.php");

			// Verficação de cadastro
			//nome
			if ($nome == ''){
				$flag[0] = "true";
			}
			//sobrenome
			if ($snome == ""){
				$flag[1] = 'true';
			}
			//email
			if (filter_var($email,FILTER_VALIDATE_EMAIL) == false){
				$flag[2] = 'true';
			}
			// Confirmacao de email
			if (filter_var($cemail,FILTER_VALIDATE_EMAIL) == false){
				$flag[3] = 'true';
			}
			// senha
			if ($pass == '' and strlen($pass) >= 5 and strlen($pass) <= 20){
				$flag[5] = 'true';
			}
			//Confirmacao de senha
			if ($cpass == '' and strlen($pass) >= 5 and strlen($pass) <= 20) {
				$flag[6] = 'true';
			}
			//sexo
			if (isset($_POST['sexo'])){
				$sexo = $_POST['sexo'];
				} else {
				$flag[7] = "true";
			}

			// Verificação de senha e email, verficação de banco
			if($pass == $cpass && $email == $cemail){
				$select = mysqli_query ($conexao,'SELECT * FROM usuario');

				while($linha = mysqli_fetch_array($select)){
					if($linha["user"] == $username){
						$flag[4] = "true";
						break;
					}
				}
				// Sem erro
				if($c == false){
					$select = mysqli_query ($conexao,'SELECT id,email FROM usuario');
					$linha = mysqli_fetch_array($select);

					$newcod = $linha["id"]+1;
					$pass = hash("sha512",$pass);
					//insere dados no Banco de Dados
					$sql ="INSERT INTO usuario(id,email,nome,sobrenome,user,senha,sexo) VALUES ($newcod,'$email','$nome','$snome','$username','$pass','$sexo')";
					if(mysqli_query($conexao, $sql)){
						header ("Location: login.php");
					}
					// Mantém na página caso haja erro
					}
					if($flag[4] == true){
						echo "Usuario ". $username ." ja cadastrado";
					}
					else{
						echo"Email ". $email ." esta cadastrado";
					}
				}
				else{
					echo "Confirmacao de email ou senha incorreta";
			}
	}
	?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="./css/cadastrar.css"/>
		<link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway" rel="stylesheet">
		<script src="./js/jquery.min.js"></script>

	</head>
	<body>
		<h1> Cadastrar </h1>
		<div class="cadastro">
			<form method="post">
				<input name="nome" placeholder="Nome" type="text" required><br/>
				<input name="snome" placeholder="Sobrenome" type="text" required/><br/>
				<input name="email" placeholder="Email" type="email" required/><br/>
				<input name="cemail" placeholder="Confimação de email" type="email" required/><br/>
				<input name="user" placeholder="Username" type="text" minlength="5" required/><br/>
				<input name="senha" placeholder="Senha" type="password" maxlength="20" required/><br/>
				<input name="csenha" placeholder="Confirmação de senha" type="password" maxlength="20" required/><br/>
				Masculino<br/><input type="radio" name="sexo" value="M" required><br/>
				Feminino<br/><input type="radio" name="sexo" value="F" required> <br/>
				Outro<br/><input type="radio" name="sexo" value="O" required> <br/>

				<input class="sub" type="submit" value="Cadastrar"/><br/>
				<div class="botao">
					<a class="entrar-cadastrar" href="login.php"> Entrar </a>
				</div>
			</form>
		</div>
	</body>
</html>
