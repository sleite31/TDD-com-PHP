<?php

require "Avaliador.php";
require_once "CriadorDeLeilao.php";

class TesteDoAvaliador extends PHPUnit_Framework_TestCase  {
	
	 private $leiloeiro;
	 private $joao;
	 private $jose;
	 private $maria;
	 
	 public function setUp() {
        $this->leiloeiro = new Avaliador();
        $this->joao = new Usuario("João");
        $this->jose = new Usuario("José");
        $this->maria = new Usuario("Maria");
		var_dump("inicializando teste!");
    }
	
	public function tearDown() {
	  var_dump("fim");
	}
	
	public static function setUpBeforeClass() {
	  var_dump("before class");
	}
	
	public static function tearDownAfterClass() {
	  var_dump("after class");
	}

	public function testAceitaLeilaoEmOrdemCrescente() {

		$renan = new Usuario("Renan");
		$felipe = new Usuario("Felipe");

		$criador = new CriadorDeLeilao();
		
		$leilao = $criador->para("Playstation 3")
                ->lance($this->joao, 250)
                ->lance($renan,300)
                ->lance($felipe,400)
                ->constroi();
		
		$this->leiloeiro->avalia($leilao);

		$maiorEsperado = 400;
		$menorEsperado = 250;
		$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.00001);
        $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.00001);
		//$this->assertEquals(400, $leiloeiro->getMedia(), 0.0001);

	}
	public function testDeveEntenderLeilaoComLancesEmOrdemDecrescente() {

		
		$renan = new Usuario("Renan");
		$felipe = new Usuario("Felipe");
		$air = new Usuario("Air");

		$criador = new CriadorDeLeilao();
		
		$leilao = $criador->para("Playstation 3")
                ->lance($this->joao, 400)
                ->lance($renan,300)
                ->lance($felipe,200)
				->lance($air,100)
                ->constroi();
		
		$this->leiloeiro->avalia($leilao);

		$maiorEsperado = 400;
		$menorEsperado = 100;
		$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.00001);
        $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.00001);

	}
	public function testAceitaLeilaoEmOrdemCrescenteComOutrosValores() {

		
		$renan = new Usuario("Renan");
		$felipe = new Usuario("Felipe");

		$criador = new CriadorDeLeilao();
		
		$leilao = $criador->para("Playstation 3")
                ->lance($this->joao, 1000)
                ->lance($renan,2000)
                ->lance($felipe,3000)
                ->constroi();

		$this->leiloeiro->avalia($leilao);

		$maiorEsperado = 3000;
		$menorEsperado = 1000;

		$this->assertEquals($this->leiloeiro->getMaiorLance(),$maiorEsperado);
		$this->assertEquals($this->leiloeiro->getMenorLance(),$menorEsperado);

	}
	public function testDeveEntenderLeilaoComLancesEmOrdemRandomica() {
		
		$criador = new CriadorDeLeilao();
		
		$leilao = $criador->para("Playstation 3 Novo")
                ->lance($this->joao, 200)
                ->lance($this->maria,450)
                ->lance($this->joao,120)
				->lance($this->maria,700)
                ->lance($this->joao,630)
				->lance($this->maria,230)
                ->constroi();
		
		$this->leiloeiro->avalia($leilao);

		$this->assertEquals(700.0, $this->leiloeiro->getMaiorLance(), 0.0001);
		$this->assertEquals(120.0, $this->leiloeiro->getMenorLance(), 0.0001);
    }
	public function testAceitaLeilaoComUmLance() {

		$criador = new CriadorDeLeilao();
		
		$leilao = $criador->para("Playstation 3")
                ->lance($this->joao, 250)
                ->constroi();

		$leilao->propoe(new Lance($this->joao,250));

		
		$this->leiloeiro->avalia($leilao);

		$maiorEsperado = 250;
		$menorEsperado = 250;

		$this->assertEquals($this->leiloeiro->getMaiorLance(),$maiorEsperado);
		$this->assertEquals($this->leiloeiro->getMenorLance(),$menorEsperado);
	}
	public function testPegaOsTresMaiores() {
		
		$renan = new Usuario("Renan");
		$felipe = new Usuario("Felipe");
		$air = new Usuario("Air");

		$criador = new CriadorDeLeilao();
		
		$leilao = $criador->para("Playstation 3 Novo")
                ->lance($this->joao, 250)
                ->lance($renan, 300)
                ->lance($felipe, 400)
				->lance($air, 100)
                ->lance($this->maria, 500)
                ->constroi();
		
		$this->leiloeiro->avalia($leilao);

		$maiores = $this->leiloeiro->getTresMaiores();

		$this->assertEquals(3, count($maiores));
	    $this->assertEquals(500, $maiores[0]->getValor());
		$this->assertEquals(400, $maiores[1]->getValor());
		$this->assertEquals(300, $maiores[2]->getValor());

	}
	public function testPegaOsDoisLances() {

		
		$renan = new Usuario("Renan");

		$criador = new CriadorDeLeilao();
		
		$leilao = $criador->para("Playstation 3")
                ->lance($this->joao, 250)
                ->lance($renan, 300)
                ->constroi();

		$this->leiloeiro->avalia($leilao);

		$maiores = $this->leiloeiro->getTresMaiores();

		$this->assertEquals(2, count($maiores));
	    $this->assertEquals(300, $maiores[0]->getValor());
		$this->assertEquals(250, $maiores[1]->getValor());

	}
	/**
     * @expectedException     Exception
     */
	public function testSemLances() {

		$criador = new CriadorDeLeilao();
		$leilao = $criador->para("Playstation 3")
			->constroi();
		$this->leiloeiro->avalia($leilao);
	}
}

?>