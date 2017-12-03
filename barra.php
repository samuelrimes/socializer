<?
include("db.php");
//Criação da SESSION
session_start();
if(!isset($_SESSION['usuario'])){
  header("location: login.php");
}
else{
  $id = $_SESSION['id'];
  $user = $_SESSION['usuario'];
  $nome = mysqli_query ($conexao,"SELECT * FROM usuario WHERE id = $id");
  $linha = mysqli_fetch_array($nome);
  $usuario =$linha["user"];
  $name=$linha["nome"];
  $sname = $linha["sobrenome"];
}
?>
<!doctype html>
<html>
  <head>
    <link href="file:///var/www/html/socializer/fonte/indieflower-demo.html" rel="font"/>
    <link rel="stylesheet" href="./css/barra.css">
    <script src="./js/jquery.min.js"></script>
    <script>

			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-5').removeClass('active');
				});

			});

		</script>
  </head>
  <?php

    $select = mysqli_query ($conexao,'SELECT user FROM usuario');
    $linha = mysqli_fetch_array($select);
    ?>
    <div class="topo">
      <a id="nome_site" href="http://localhost/socializer/home.php">SOCIALIZER</a>
      <section class="main" style="padding-top: 5px; padding-right: 20px;">
				<div class="wrapper-demo">
					<div id="dd" class="wrapper-dropdown-5" tabindex="1" style="padding-left: 6px; padding-bottom: 4px;padding-top: 4px;width: 100px;">
            <img src="./usuarios/<?php echo $user?>/perfil.jpg" style="width: 40px; border-radius:100%;">
						<ul class="dropdown">
							<li><a href="#"><i class="icon-user"></i>Profile</a></li>
							<li><a href="people.php"><i class="icon-cog"></i>Pessoas</a></li>
							<li><a href="logout.php"><i class="icon-remove"></i>Log out</a></li>
						</ul>
					</div>
				​</div>
			</section>
    </div>
  </body>
</html>
