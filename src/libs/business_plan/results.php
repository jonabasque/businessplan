<?php

namespace asketic\business_plan;

class Results {

  public function __construct(){

  }

  //extraemos del array el total de un dia en particular, $date contendra una variable llamada $day, que sera integer,
  //otra llamada $month, de tipo string y otra llamada $exercise e tipo string
  public function totalDay($date,$type,$businessPlan){//FUNCIONA
      //sacamos del array los indices $day, $month y $exercise
      extract($date);

      //convierto el indice del exercise fiscal de cadena a entero
      $exercise=(int)$exercise;

      //recogemos el objeto del exercise pedido
      $exercise = $businessPlan->getexercise($exercise);

      //recogemos el mes pedido (todo el contenido)
      $mes = $exercise->Movements[$month];

      //recogemos el dia pedido (todo el contenido)
      $dia = $mes[$day];

      //preparamaos la variable del total inicializandola a cero
      $total=0;

      //recorremos el array del día y vamos adquiriendo el importe total
      foreach($dia as $Movement){

        //Si el tipo es nulo, se hace la suma de todos los Movements de ese día
        if($type==NULL){

          $total = $total + $Movement->imp;

        }else{//Si se ha establecido un tipo, sumar sólo los de ese tipo

          //Recogemos del código y el tipo sólo la primera letra, y la pasamos a mayúscula
          $code = strtoupper(substr($Movement->code,0,1));
          $type = strtoupper(substr($type,0,1));

          //Si la letra extraida coincide con el tipo de Movement
          if($code==$type){
            $total = $total + $Movement->imp;
          }
 
        }
        
      }

      return $total;

  }

  public function totalMonth($date,$type,$businessPlan){//FUNCIONA

      //sacamos del array los indices $day, $month y $exercise
      extract($date);

      //convierto el indice del exercise fiscal de cadena a entero
      $exercise=(int)$exercise;

      //recogemos el objeto del exercise pedido
      $exercise = $businessPlan->getexercise($exercise);

      //recogemos el mes pedido (todo el contenido)
      $mes = $exercise->Movements[$month];

      //recogemos el dia pedido (todo el contenido)
      $dia = $mes[$day];

      //preparamaos la variable del total inicializandola a cero
      $total=0;

      //Se recorren todos los días del mes pedido
      foreach($mes as $day){

        //recorremos el array del día y vamos adquiriendo el importe total
        foreach($day as $Movement){

          if($type==NULL){

            $total = $total + $Movement->imp;

          }else{

            //Recogemos del código y el tipo sólo la primera letra, y la pasamos a mayúscula
            $code = strtoupper(substr($Movement->code,0,1));
            $type = strtoupper(substr($type,0,1));

            //Si la letra extraida coincide con el tipo de Movement
            if($code==$type){
              $total = $total + $Movement->imp;
            }
   
          }
          
        }

      }

      return $total;

  }

  public function totalExercise($date,$type,$businessPlan){//FUNCIONA

      //sacamos del array los indices $day, $month y $exercise
      extract($date);

      //convierto el indice del exercise fiscal de cadena a entero
      $exercise=(int)$exercise;

      //recogemos el objeto del exercise pedido
      $exercise = $businessPlan->getexercise($exercise);

      //recogemos el mes pedido (todo el contenido)
      $mes = $exercise->Movements[$month];

      //recogemos el dia pedido (todo el contenido)
      $dia = $mes[$day];

      //preparamaos la variable del total inicializandola a cero
      $total=0;

      //recorremos todos los meses del exercise pedido
      foreach($exercise->Movements as $mes){

        //recorremos todos los días del mes pedido
        foreach($mes as $day){

          //recorremos el array del día y vamos adquiriendo el importe total
          foreach($day as $Movement){

            if($type==NULL){

              $total = $total + $Movement->imp;

            }else{

              //Recogemos del código y el tipo sólo la primera letra, y la pasamos a mayúscula
              $code = strtoupper(substr($Movement->code,0,1));
              $type = strtoupper(substr($type,0,1));

              //Si la letra extraida coincide con el tipo de Movement
              if($code==$type){
                $total = $total + $Movement->imp;
              }
     
            }
            
          }

        }

      }

      return $total;

  }

