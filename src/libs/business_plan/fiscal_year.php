<?php
namespace asketic\business_plan;

//se llama a registro desde aquí para que compra y venta la puedan extender
require_once("purchase.php");
require_once("sale.php");
require_once("spending.php");
require_once("inversion.php");
require_once("human_resource.php");

use asketic\business_plan\Purchase as Purchase;
use asketic\business_plan\Sale as Sale;

class FiscalYear {

  private $started; //month de inicio. O PUEDE EMPEZAR CUALQUIER DIA DEL month?

  public $year;

  public $type = "anual";

  public $months = ["January" => 31, "February" => 28, "March" => 31, "April" => 30,
                    "May" => 31, "June" => 30, "July" => 31, "August" => 31, "September" => 30,
                    "October" => 31, "November" => 30, "December" => 31];

  //Datos que recoge el Plan General Contable por día. (contabilidad)
  //guardará un objeto por dia ¿¿O POR TRANSACCION MEJOR?? empezando por el primero del inicio fiscal
  //Cada objeto tiene atributos: codigo, descripcion, fecha, concepto, importe, unidades.
  public $purchases = [];
  public $ventas = [];
  public $RRHH   = [];
  public $gastos = [];
  public $inversiones = []; //incluye la financiación, y la inversion en inmovilizado. Se invertir en cualquier momento.

  //Prueba con Movement dentro de lo que sería dentro del ejercicio fiscal, para ver si gastos, ventas y demas se podrían
  //incluir en un único array, en vez de en varios
  public $Movements = [];

  public function __construct($type, $year, $started = "August"){

    $this->type = $type;
    $this->year = $year;
    $this->started = $started;

    if($this->isFebruaryDays($this->year)){

       $this->months["February"] = 29;

    }

    $this->prepareArrays();

  }

  private function prepareArrays(){

    //crear los indices de los arrays purchases y ventas con el array months,
    //para saber los dias de febrero y a futuro días festivos, etc...
    $count = 0;
    $init = null;
    foreach($this->months as $key => $value){

      //necesito que empiece cuando sea igual al periodo y continue hasta el final.
      if($key == $this->started){
      	$this->Movements[$key] = []; //Se prentende incluir aqui todos los Movements (gastos, ventas, ...)
        $this->purchases[$key] = [];
        $this->ventas[$key] = [];
        $this->RRHH[$key] = [];
        $this->gastos[$key] = [];// se le podría decir que sea de 31 posiciones?
        $init = $count;
      }elseif($init != null){
      	$this->Movements[$key] = []; //Se prentende incluir aqui todos los Movements (gastos, ventas, ...)
        $this->purchases[$key] = [];
        $this->ventas[$key] = [];
        $this->RRHH[$key] = [];
        $this->gastos[$key] = [];
      }
      $count++;
    }

    foreach($this->months as $key => $value){
      if($key != $init){
      	$this->Movements[$key] = []; //Se prentende incluir aqui todos los Movements (gastos, ventas, ...)
        $this->purchases[$key] = [];
        $this->ventas[$key] = [];
        $this->RRHH[$key] = [];
        $this->gastos[$key] = [];
      }
    }


    foreach($this->months as $month => $days){

      for($i = 1; $i <= $days; $i++){
      	$this->Movements[$month][$i] = []; //Se prentende incluir aqui todos los Movements (gastos, ventas, ...)
        $this->purchases[$month][$i] = [];
        $this->ventas[$month][$i] = [];
        $this->gastos[$month][$i] = [];
        $this->RRHH[$month][$i] = [];

      }

    }

  }

  ////////////////////////////////////////////////////////////////////////


  //Guarda cada registro en el array del día, pasamos el codigo con un uno sumado
  public function setMovement($code, $var_array){

    extract($var_array);

    echo "$concept, $importe, $units, $wddx_tamaño\n";

  	$opcion=substr($code,0,1);

  	switch($opcion){

  		case "C"://purchases
  			$Movement = new Purchase($code, $concept, $importe, $units);
  			break;
		  case "V"://ventas
  			$Movement = new Sale($code, $concept, $importe, $units);
  			break;
  		case "G"://gasto
  			$Movement = new Spending($code, $concept, $importe, $units);
  			break;
  		case "I"://inversion
  			$Movement = new Inversion($code, $concept, $importe, $units);
  			break;
  		case "R"://recurso humano
  			$Movement = new HUmanResource($code, $concept, $importe, $units);
  			break;
  	}

    $month = $Movement->date['month'];
   	$day = $Movement->date['mday'];
    return $this->Movements[$month][$day][] = $Movement;

  }

  //Antes getCompra
  public function getMovement($code){

  	//De nuevo, utilizamos el array de Movements para intentar traer el elegido (compra, venta, gastos, ...)
  	foreach($this->Movements as $month => $month){
			    foreach($month as $day => $dia){
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
