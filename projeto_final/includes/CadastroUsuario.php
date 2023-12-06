<?php
  require_once('Connection.php');
  class CadastroUsuario {
    /**
     * @param string $nome
     * @param date $data_nascimento
     * @param string $email
     * @param string $senha
     * Função da qual cadastra usuário no banco de dados
     */
    public function cadastrarUsuario($nome, $data_nascimento, $email, $senha) {
      $getConnection = new Connection();
      $connection = $getConnection->getConexao();
      if($connection and $this->verificaUsuario($email)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO pessoa (nome_completo, data_nascimento, email, senha) VALUES ($1, $2, $3,$4)";
        $result = pg_query_params($connection, $sql, array($nome, $data_nascimento, $email, $senhaHash));
        if ($result) {
          header("Location: ../index.php");
        } else {
          echo "Erro ao cadastrar: " . pg_last_error($this->conexao);
        }
        pg_close($connection);
      }
    }

    /**
     * @param string $email
     * @return boolean
     * Funcao da qual verifica se o usuario ja existe no banco de dados
     */
    public function verificaUsuario($email) {
      $getConnection = new Connection();
      $connection = $getConnection->getConexao();
      if($connection) {
        $sql = "SELECT * FROM pessoa WHERE email = '$email'";
        $result = pg_query($connection, $sql);
        if(!pg_fetch_assoc($result)) {
          return true;
        }
        echo '
        <script>
          setTimeout(function() {
            alert("O usuário já existe no banco de dados!");
          }, 1);
          setTimeout(function() {
            window.location.href = "../index.php";
          }, 1);
        </script>';
      }
    }
  }
?>
