<?php
require "Usuario.php";
require "Lance.php";
require "Leilao.php";

class LeilaoTest extends PHPUnit_Framework_TestCase {

    public function testDeveReceberUmLance() {
        $leilao = new Leilao("Macbook Pro 15");
        $this->assertEquals(0, count($leilao->getLances()));

        $leilao->propoe(new Lance(new Usuario("Steve Jobs"), 2000));

        $this->assertEquals(1, count($leilao->getLances()));
		$array = $leilao->getLances();
        $this->assertEquals(2000, $array[0]->getValor(), 0.00001);
    }

    public function testDeveReceberVariosLances() {
        $leilao = new Leilao("Macbook Pro 15");
        $leilao->propoe(new Lance(new Usuario("Steve Jobs"), 2000));
        $leilao->propoe(new Lance(new Usuario("Steve Wozniak"), 3000));

        $this->assertEquals(2, count($leilao->getLances()));
		$array = $leilao->getLances();
        $this->assertEquals(2000, $array[0]->getValor(), 0.00001);
        $this->assertEquals(3000, $array[1]->getValor(), 0.00001);
    }
	
	public function testNaoDeveAceitarDoisLancesSeguidosDoMesmoUsuario() {
        $leilao = new Leilao("Macbook Pro 15");
        $steveJobs = new Usuario("Steve Jobs");

        $leilao->propoe(new Lance($steveJobs, 2000));
        $leilao->propoe(new Lance($steveJobs, 3000));

        $this->assertEquals(1, count($leilao->getLances()));
		$array = $leilao->getLances();
        $this->assertEquals(2000, $array[0]->getValor(), 0.00001);
    }
	public function testNaoDeveAceitarMaisDoQue5LancesDeUmMesmoUsuario() {
        $leilao = new Leilao("Macbook Pro 15");
        $steveJobs = new Usuario("Steve Jobs");
        $billGates = new Usuario("Bill Gates");

        $leilao->propoe(new Lance($steveJobs, 2000));
        $leilao->propoe(new Lance($billGates, 3000));
        $leilao->propoe(new Lance($steveJobs, 4000));
        $leilao->propoe(new Lance($billGates, 5000));
        $leilao->propoe(new Lance($steveJobs, 6000));
        $leilao->propoe(new Lance($billGates, 7000));
        $leilao->propoe(new Lance($steveJobs, 8000));
        $leilao->propoe(new Lance($billGates, 9000));
        $leilao->propoe(new Lance($steveJobs, 10000));
        $leilao->propoe(new Lance($billGates, 11000));

        // deve ser ignorado
        $leilao->propoe(new Lance($steveJobs, 12000));

        $this->assertEquals(10, count($leilao->getLances()));
        $ultimo = count($leilao->getLances()) - 1;
		$array = $leilao->getLances();
        $ultimoLance = $array[$ultimo];
        $this->assertEquals(11000.0, $ultimoLance->getValor(), 0.00001);
    }
	
	public function testDeveDobrarOUltimoLanceDado() {
        $leilao = new Leilao("Macbook Pro 15");
        $steveJobs = new Usuario("Steve Jobs");
        $billGates = new Usuario("Bill Gates");

        $leilao->propoe(new Lance($steveJobs, 2000));
        $leilao->propoe(new Lance($billGates, 3000));
        $leilao->dobraLance($steveJobs);
		$array = $leilao->getLances();
        $this->assertEquals(4000, $array[2]->getValor(), 0.00001);
    }
	 public function testNaoDeveDobrarCasoNaoHajaLanceAnterior() {
        $leilao = new Leilao("Macbook Pro 15");
        $steveJobs = new Usuario("Steve Jobs");

        $leilao->dobraLance($steveJobs);

        $this->assertEquals(0, count($leilao->getLances()));
    }
}
?>