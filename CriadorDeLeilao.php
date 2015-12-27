<?php

require_once "Usuario.php";
require_once "Lance.php";
require_once "Leilao.php";

class CriadorDeLeilao {

    private $leilao;

    public function para($descricao) {
        $this->leilao = new Leilao($descricao);
        return $this;
    }

    public function lance(Usuario $usuario, $valor) {
        $this->leilao->propoe(new Lance($usuario, $valor));
        return $this;
    }

    public function constroi() { 
        return $this->leilao;
    }
}
?>