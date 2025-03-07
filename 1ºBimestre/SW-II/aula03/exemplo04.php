<?php

    function msg($x){
        $a = "Paulin " . $x;
        return $a;
    }

    $sobrenome = "lima";

    $frase = "heloo ";

    $frase .= msg($sobrenome);
    $frase .= ", oi lindo";
    echo $frase    
?>