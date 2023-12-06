<?php
require_once('Connection.php');
class FiltraUsuario {
  /**
   * Retorna todos os usuarios cadastrados e filtra caso tenha valor o parametro
   */
  public function obterUsuarios($filtro_nome) {
    $getConnection = new Connection();
    $connection = $getConnection->getConexao();
    if($filtro_nome) {
      $sql = "SELECT nome_completo, email FROM pessoa WHERE nome_completo ILIKE $1";
      $parametros = array("%$filtro_nome%");
      $result = pg_query_params($connection, $sql, $parametros);
    }
    else {
      $sql = "SELECT nome_completo, email FROM pessoa";
      $result = pg_query($connection, $sql);
    }
    $usuarios = array();

    while ($row = pg_fetch_assoc($result)) {
      $usuarios[] = $row;
    }
    return $usuarios;
}
}
?>