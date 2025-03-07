<?php
    function fatorial($numero) {
        if ($numero == 0 or $numero == 1){
            return 1;
        }
        else{
            $resultado = 1;
    

            for ($i = $numero; $i > 0; $i--) {
                $resultado *= $i;
            }
        
      return $resultado;
        }
    }
    $numero = 3
    echo "O fatorial de $numero é: " . fatorial($numero);
?>