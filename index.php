<!doctype html>
<html lang = "pt-br">
	<head>
		<meta charset="utf-8"/>
		<link href="file:///var/www/html/socializer/fonte/indieflower-demo.html" rel="font"/>
		<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./css/default.css" />
		<link href="./css/hexaflip.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="./css/index.css">
		<title>Socializer</title>
		<script src="./js/jquery.js"></script>
		<script>
		</script>
	</head>
		<body>
			<div class ="header">
				<h1 id="logo">SOCIALIZER</h1>
				<div>
					<a class="entrar-cadastrar" id="cadastrar" href="cadastrar.php"> Cadastrar </a>
					<a class="entrar-cadastrar" id="entrar" href="login.php"> Entrar </a>
				</div>
			</div>
		<div class="container">

				<header class="clearfix">
						<h1>Coloque o código. <span>O código é "Azul, Vermelho, Violeta e Cinza"</span></h1>
				</header>
				<div class="main">
						<div id="hexaflip-demo5" class="demo" style="margin-bottom: 20px;"></div>
						<div>
								<span id="submit">Testar código</span>
								<div id="output"></div>
						</div>
				</div>
		</div>
		<div>
		</div>
		<script src="./js/hexaflip.js"></script>
		<script>
				var hexaDemo5,
						set = [
								{
										value: 'AGORA',
										style: {
												backgroundColor: '#e67e22'
										}
								},
								{
										value: 'É',
										style: {
												backgroundColor: '#008080'
										}
								},
								{
										value: 'COM',
										style: {
												backgroundColor: '#f1c40f'
										}
								},
								{
										value: 'VOCÊ!!',
										style: {
												backgroundColor: '#2ECC71'
										}
								},
								{
										value: 'BEM',
										style: {
												backgroundColor: '#3498DB'
										}
								},
								{
										value: 'VIN',
										style: {
												backgroundColor: '#E74C3C'
										}
								},
								{
										value: 'DO',
										style: {
												backgroundColor: '#9B59B6'
										}
								},
								{
										value: '!!',
										style: {
												backgroundColor: '#BDC3C7'
										}
								}
						];
				document.addEventListener('DOMContentLoaded', function(){
						var submit = document.getElementById('submit'),
								output = document.getElementById('output');
								hexaDemo5 = new HexaFlip(document.getElementById('hexaflip-demo5'),
								{set1: set, set2: set, set3: set, set4: set},
								{fontSize: 50, margin: 4, perspective: 1000}
						);
						submit.addEventListener('click', function(){
								if(hexaDemo5.getValue().join(' ') === 'BEM VIN DO !!'){
										output.innerHTML = 'Código correto!';
										hexaDemo5.flip();
										hexaDemo5.flip();
										hexaDemo5.flip();
										hexaDemo5.flip();
								}else{
										output.innerHTML = 'Código incorreto.';
								}
								if(hexaDemo5.getValue().join(' ') === 'AGORA É COM VOCÊ!!'){
									output.innerHTML = 'Códido correto!';

								}
						}, false);
				}, false);
		</script>
	</body>
</html>
