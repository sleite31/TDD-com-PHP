<?php
require_once "Usuario.php";
require_once "Lance.php";
class LanceTest extends PHPUnit_Framework_TestCase {
	/**
     * @expectedException     InvalidArgumentException
     */
	public function testValorLance0(){
		$steveJobs = new Usuario("Steve Jobs");
		$lance = new Lance($steveJobs,0);
	}
	/**
     * @expectedException     InvalidArgumentException
     */
	public function testValorNegativo(){
		$steveJobs = new Usuario("Steve Jobs");
		$lance = new Lance($steveJobs,-7);
	}
}

?>