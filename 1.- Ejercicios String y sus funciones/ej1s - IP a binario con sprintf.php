<html>
<head>
    <title> EJ1-Conversion IP Decimal a Binario con sprintf </title>
</head>

<!--
Debe imprimir:

IP 192.18.16.204 en binario es 11000000.00010010.00010000.11001100
IP 10.33.161.2 en binario es 00001010.00100001.10100001.00000010

--------------------------------------------
Podemos usar la función printf o sprintf

printf -> Escribe salida en consola (salida estándar)
Se usa cuando quieras mostrar un msg al usuario, un valor de una variable o cualquier dato (ns)
Ej: imprimir valor de variable llamado contador en un msg
	int contador = 10;
	printf("El valor del contador es: %d\n", contador);
	
	Salida: El valor del contador es: 10
	
sprintf -> guarda cadena formateada en matriz de carácteres (un string o variable de texto) para printf
Para construir cadenas de texto que luego se usan en otras partes del programa
Ej: Crear un string que combine texto y número
	char buffer[100];
	int dia = 25;
	sprintf(buffer, "La fecha es el día &d.", dia); //buffer contendrá "La fecha es el día 25"
	//Ahora 'buffer' sirve para lo que necesitemos
	
%d -> Usado para insertar valor de las variables
--------------------------------------------
-->

<body>
    <?php

		//Inicializar un valor usando directamente $, no necesitamos un let ni string ni etc
		$ip="192.18.16.204"; //IP introducido como cadena (string)
		$ip2="10.33.161.2";

        function calcularIP ($ip){
            //Idea y código de Riz
            //Vamos a hacer que recorra por lo ancho del string y que pare cuando encuentre el punto
            
            //Valor para contar desde inicio
            $posicion1 = 0;

            /*
            strpos($cadenaRecorrer, "elemento", $desdeNumQueRecorre)
                $cadenaRecorrer -> Elemento que quieres que vaya a recorrer
                "elemento" -> Aquí el carácter que quieres encontrar
                $desdeNumQueRecorre -> Número de carácter donde se inicia el recorrido
            El strpo te devuelve el número de carácteres que recorre antes de encontrar al elemento
            */
            $posicion2 = strpos($ip, ".", $posicion1); //Ahora posicion está en el carácter . , no al inicio
            
            /*
            substr($cadenaRecorrer, $dondePosicionarse, $cantidadCaracterRecorre)
                $cadenaRecorrer -> Elemento a recorrer o substraer
                $dondePosicionarse -> En qué número de carácter se debe poner para empezar
                $cantidadCaracterRecorre -> Cantidad que va a recorrer
            El substr te devuelve los carácteres desde $dondePosicionarse hasta la cantidad que pongas
            */
            //$posicion2 - $posicion1 -> para conseguir la cantidad desde tal sitio al otro
            $byte1 = substr($ip, $posicion1, $posicion2 - $posicion1);

            $posicion1 = $posicion2 + 1; //Ej: palabra -> $pos2 está en a, $pos1 le doy el $pos2 + 1, entonces $pos1 está en b
            $posicion2 = strpos($ip, ".", $posicion1);
            $byte2 = substr($ip, $posicion1, $posicion2 - $posicion1);

            $posicion1 = $posicion2 + 1;
            $posicion2 = strpos($ip, ".", $posicion1);
            $byte3 = substr($ip, $posicion1, $posicion2 - $posicion1);

            $posicion1 = $posicion2 + 1;
            $byte4 = substr($ip, $posicion1); //Toma desde $posicion1 hasta el final
			
			/*Si quisiera sólo el último byte
				$ip = "192.168.1.45"
				
				$posicion = strrpos($ip, "."); //Última posición del punto
				$byte4 = substr($ip, $pos`+ 1);
				
				echo $byte4; //45
			----------------------------------------
			Siguiendo lo de arriba podemos hacerlo para hacer el ejercicio Xd
			*/

            $byte1 = sprintf("%08b", $byte1);
			$byte2 = sprintf("%08b", $byte2);
			$byte3 = sprintf("%08b", $byte3);
			$byte4 = sprintf("%08b", $byte4);

            $binario = $byte1 . "." . $byte2 . "." . $byte3 . "." . $byte4;

            return $binario;
        }

        $binar = calcularIP($ip);
        $binar2 = calcularIP($ip2);

        echo "IP $ip en binario es $binar <br>";
        echo "IP $ip2 en binario es $binar2";
    ?>
</body>
</html>
