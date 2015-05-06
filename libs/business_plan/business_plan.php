<?php

//require_once("fiscal_year.php");
use asketic\business_plan\FiscalYear as FiscalYear;

namespace asketic\business_plan;

class BusinessPlan {//extends exerciseFiscal {

  private $user;
  private $title;
  private $sector;
  private $locale = [];

  private $legalEntity;

  private $inversion_inicial; //Incluimos dentro la financiación inicial

  private $inversions = [];

  private $RRHH = [];

  public $exercises = [];

  public $results; //Va a ser un objeto de la clase resultados

  public function __construct($sector, $locale, $title){

    $this->title = $title;
    $this->sector = $sector;
    $this->locale = $locale;
  }

  public function setexercise($type, $year, $started){

    $this->exercises[$year] = new FiscalYear($type, $year, $started);
    //var_dump($this->exercises[$year]);

  }

  public function getexercise($year){

      //return $this->exercises;

    foreach($this->exercises as $exercise){
            if ($exercise->year == $year) return $exercise;
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
