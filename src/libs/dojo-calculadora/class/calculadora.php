<?php

class Calculadora{

/***************************************

OPERACIONES SIMPLES

***************************************/


	//Se pueden pasar varios sumandos a la vez
	public function suma($sumandos) {
		$total = (FLOAT)$total;
		$total = 0;
		foreach($sumandos as $sumando){

			$total = $total + (FLOAT)$sumando;

		}

		return $total;
	}

	public function resta($a,$b){
		return $a-$b;
	}

	public function division($a,$b){
		if ($b==0){
			return 0;
		} else {
			return $a/$b;
		}
	}
	//Se pueden pasar varios multiplicandos a la vez
	public function producto($multiplicandos){
		$total = (FLOAT)$total;
		$total = 1;
		foreach($multiplicandos as $multiplicando){

			$total = $total * (FLOAT)$multiplicando;

		}

		return $total;
	}

	public function porcentaje($numero, $porciento){

		// Solo porcentaje
		return $numero * $porciento / 100;

	}

}