  //los indices de la segunda fecha deberan terminar con "_end". El intervalo podrá abarcar exercises fiscales
  public function totalInterval($date_ini,$date_end,$type,$businessplan){

      //sacamos del array los indices $day, $month y $exercise
      extract($date_ini);

      //recogemos el objeto del exercise pedido
      $exercise_ini = $businessplan->getexercise($exercise);

      //recogemos el mes pedido
      $mes_ini = $month;

      //recogemos el dia pedido
      $dia_ini = $day;

      //sacamos del array los indices $day, $month y $exercise
      extract($date_end);

      //recogemos el objeto del exercise pedido
      $exercise_end = $businessplan->getexercise($exercise);

      //recogemos el mes pedido
      $mes_end = $month;

      //recogemos el dia pedido
      $dia_end = $day;

      //preparamaos la variable del total inicializandola a cero
      $total=0;

      //recorremos los exercises fiscales del plan de negocio
      foreach($businessplan->exercises as $exercise){

        //Acotamos el intervalo por el año fiscal (para no tener que cargar todos los exercises fiscales)
        if(($exercise->year >= $exercise_ini->year)&&($exercise->year <= $exercise_end->year)){

          //recorremos los exercises fiscales, fijandonos en los meses
          foreach($exercise->Movements as $mes){

            if(($exercise->year >= $exercise_ini->year)||($mes <= $mes_ini)||($mes >= $mes_fin)||($exercise->year <= $exercise_fin->year)){

              //recorremos todos los dias de un mes
              foreach($mes as $dia){

                if(($exercise->year >= $exercise_ini->year)||($dia <= $dia_ini)||($dia >= $dia_fin)||($exercise->year <= $exercise_fin->year)){

                  //recorremos todos los Movements de un dia
                  foreach($dia as $Movement){

                    if($type==NULL){

                      $total = $total + $Movement->imp;

                    }else{

                      //Recogemos del código y el tipo sólo la primera letra, y la pasamos a mayúscula
                      $code = strtoupper(substr($Movement->code,0,1));
                      $type = strtoupper(substr($type,0,1));

                      //Si la letra extraida coincide con el tipo de Movement
                      if($code==$type){
                        $total = $total + $Movement->imp;
                      }
             
                    }//fin if

                    var_dump($Movement->imp);
                    echo "<br><br>";

                  }//fin foreach

                }//fin if

              }//fin foreach

            }//fin if

          }//fin foreach

        }//fin if

      }//fin foreach

      return $total;

  }

  public function totalBusinessPlan($date,$type,$businessPlan){//FUNCIONA

      //sacamos del array los indices $day, $month y $exercise
      extract($date);

      //convierto el indice del exercise fiscal de cadena a entero
      $exercise=(int)$exercise;

      //recogemos el objeto del exercise pedido
      $exercise = $businessPlan->getexercise($exercise);

      //recogemos el mes pedido (todo el contenido)
      $mes = $exercise->Movements[$month];

      //recogemos el dia pedido (todo el contenido)
      $dia = $mes[$day];

      //preparamaos la variable del total inicializandola a cero
      $total=0;
      
      foreach($businessplan->exercises as $exercise){

        //recorremos todos los meses del exercise pedido
        foreach($exercise->Movements as $mes){

          //recorremos todos los días del mes pedido
          foreach($mes as $day){

            //recorremos el array del día y vamos adquiriendo el importe total
            foreach($day as $Movement){

              if($type==NULL){

                $total = $total + $Movement->imp;

              }else{

                //Recogemos del código y el tipo sólo la primera letra, y la pasamos a mayúscula
                $code = strtoupper(substr($Movement->code,0,1));
                $type = strtoupper(substr($type,0,1));

                //Si la letra extraida coincide con el tipo de Movement
                if($code==$type){
                  $total = $total + $Movement->imp;
                }
       
              }
              
            }

          }

        }

      }

      return $total;

  }

  //en el primer parametro vendra el valor concreto y el tipo de valor (day, month, exercise, interval o bp)
  public function intervalFinder($interval, $intervaltype, $businessplan){

      switch($intervalType){

        case "day":

        

            break;

        case "month":



            break;

        case "exercise":



            break;

        case "interval":



            break;

        case "bp":



            break;

        default:

            return false;

      }



  }



  //Resultado importante y recoge el resultado de perdidas y ganacias
  public function perdidasGanancias(){


  }

  //Resultado importante y recoge el balance de situacion
  public function balanceDeSituacion(){

  }

  //Recoge todos los
  public function otrosGastosDeExplotacion(){

  }

  //Lo recoge perdidas y ganancias.
  public function ventas(){

  }

  //Lo recoge perdidas y ganancias.
  public function compras(){

  }

  //Lo recoge el balance de situación
  public function inversionesEnInmovilizado(){

  }

  //Lo recoge el balance de situación
  public function determinadasInversiones(){

}

  //Lo recoge perdidas y ganacias
  public function RRHH(){

  }

  //Lo recoge balance de situación
  public function liquidacionImpSociedades(){

  }

  //Lo recoge balance de situación
  public function liquidacionIVA(){

  }

  //Analisis al margen, retorno de la inversión.
  public function TIR(){

  }

  //Analisis al margen, de varios datos
  public function margenesRatios(){

  }

  //Sale de los Movements de cuentas.
  public function tesoreria(){

  }

}
