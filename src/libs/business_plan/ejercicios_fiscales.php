<?php
namespace asketic\business_plan;

//se llama a registro desde aquí para que compra y venta la puedan extender
require_once("compra.php");
require_once("venta.php");
require_once("gasto.php");
require_once("inversion.php");
require_once("recurso_humano.php");

use asketic\business_plan\Compra as Compra;
use asketic\business_plan\Venta as Venta;

class EjercicioFiscal {

  private $started; //Mes de inicio. O PUEDE EMPEZAR CUALQUIER DIA DEL MES?

  public $year;

  public $type = "anual";

  public $meses = ["January" => 31, "February" => 28, "March" => 31, "April" => 30,
                    "May" => 31, "June" => 30, "July" => 31, "August" => 31, "September" => 30,
                    "October" => 31, "November" => 30, "December" => 31];

  //Datos que recoge el Plan General Contable por día. (contabilidad)
  //guardará un objeto por dia ¿¿O POR TRANSACCION MEJOR?? empezando por el primero del inicio fiscal
  //Cada objeto tiene atributos: codigo, descripcion, fecha, concepto, importe, unidades.
  public $compras = [];
  public $ventas = [];
  public $RRHH   = [];
  public $gastos = [];
  public $inversiones = []; //incluye la financiación, y la inversion en inmovilizado. Se invertir en cualquier momento.

  //Prueba con movimiento dentro de lo que sería dentro del ejercicio fiscal, para ver si gastos, ventas y demas se podrían
  //incluir en un único array, en vez de en varios
  public $movimientos = [];

  public function __construct($type, $year, $started = "August"){

    $this->type = $type;
    $this->year = $year;
    $this->started = $started;

    if($this->isFebruaryDays($this->year)){

       $this->meses["February"] = 29;

    }

    $this->prepareArrays();

  }

  private function prepareArrays(){

    //crear los indices de los arrays compras y ventas con el array meses,
    //para saber los dias de febrero y a futuro días festivos, etc...
    $count = 0;
    $init = null;
    foreach($this->meses as $key => $value){

      //necesito que empiece cuando sea igual al periodo y continue hasta el final.
      if($key == $this->started){
      	$this->movimientos[$key] = []; //Se prentende incluir aqui todos los movimientos (gastos, ventas, ...)
        $this->compras[$key] = [];
        $this->ventas[$key] = [];
        $this->RRHH[$key] = [];
        $this->gastos[$key] = [];// se le podría decir que sea de 31 posiciones?
        $init = $count;
      }elseif($init != null){
      	$this->movimientos[$key] = []; //Se prentende incluir aqui todos los movimientos (gastos, ventas, ...)
        $this->compras[$key] = [];
        $this->ventas[$key] = [];
        $this->RRHH[$key] = [];
        $this->gastos[$key] = [];
      }
      $count++;
    }

    foreach($this->meses as $key => $value){
      if($key != $init){
      	$this->movimientos[$key] = []; //Se prentende incluir aqui todos los movimientos (gastos, ventas, ...)
        $this->compras[$key] = [];
        $this->ventas[$key] = [];
        $this->RRHH[$key] = [];
        $this->gastos[$key] = [];
      }
    }


    foreach($this->meses as $mes => $days){

      for($i = 1; $i <= $days; $i++){
      	$this->movimientos[$mes][$i] = []; //Se prentende incluir aqui todos los movimientos (gastos, ventas, ...)
        $this->compras[$mes][$i] = [];
        $this->ventas[$mes][$i] = [];
        $this->gastos[$mes][$i] = [];
        $this->RRHH[$mes][$i] = [];

      }

    }

  }

  ////////////////////////////////////////////////////////////////////////


  //Guarda cada registro en el array del día, pasamos el codigo con un uno sumado
  public function setMovimiento($code, $var_array){

    extract($var_array);

    echo "$concept, $importe, $units, $wddx_tamaño\n";

  	$opcion=substr($code,0,1);

  	switch($opcion){

  		case "C"://compras
  			$movimiento = new Compra($code, $concept, $importe, $units);
  			break;
		  case "V"://ventas
  			$movimiento = new Venta($code, $concept, $importe, $units);
  			break;
  		case "G"://gasto
  			$movimiento = new Gasto($code, $concept, $importe, $units);
  			break;
  		case "I"://inversion
  			$movimiento = new Inversion($code, $concept, $importe, $units);
  			break;
  		case "R"://recurso humano
  			$movimiento = new RecursoHumano($code, $concept, $importe, $units);
  			break;
  	}

    $mes = $movimiento->date['month'];
   	$day = $movimiento->date['mday'];
    return $this->movimientos[$mes][$day][] = $movimiento;

  }

  //Antes getCompra
  public function getMovimiento($code){

  	//De nuevo, utilizamos el array de movimientos para intentar traer el elegido (compra, venta, gastos, ...)
  	foreach($this->movimientos as $month => $mes){
			    foreach($mes as $day => $dia){
			        foreach($dia as $registro ){
			        	if($code == $registro->code){
			        		return $registro;
			          	}
			        }
			    }
			}
	   return false;

  }


  //Devolvemos true si es bisiesto
  private function isFebruaryDays($year){

  	return ((($year%4 == 0) && ($year%100)) || $year%400 == 0)? true: false;
  	//return date('L', strtotime($date));
  }


}
