<?php

namespace asketic\business_plan;

class Movimiento{

  private $id;
  public $date;
  private $concept;
  private $imp;
  public $units;

  public function __construct($concept, $imp, $units){

    $this->date = getdate();
    $this->concept = $concept;
    $this->imp = $imp;
    $this->units = $units;

  }

  //Actualizar la fecha del movimiento
  public function updateDate($date){

      $timestamp = mktime(0,0,0,$month,$day,$year);

    return $date = getdate($timestamp);
  }

}
