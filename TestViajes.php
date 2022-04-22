<?php
include 'Viajes.php';
include 'Pasajeros.php';

/**
 * Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono. El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer referencia al responsable de realizar el viaje. 
Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. De la misma forma cargue la información del responsable del viaje.
 */

/**
 * Solicita al usuario un número en el rango [$min,$max]
 * @param int $min
 * @param int $max
 * @return int 
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/**
 * Función que muestra las opciones del menú en la pantalla
 * @return int
 */

function seleccionarOpcion() {
    $minimo = 1;
    $maximo = 3;
        echo"1) :----------Crear nuevo viaje---------: \n";
        echo"2) :---Modificar datos de un pasajero---: \n";
        echo"3) :---Ver datos de viajes realizados---: \n";
        $opcion = solicitarNumeroEntre($minimo, $maximo);
        // Function solicitarNumeroEntre($min, $max), reusada el archivo tateti.php
    return $opcion;
}

//Inicialización de variables
$viajesRealizados=[];
$pasajerosRegistrados=[];
//Datos pasajeros predefinidos para chequear funcionalidad de opciones 2 y 3 del menú
$p1= new Pasajeros("Juan", "matin", "345", "456");
$p2= new Pasajeros("david", "martin", "456", "678");
$pasajerosRegistrados[0]=$p1;
$pasajerosRegistrados[1]=$p2;

$v1= new Viajes("456", "Madrid", 3);
$v1->setColeccionPasajeros($pasajerosRegistrados);
$viajesRealizados[0]=$v1;

//Proceso
do {
    $opcion = seleccionarOpcion();
    switch ($opcion) {
        case 1: 
                echo "Ingrese numero de codigo del viaje: ";
                $unCodigo=strtoupper(trim(fgets(STDIN)));
                echo "Ingrese el destino: ";
                $unDestino=strtoupper(trim(fgets(STDIN)));
                echo "Ingrese cantidad de pasajeros: ";
                $pasajeros=trim(fgets(STDIN));
                $viaje= new Viajes($unCodigo, $unDestino, $pasajeros);
                
                for($j = 0; $j < $pasajeros; $j++){
                    if ($j <= $pasajeros){
                        echo "ingrese nombre de nuevo pasajero: ";
                        $nombrePasajero=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese apellido de pasajero: ";
                        $apellidoPasajero=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese telefono de pasajero: ";
                        $telefonoPasajero=strtoupper(trim(fgets(STDIN)));
                        echo "Ingrese documento de pasajero: ";
                        $numeroDocumento=strtoupper(trim(fgets(STDIN)));
                        $pasajero= new Pasajeros($nombrePasajero, $apellidoPasajero, $telefonoPasajero, $numeroDocumento);
                        $pasajerosRegistrados[$j]=$pasajero;
                    }
                        else{ 
                        echo "Se llegó al limite de pasajeros del viaje";
                    }
                }
                $viaje->setColeccionPasajeros($pasajerosRegistrados);
                $nuevaPosicionViaje=count($viajesRealizados);
                $viajesRealizados[$nuevaPosicionViaje]=$viaje;
        break;
        case 2: 
                $buscar= true;
                $i=0;
                $pasajeros=$pasajerosRegistrados;
                //$arrayPasajeros1=$pasajeros->getDocumento($pasajerosRegistrados);
                echo "Ingrese el documento de la persona cuyo nombre, apellido y/o telefono quiera modificar: ";
                $documentoPasajero1=strtoupper(trim(fgets(STDIN)));
                while($i < count($pasajerosRegistrados) && $buscar){
                    $codigoEncontrar=$pasajerosRegistrados[$i]->getDocumento();
                    if($codigoEncontrar == $documentoPasajero1){
                        $buscar= false;
                        echo "ingrese nuevamente el nombre del pasajero: ";
                        $nombrePasajero1=strtoupper(trim(fgets(STDIN)));
                        $pasajerosRegistrados[$i]->setNombre($nombrePasajero1);
                        echo "Ingrese nuevamente el apellido del pasajero: ";
                        $apellidoPasajero1=strtoupper(trim(fgets(STDIN)));
                        $pasajerosRegistrados[$i]->setApellido($apellidoPasajero1);
                        echo "Ingrese nuevamente el telefono del pasajero: ";
                        $telefonoPasajero1=strtoupper(trim(fgets(STDIN)));
                        $pasajerosRegistrados[$i]->setTelefono($telefonoPasajero1);
                    }
                }
        break;
        case 3: 
            echo "****************************** \n";
            for ($i=0; $i < count($viajesRealizados); $i++){
                //$miViaje= $viajesRealizados[$i];
                echo $viajesRealizados[$i] . "\n";
            }
            echo "****************************** \n";
            
            
        break;
    }
} while (($opcion <= 3) && ($opcion >= 1));



//set son para setear nueva información modificando valores y get para obtenerlos (y guardarlos en una variable)

/**
$viaje1->setDestino("Brasil"); 
$codigoViaje1= $viaje1->getCodigo();
echo "El codigo del viaje 1 es: " . $codigoViaje1 . "\n";
$viaje1->setCantidadMaxPasajeros(5);
$pasajerosViaje= $viaje1->getCantidadMaxPasajeros();
echo "La cantidad de pasajeros del viaje 1 es: " . $pasajerosViaje
. "\n";

$codigoViaje2= $viaje2->getCodigo();
echo "El codigo del viaje 2 es: " . $codigoViaje2. "\n";
$viaje2->setCodigo("111");
echo "El codigo del viaje 2 es: " . $viaje2->getCodigo() . "\n";
echo "\n"; 
echo "Uso un echo sobre el objeto \n";
echo $viaje1 . "\n";
echo $viaje2;
*/
