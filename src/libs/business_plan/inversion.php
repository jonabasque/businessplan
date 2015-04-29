<?php

namespace asketic\business_plan;

//require("registro.php");

class Inversion extends Movimiento{

  public function __construct($code, $concept, $imp, $units ){

    parent::__construct($code, $concept, $imp, $units );

    $this->code = $code;
    $this->date = getdate();
    $this->concept = $concept;
    $this->imp = $imp;
    $this->units = $units;

  }

}
