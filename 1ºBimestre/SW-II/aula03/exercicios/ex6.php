
<?php
    function conta($x){
        $resultados = [];

        for ($n = 1; $n < 11; $n ++) {
            $multi = $x * $n;
            $resultados[] = "$x x $n = $multi";
        }

        return $resultados;
    }
    
    $numero = 9;

    echo "A tabuada do número $numero é: <br> <br>";

    $tabuada = conta($numero);

    foreach ($tabuada as $linha) {
        echo $linha . "<br>";
    }
?>