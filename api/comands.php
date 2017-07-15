<?php
    // Variables estaticas de Comandos
    $ubicacionExe = "C:/xampp/htdocs/ge/turbinas/turbine_lib.exe ";
    $comando1 = "atmosphere-p0=";
    $comando2 = "atmosphere-t0=";
    $comando3 = "inlet-sigma=";
    $comando4 = "omp-pi_c=";
    $comando5 = "comp-eta_stag_p=";
    $comando6 = "comb_chamber-eta_burn=";
    $comando7 = "comb_chamber-Q_n=";
    $comando8 = "comb_chamber-T_stag_out=";
    $comando9 = "turbine-eta_stag_p=";
    $comando10 = "turbine-p_stag_out=";
    $comando11 = "load-power=";
    $comando12 = "outlet-sigma=";
    $comando13 = "regenerator-T_stag_hot_in=";
    $comando14 = "regenerator-T_stag_hot_out=";

    if(isset($_GET['json'])){

        $json = json_decode($_GET['json']);

        print_r($json);

    }else{
        print("<h1 style='width: 100%; margin-top: 20%; text-align: center'>Error</h1>");
    }

    function converJSON($array){
        $dic = [];
        for($i = 0; $i < count($array); $i ++){
            $split = explode("=", $array[$i]);
            $dic[$split[0]] = $split[1];
        }
        $json = json_encode($dic);
        return $json;
    }

