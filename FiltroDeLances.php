<?php
class FiltroDeLances {

    public function filtra($lances) {
        $resultado = array();

        foreach($lances as $lance) {
            if($lance->getValor() > 1000 && $lance->getValor() < 3000) 
                    $resultado[] = $lance->getValor();
            else if($lance->getValor() > 500 && $lance->getValor() < 700) 
                    $resultado[] = $lance->getValor();
            else if($lance->getValor() > 5000) 
                    $resultado[] = $lance->getValor();
        }

        return $resultado;
    }
}

?>