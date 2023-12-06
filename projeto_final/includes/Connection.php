<?php
  class Connection {
    /**
     * retorna conexão com banco de dados
     */
    public function getConexao() {
      return pg_connect("host=localhost port=5432 dbname=projeto user=local password=12345");
    }
  }
?>