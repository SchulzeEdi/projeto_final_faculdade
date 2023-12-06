<?php
require_once('CadastroUsuario.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cadastro = new CadastroUsuario();

  $nome = $_POST["nome"];
  $data_nascimento = $_POST["data_nascimento"];
  $email = $_POST["email"];
  $senha = $_POST["senha"];
  $cadastro->cadastrarUsuario($nome, $data_nascimento, $email, $senha);
} else {
  header("Location: ../index.php");
  exit();
}
?>
