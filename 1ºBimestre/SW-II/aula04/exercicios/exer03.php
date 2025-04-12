<?php
    $numeros = array(10, 1, 12, 13, 2, 5, 76, 43);
    sort($numeros);

    echo "O maior número é o " . $numeros[count($numeros) - 1];
    echo "<br>";
    echo "O menor número é o " . $numeros[0];
?>
