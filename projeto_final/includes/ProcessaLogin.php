<?php
require_once('LoginUsuario.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = new LoginUsuario();
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    $cadastrado = $login->verificaCadastro($nome, $senha);

    if ($cadastrado) {
      $_SESSION['nome'] = $nome;
      header("Location: loginSucess.php");
      exit();  
    } else {
      echo "Login falhou. Verifique suas credenciais.";
    }
}
?>
