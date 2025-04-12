<?php

$num = array(10, 1, 12, 13, 2, 5, 76, 43, 9, 18);
// sort($num);
// print_r($num);

$resultado = 0;

for ($i=0; $i < 10; $i++) { 
    $resultado += $num[$i];
}

echo "A soma de todos os elementos do array é: $resultado";

?>