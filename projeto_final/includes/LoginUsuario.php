<?php
  require_once('Connection.php');
  class LoginUsuario {
    /**
     * @param string $nome_completo
     * @param string $senha
     * Retorna se o usuário está no sistema
     */
    public function verificaCadastro($nome_completo, $senha) {
      $getConnection = new Connection();
      $connection = $getConnection->getConexao();
      if($connection) {
        $sql = "SELECT * FROM pessoa WHERE nome_completo = '$nome_completo'";
        $result = pg_query($connection, $sql);
        if ($result) {
          $row = pg_fetch_assoc($result);
          if($row) {
            if (password_verify($senha, $row['senha'])) {
              return true;
            }
          }
        }
      }
      return false;
    }  
  }
?>
