<?php
require_once __DIR__."/../class/calculadora.php";

class testCalculator extends PHPUnit_Framework_TestCase{

	public function testSoma(){
		$a = new Calculadora();

	        // Act
        	$b = $a->soma(1,2);

        	// Assert
 	       	$this->assertEquals(3, $b);
	}

	public function testSubtrai(){
		$a = new Calculadora();

	        // Act
        	$b = $a->subtrai(5,2);

        	// Assert
 	       	$this->assertEquals(3, $b);
	}

	public function testDivisao(){
		$a = new Calculadora();

	        // Act
        	$b = $a->divisao(8,2);

        	// Assert
 	       	$this->assertEquals(4, $b);
	}
	public function testMultiplicacao(){
		$a = new Calculadora();

	        // Act
        	$b = $a->multiplicacao(6,2);

        	// Assert
 	       	$this->assertEquals(12, $b);
	}
	public function testDivideZero(){
		$a = new Calculadora();

		$b = $a->divisao(0,0);

		$this->assertEquals(0, $b);
	}

}
?>
