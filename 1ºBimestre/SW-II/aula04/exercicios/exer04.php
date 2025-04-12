<?php
$num = array(10, 1, 12, 13, 2, 5, 76, 43, 11, 65, 22, 24, 67, 87, 90);

$par = 0;
$impar = 0;

for ($i = 0; $i < 15; $i++) {
    if ($num[$i] % 2 == 0) {
        $par++;
    } else {
        $impar++;
    }
}

echo "A qtdade de pares é: $par <br>";
echo "A qtdade de impares é: $impar";
?>