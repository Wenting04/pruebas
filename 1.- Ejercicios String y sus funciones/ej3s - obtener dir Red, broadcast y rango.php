<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>

<!--Pueba de edición-->
<!--
A partir de la IP y la máscara de red
Obtener:
1. Dirección de red
2. Dirección de broadcast
3. Rango de IPs disponibles para los equipos

- -- Ejemplos salida -- -

IP 192.168.16.100/16
Mascara 16
Direccion Red: 192.168.0.0
Direccion Broadcast: 192.168.255.255
Rango: 192.168.0.1 a 192.168.255.254

IP 192.168.16.100/21
Mascara 21
Direccion Red: 192.168.16.0
Direccion Broadcast: 192.168.23.255
Rango: 192.168.16.1 a 192.168.23.254

IP 10.33.15.100/8
Mascara 8
Direccion Red: 10.0.0.0
Direccion Broadcast: 10.255.255.255
Rango: 10.0.0.1 a 10.255.255.254
-->

<!-- Explicación para conseguir cada cosa

La máscara indica que los primeros X bits (el num de máscara) son parte de la red
y los últimos son parte de host
Ej:
    IP: 192.168.16.100
    Máscara: /24 o 255.255.255.0

    Los primeros 24 bits son parte de la red
    Los últimos 8 bits son parte de host (equipos)

    Tengamos en cuenta que cada trozo de la ip son 8 bits, quiero decir:
        192.168.206.226
        192 -> primeros 8 bites
        168 -> siguientes 8 bits (ya son 16 bits)
        206 -> siguientes (ya son 24 bits)
        226 -> los últimos 8 bites (con esto 32 bits)

Para Broadcast -> En la de dirección de red, en vez de 0 es 255
Es decir, que se rellena los 8 bits de cada parte con 1, dando así 255

Para disponibilidad de red -> excepto el 0 y el 255 (es decir, de 1 al 254 = 254 IPs disponibles)
-->

<BODY>
<?php
    $ip="192.168.16.100/16";
    $ip2="192.168.16.100/21";
    $ip3="192.168.16.100/8";

    function calcTodo($ip){
        //Sacar los bytes por separado - Lo siguiente explocado en el ej1s.php
        $posicion1 = 0;

        $posicion2 = strpos($ip, ".", $posicion1);
        $byte1 = substr($ip, $posicion1, $posicion2 - $posicion1);

        $posicion1 = $posicion2 + 1;
        $posicion2 = strpos($ip, ".", $posicion1);
        $byte2 = substr($ip, $posicion1, $posicion2 - $posicion1);

        $posicion1 = $posicion2 + 1;
        $posicion2 = strpos($ip, ".", $posicion1);
        $byte3 = substr($ip, $posicion1, $posicion2 - $posicion1);

        $posicion1 = $posicion2 + 1;
        $posicion2 = strpos($ip, "/", $posicion1);
        $byte4 = substr($ip, $posicion1, $posicion2 - $posicion1);

        function obtenerMascara($ip){

            $posicion = strpos($ip, "/");
            $mascara = substr($ip, $posicion + 1);

            $mascara = (int) $mascara;

            return $mascara;
        }

        function obtenerDirRed($byte1, $byte2, $byte3, $byte4, $mascara){

            $red = "";

            if (  ($mascara/8) == 1  ){ //Cuantos de 8
                $red = $byte1 . ".0.0.0";
            } else if (  ($mascara/8) == 2  ){
                $red = $byte1 . "." . $byte2 . ".0.0";
            } else if (  ($mascara/8) == 3  ){
                $red = $byte1 . "." . $byte2 . "." . $byte3 .".0";
            } else { //La que queda debe ser 4
                $red = $byte1 . "." . $byte2 . "." . $byte3 . "." . $byte4;
            }

            return $red;
        }

        function obtenerDirBroadcast($byte1, $byte2, $byte3, $byte4, $mascara){
            $broad = "";

            if (  ($mascara/8) == 1  ){ //Cuantos de 8
                $broad = $byte1 . ".255.255.255";
            } else if (  ($mascara/8) == 2  ){
                $broad = $byte1 . "." . $byte2 . ".255.255";
            } else if (  ($mascara/8) == 3  ){
                $broad = $byte1 . "." . $byte2 . "." . $byte3 .".255";
            } else { //La que queda debe ser 4
                $broad = $byte1 . "." . $byte2 . "." . $byte3 . "." . $byte4;
            }

            return $broad;
        }
        function obtenerRango($byte1, $byte2, $byte3, $byte4, $mascara){
            //Está mal, no pedía esto Xd
            $rango = "";

            $num = $mascara/8;
            if (  $num == 1  ){ //".255.255.255"
                $rango = 245*$num;
            } else if (  $num == 2  ){ //".255.255"
                $rango = 245*$num;
            } else if (  $num == 3  ){ //".255"
                $rango = 245*$num;
            } else { //La que queda debe ser 4
                $rango = 245*$num;
            }

            return $rango;
        }

        $mascara = obtenerMascara($ip);
        $red = obtenerDirRed($byte1, $byte2, $byte3, $byte4, $mascara);
        $broadcast = obtenerDirBroadcast($byte1, $byte2, $byte3, $byte4, $mascara);
        $rango = obtenerRango($byte1, $byte2, $byte3, $byte4, $mascara);


        echo "IP " . $ip;
        echo "Mascara " . $mascara;
        echo "Direccion Red: " . $red;
        echo "Direccion Broadcast: " . $broadcast;
        echo "Rango: " . $rango;
    }

    calcTodo($ip);
    calcTodo($ip2);
    calcTodo($ip3);
?>
</BODY>
</HTML>
