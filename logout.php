<?php
# Iniciar nova secao para quando sair nao continuar logado, pois os dados vao continuar conectados
  session_start();
# Destroi a secao
  session_destroy();
  header("Location: index.php");
?>
