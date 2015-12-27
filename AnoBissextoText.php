<?php

require "AnoBissexto.php";

class LeilaoTest extends PHPUnit_Framework_TestCase {
	public function testAnoBissexto() {
		$ano = new AnoBissexto();
		$this->assertEquals(false, $ano->ehBissexto(2015));
	}	
}

?>