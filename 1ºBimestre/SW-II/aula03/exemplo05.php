<?php

    function teste($x){
        foreach ($x as $nome) {
            echo "$nome <br>";
        }
    }

    $vetor = ['Paulo', 'EMPRESARIO', 'TIM'];

    teste($vetor);
    
?>