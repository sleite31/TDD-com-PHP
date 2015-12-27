<?php
require "Usuario.php";
require "Lance.php";
require "Leilao.php";
require "FiltroDeLances.php";

class FiltroDeLancesTest extends PHPUnit_Framework_TestCase {

    public function testDeveSelecionarLancesEntre1000E3000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = array();
        $resultado[] = new Lance($joao,2000);
        $resultado[] = new Lance($joao,1000); 
        $resultado[] = new Lance($joao,3000); 
        $resultado[] = new Lance($joao,800); 

        $this->assertEquals(1, count($filtro->filtra($resultado)));
        $this->assertEquals(2000, $resultado[0]->getValor(), 0.00001);
    }

    public function testDeveSelecionarLancesEntre500E700() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = array();
        $resultado[] = new Lance($joao,600);
        $resultado[] = new Lance($joao,500); 
        $resultado[] = new Lance($joao,700); 
        $resultado[] = new Lance($joao,800); 

        $this->assertEquals(1, count($filtro->filtra($resultado)));
        $this->assertEquals(600, $resultado[0]->getValor(), 0.00001);
    }
	
	 public function testDeveSelecionarLancesMaiorde5000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
        $resultado = array();
        $resultado[] = new Lance($joao,6000);
        $resultado[] = new Lance($joao,500); 
        $resultado[] = new Lance($joao,700); 
        $resultado[] = new Lance($joao,800); 

        $this->assertEquals(1, count($filtro->filtra($resultado)));
        $this->assertEquals(6000, $resultado[0]->getValor(), 0.00001);
    }
	
	public function testDeveEliminarMenoresQue500() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
		$resultado = array();
        $resultado[] = new Lance($joao,400);
        $resultado[] = new Lance($joao,300);

        $this->assertEquals(0, count($filtro->filtra($resultado)));
    }

    public function testDeveEliminarEntre3000E5000() {
        $joao = new Usuario("Joao");

        $filtro = new FiltroDeLances();
		$resultado = array();
        $resultado[] = new Lance($joao,4000);
        $resultado[] = new Lance($joao,3500);

        $this->assertEquals(0,count($filtro->filtra($resultado)));
    }
}

?>