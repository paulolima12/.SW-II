<?php

$pessoa = array(
    "nome" => "plinio",
    "idade" => 17,
    "cidade" => "Tres Corações",
    "Profissão" => "Militar"
);

echo $pessoa["nome"];    // Imprime "plinio"
echo $pessoa["idade"];   // Imprime 17
echo $pessoa["cidade"];  // Imprime "Tres Corações"

$frinds = array("Sandro Curio", "Paulin", "Wagner Curio");

// Combinando os arrays
$dado = array_merge($pessoa, array("Frinds" => $frinds));

//imprimi frinds
echo $dado["Frinds"][0]; 


?>
