<?php

$alunos = array("Lele" => "8", "Janes" => "2", "Pedro" => "6", "Ric" => "4");

$somaNotas = 0;
$maiorNota = 0;
$alunoMaiorNota = "";

foreach ($alunos as $nome => $nota) {
    $somaNotas += $nota;
    $mediaNotas = $somaNotas / count($alunos);

    if ($nota > $maiorNota) {
        $maiorNota = $nota;
        $alunoMaiorNota = $nome;
    }
}

echo "A média das notas é: " . $mediaNotas . "<br>";
echo "O aluno com a maior nota é $alunoMaiorNota com a nota $maiorNota";
?>
