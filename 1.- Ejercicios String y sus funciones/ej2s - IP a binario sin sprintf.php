<HTML>
<HEAD><TITLE> EJ2-Conversion IP Decimal a Binario sin sprintf </TITLE></HEAD>

<!--
Debe imprimir:

IP 192.18.16.204 en binario es 11000000.00010010.00010000.11001100
IP 10.33.161.2 en binario es 00001010.00100001.10100001.00000010

No podemos usar sprintf ni printf

--------------------------------------------
- -- EXPLICACIÓN CONVERTIR A BINARIO -- -
Por ejemplo, tenemos esta tabla de 8 cuadros:
| 128 | 64 | 32 | 16 | 8 | 4 | 2 | 1 |
Si nos damos cuenta desde la derecha hasta la izquierda,
	la cifra de la izquiera es el doble del de la derecha

Desde la izquierda hasta la derecha, con el número que tengamos, si se puede restar, es 1, si no es 0
Por ejemplo, el ip del ejercicio: 192.18.16.204
- -- 192 -- -
192 - 128 = 64 -> Sí -> 1
	Usamos el resto y vamos al siguiente cuadro
64 - 64 = 0 -> Sí -> 1
	Ahora que no queda nada por restar, el resto será 0

- -- 18 -- -
192 - 18 = No -> 0
	Si no se pudo restar, tomamos la misma y pasamos al siguiente
64 - 18 = No -> 0
32 - 18 = No -> 0
16 - 18 = Sí -> 1
Lo restamos como si fuera un valor absoluto o simplemente cambialo: 18 - 16
etc
--------------------------------------------
-->

<BODY>
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

		$byte1 = pasarDecBin($byte1);
		$byte2 = pasarDecBin($byte2);
		$byte3 = pasarDecBin($byte3);
		$byte4 = pasarDecBin($byte4);

		$binario = $byte1 . "." . $byte2 . "." . $byte3 . "." . $byte4;

		return $binario;
	}

	function pasarDecBin ($dec){

		/* Por si acaso lo haré sin arrays
		//Creo un array de 8 casillas (0 al 7) para usarlo para calcular
		$convert = array(128, 64, 32, 16, 8, 4, 2, 1);
		*/
		
		$bin = "";
		
		//128
		if ($dec == 0){
			$bin = "00000000";
		} else {
			if (  ($dec - 128) >= 0  ){ //Si restando el decimal da un núm negativo -> no se puede restar
				$bin .= 1;
				$dec = $dec - 128;
			} else {
				$bin .= 0;
			}

			//64
			if ($dec == 0){
				$bin .= "0000000";
			} else {
				if (  ($dec - 64) >= 0  ){
					$bin .= 1;
					$dec = $dec - 64;
				} else {
					$bin .= 0;
				}

				//32
				if ($dec == 0){
					$bin .= "000000";
				} else {
					if (  ($dec - 32) >= 0  ){
						$bin .= 1;
						$dec = $dec - 32;
					} else {
						$bin .= 0;
					}
					
					//16
					if ($dec == 0){
						$bin .= "00000";
					} else {
						if (  ($dec - 16) >= 0  ){
							$bin .= 1;
							$dec = $dec - 16;
						} else {
							$bin .= 0;
						}

						//8
						if ($dec == 0){
							$bin .= "0000";
						} else {
							if (  ($dec - 8) >= 0  ){
								$bin .= 1;
								$dec = $dec - 8;
							} else {
								$bin .= 0;
							}
							
							//4
							if ($dec == 0){
								$bin .= "000";
							} else {
								if (  ($dec - 4) >= 0  ){
									$bin .= 1;
									$dec = $dec - 4;
								} else {
									$bin .= 0;
								}
								
								//2
								if ($dec == 0){
									$bin .= "00";
								} else {
									if (  ($dec - 2) >= 0  ){
										$bin .= 1;
										$dec = $dec - 2;
									} else {
										$bin .= 0;
									}
									
									//1
									if ($dec == 0){
										$bin .= "0";
									} else {
										if (  ($dec - 1) >= 0  ){
											$bin .= 1;
										} else {
											$bin .= "0";
										}
										
									}
								}
							}
						}
					}
				}
			}
		}

		return $bin;
	}

	$binar = calcularIP($ip);
	$binar2 = calcularIP($ip2);

	echo "IP $ip en binario es $binar <br>";
	echo "IP $ip2 en binario es $binar2";
?>
</BODY>
</HTML>
