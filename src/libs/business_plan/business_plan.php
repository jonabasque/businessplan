<?php

//require_once("ejercicios_fiscales.php");
use asketic\business_plan\User as User;
use asketic\business_plan\EjercicioFiscal as EjercicioFiscal;

namespace asketic\business_plan;

class BusinessPlan {//extends EjercicioFiscal {

  private $user;
  private $title;
  private $sector;
  private $locale = [];

  private $legalEntity;

  private $inversion_inicial; //Incluimos dentro la financiación inicial

  private $inversiones = [];

  private $RRHH = [];

  public $ejercicios = [];

  public $resultados; //Va a ser un objeto de la clase resultados

  public function __construct(User $user, $sector, $locale, $title){

    $this->user = $user;
    $this->title = $title;
    $this->sector = $sector;
    $this->locale = $locale;
  }

  public function setEjercicio($type, $year, $started){

    $this->ejercicios[$year] = new EjercicioFiscal($type, $year, $started);
    //var_dump($this->ejercicios[$year]);

  }

  public function getEjercicio($year){

      //return $this->ejercicios;

    foreach($this->ejercicios as $ejercicio){
            if ($ejercicio->year == $year) return $ejercicio;
      }

  return false;

  }

  public function getTitle(){

    return $this->title;

  }

  public function getSector(){

    return $this->sector;

  }

}//fin clase BusinessPlan


//clase usuario
class User {

	public $nombre;

	public function __construct($nombre = "John Doe"){

		$this->nombre = $nombre;

	}

}//fin clase User
