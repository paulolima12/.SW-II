<?php
    function verificar($x){
        if ($x % 2 == 0){
            echo "O número $x é par!!";
        }
        else{
            echo "O número $x é ímpar!!";
        }
    }

    $a = 10;

    verificar($a);
?>