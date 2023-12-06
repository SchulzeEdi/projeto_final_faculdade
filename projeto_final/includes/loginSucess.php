<?php
require_once('FiltraClientes.php');
session_start();

if(isset($_SESSION['nome'])) {
  $nome_usuario = $_SESSION['nome'];
  echo "Bem-vindo, $nome_usuario!";
}

/**
 * Retonar lista de clientes
 */
function obterClientes() {
  $filtraUsuario = new FiltraUsuario();
  $filtro_nome = isset($_POST['filtro_nome']) ? $_POST['filtro_nome'] : '';
  $clientes = $filtraUsuario->obterUsuarios($filtro_nome);
  return $clientes;
}
$usuarios = obterClientes();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/stylesLoginSucess.css" media="screen"/>
    <title>Lista de usuarios</title>
</head>
<body>
    <div class="lista-clientes-container">
    <h1>Lista de usuários</h1>
        <form action="loginSucess.php" method="POST">
            <label for="filtro_nome">Filtrar por Nome:</label>
            <input type="text" id="filtro_nome" name="filtro_nome">
            <button type="submit">Filtrar</button>
        </form>
      <?php if (!empty($usuarios)) : ?>
        <table style="border">
          <thead>
            <tr>
              <th>Nome Completo</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
              <tr>
                <td><?= $usuario['nome_completo']; ?></td>
                <td> <?= $usuario['email']; ?></td>                            
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>Nenhum cliente cadastrado.</p>
      <?php endif; ?>
    </div>
</body>
</html>