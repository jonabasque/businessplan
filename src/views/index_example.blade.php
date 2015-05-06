<?php

namespace Jonabasque\Businessplan;

//Index
echo "Planes de negocio<br \>";

//llamamos a business_plan y exercises_fiscales, y aparte a calculadora, para algunas operaciones

/*require_once("libs/business_plan/movement.php");
require_once("libs/business_plan/inversion.php");
require_once("libs/business_plan/human_resource.php");
require_once("libs/business_plan/results.php");
require_once("libs/business_plan/business_plan.php");
require_once("libs/business_plan/fiscal_year.php");*/

//Utilizamos alias para cada clase
use asketic\business_plan\Inversion as Inversion;
use asketic\business_plan\HumanResource as HumanResource;
use asketic\business_plan\FiscalYear as FiscalYear;
use asketic\business_plan\BusinessPlan as BusinessPlan;
use asketic\business_plan\Results as Results;
use asketic\business_plan\Purchase as Purchase;

echo "<b>ESTE ES EL INDICE DE LA APLICACION</b><br \>";

//CREAMOS UN OBJETO DE TIPO FiscalYear
echo "<br \><br \><u> Instancia de un ejercicio FISCAL (2016)</u><br \><br \>";

$exercise1 = new FiscalYear("mensual","2016");
$exercise2 = new FiscalYear("mensual","2017");

//Mostramos los dias de un mes al azar y el tipo, que puede ser mensual o anual
echo $exercise1->months["February"].", ".$exercise1->type."<br /><br />";

//Ejemplo de definición de una COMPRA //////////////////////////////////
//Datos de la COMPRA
$code = "C0005";
$var_array = array("concept" =>"Compra de licencia de Windows",
                        "importe"=>"100",
                        "units"=>"5");
$exercise1->setMovement($code, $var_array);
echo "<br />";

////////////////////////////////////////////////////////////////////////

echo "<br \><u> Instancia de un plan de NEGOCIO</u><br \><br \>";

//idioma, ubicacion
$locale=["Inglés","EEUU"];

//instancia de un plan de negocio (usamos el alias)
$businessPlan = new BusinessPlan("Alimentacion",$locale,"Ekodenda");

//agregamos varios exercises fiscales al plan de negocio
$businessPlan->setexercise("anual","2018","August");
$businessPlan->setexercise("anual","2017","August");
$businessPlan->setexercise("anual","2016","August");

//Inversion de prueba para meter desde la clase businessPlan
$code = "I0010";
$concept = "Inversion en proveedores corto y medio plazo";
$importe = 1000;
$units = 3;

echo "<br /><br />";

//Creación de varios Movements un día en concreto
$var_array = array("concept" =>"Renovacion tecnico informatico",
                        "importe"=>"600",
                        "units"=>"1");
$businessPlan->exercises[2018]->setMovement("R0011",$var_array);

$var_array = array("concept" =>"Renovacion tecnico informatico",
                        "importe"=>"800",
                        "units"=>"1");
$businessPlan->exercises[2018]->setMovement("R0012",$var_array);

$var_array = array("concept" =>"Compra de varias fuentes de alimentación",
                        "importe"=>"800",
                        "units"=>"3");
$businessPlan->exercises[2018]->setMovement("C0013",$var_array);

$var_array = array("concept" =>"Renovacion de otro tipo de técnico",
                        "importe"=>"900",
                        "units"=>"1");
$businessPlan->exercises[2018]->setMovement("R0011",$var_array);

//var_dump($businessPlan);

$inversion1 = new Inversion($code, $concept, $importe, $units);

//Recurso humano de prueba para meter desde la clase businessPlan

echo "<br /><br />";
echo $businessPlan->getSector();
echo "<br />";
echo $businessPlan->getTitle();
echo "<br />";

//RESULTADOS
$businessPlan->results = new Results();

$date = ["day" => "28", "month" => "March", "exercise" => "2018"];

//Se calcula el total de un día
echo "<br /> Total de recursos humanos (27-03-2018): ".$businessPlan->results->totalDay($date,"recursos",$businessPlan)."<br /><br />";

//Se calcula el total de un mes
echo "<br /><br /> Total de recursos humanos (03-2018): ".$businessPlan->results->totalMonth($date,"recursos",$businessPlan)."<br /><br />";

//Se calcula el total de un año/exercise fiscal
echo "<br /><br /> Total de recursos humanos (2018): ".$businessPlan->results->totalExercise($date,"recursos",$businessPlan)."<br /><br />";

//Se calcula el total del plan de negocio
echo "<br /><br /> Total de recursos humanos (): ".$businessPlan->results->totalExercise($date,"recursos",$businessPlan)."<br /><br />";

//Intervalo personalizado
$date_ini = ["day" => "26", "month" => "August", "exercise" => "2018"];
$date_fin = ["day" => "28", "month" => "July", "exercise" => "2018"];


//Se calcula el total de un intervalo de tiempo personalizado
echo "<br /><br /> Total de recursos humanos (de... a...): ".$businessPlan->results->totalInterval($date_ini,$date_fin,"recursos",$businessPlan)."<br /><br />";