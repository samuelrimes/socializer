<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="./css/people.css">
</head>
<body>
<?php
  include("db.php");
  include("barra.php");

  $select = mysqli_query ($conexao,'SELECT user,id,nome FROM usuario ORDER BY RAND() LIMIT 30');
  while($linha = mysqli_fetch_array($select)){
    $user = $linha['user'];
    $id = $linha['id'];
    ?><div class="perfil" ><a class="nome" href="localhost/socializer/home.php?id=<?php echo $id ?>"><img class="user" src="./usuarios/<?php echo $user?>/perfil.jpg"><?php echo  $user;?></a></div><?php

  }
?>
</body>
</html>
