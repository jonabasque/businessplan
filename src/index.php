<?php

//Index
echo "Planes de negocio<br \>";

//llamamos a business_plan y ejercicios_fiscales, y aparte a calculadora, para algunas operaciones
require_once("libs/business_plan/movimiento.php");
require_once("libs/business_plan/inversion.php");
require_once("libs/business_plan/recurso_humano.php");
require_once("libs/business_plan/resultados.php");
require_once("libs/business_plan/business_plan.php");
require_once("libs/business_plan/ejercicios_fiscales.php");
require_once("libs/dojo-calculadora/class/calculadora.php");

//Utilizamos alias para cada clase
use asketic\business_plan\User as User;
use asketic\business_plan\Inversion as Inversion;
use asketic\business_plan\RecursoHumano as RecursoHumano;
use asketic\business_plan\EjercicioFiscal as EjercicioFiscal;
use asketic\business_plan\BusinessPlan as BusinessPlan;
use asketic\business_plan\Resultados as Resultados;
use asketic\business_plan\Compras as Compras;

echo "<b>ESTE ES EL INDICE DE LA APLICACION</b><br \>";

//CREAMOS UN OBJETO DE TIPO USER
echo "<br \><u> Instancia de un USUARIO</u><br \>";

$user = new User("James");
echo $user->nombre;

//CREAMOS UN OBJETO DE TIPO EJERCICIOFISCAL
echo "<br \><br \><u> Instancia de un EJERCICIO FISCAL (2016)</u><br \><br \>";

$ejercicio1 = new EjercicioFiscal("mensual","2016");
$ejercicio2 = new EjercicioFiscal("mensual","2017");

//Mostramos los dias de un mes al azar y el tipo, que puede ser mensual o anual
echo $ejercicio1->meses["February"].", ".$ejercicio1->type."<br /><br />";

//Ejemplo de definición de una COMPRA //////////////////////////////////
//Datos de la COMPRA
$code = "C0005";
$var_array = array("concept" =>"Compra de licencia de Windows",
                        "importe"=>"100",
                        "units"=>"5");
$ejercicio1->setMovimiento($code, $var_array);
echo "<br />";

////////////////////////////////////////////////////////////////////////

echo "<br \><u> Instancia de un plan de NEGOCIO</u><br \><br \>";

//idioma, ubicacion
$locale=["Inglés","EEUU"];

//instancia de un plan de negocio (usamos el alias)
$businessPlan = new BusinessPlan($user,"Alimentacion",$locale,"Ekodenda");

//agregamos varios ejercicios fiscales al plan de negocio
$businessPlan->setEjercicio("anual","2018","August");
$businessPlan->setEjercicio("anual","2017","August");
$businessPlan->setEjercicio("anual","2016","August");

//Inversion de prueba para meter desde la clase businessPlan
$code = "I0010";
$concept = "Inversion en proveedores corto y medio plazo";
$importe = 1000;
$units = 3;

echo "<br /><br />";

//Creación de varios movimientos un día en concreto
$var_array = array("concept" =>"Renovacion tecnico informatico",
                        "importe"=>"600",
                        "units"=>"1");
$businessPlan->ejercicios[2018]->setMovimiento("R0011",$var_array);

$var_array = array("concept" =>"Renovacion tecnico informatico",
                        "importe"=>"800",
                        "units"=>"1");
$businessPlan->ejercicios[2018]->setMovimiento("R0012",$var_array);

$var_array = array("concept" =>"Compra de varias fuentes de alimentación",
                        "importe"=>"800",
                        "units"=>"3");
$businessPlan->ejercicios[2018]->setMovimiento("C0013",$var_array);

$var_array = array("concept" =>"Renovacion de otro tipo de técnico",
                        "importe"=>"900",
                        "units"=>"1");
$businessPlan->ejercicios[2018]->setMovimiento("R0011",$var_array);

//var_dump($businessPlan);

$inversion1 = new Inversion($code, $concept, $importe, $units);

//Recurso humano de prueba para meter desde la clase businessPlan

//echo $businessPlan->user->nombre;
echo "<br /><br />";
echo $businessPlan->getSector();
echo "<br />";
echo $businessPlan->getTitle();
echo "<br />";

//RESULTADOS
$businessPlan->resultados = new Resultados();

$date = ["day" => "28", "month" => "March", "exercise" => "2018"];

//Se calcula el total de un día
echo "<br /> Total de recursos humanos (27-03-2018): ".$businessPlan->resultados->totalDay($date,"recursos",$businessPlan)."<br /><br />";

//Se calcula el total de un mes
echo "<br /><br /> Total de recursos humanos (03-2018): ".$businessPlan->resultados->totalMonth($date,"recursos",$businessPlan)."<br /><br />";

//Se calcula el total de un año/ejercicio fiscal
echo "<br /><br /> Total de recursos humanos (2018): ".$businessPlan->resultados->totalExercise($date,"recursos",$businessPlan)."<br /><br />";

//Se calcula el total del plan de negocio
echo "<br /><br /> Total de recursos humanos (): ".$businessPlan->resultados->totalExercise($date,"recursos",$businessPlan)."<br /><br />";

//Intervalo personalizado
$date_ini = ["day" => "26", "month" => "August", "exercise" => "2018"];
$date_fin = ["day" => "28", "month" => "July", "exercise" => "2018"];


//Se calcula el total de un intervalo de tiempo personalizado
echo "<br /><br /> Total de recursos humanos (de... a...): ".$businessPlan->resultados->totalInterval($date_ini,$date_fin,"recursos",$businessPlan)."<br /><br />";