<?php

    $ubicacionExe = "C:/xampp/htdocs/ge/turbinas/turbine_lib.exe ";
    $comandos = [
        "--atmosphere-p0=",
        "--atmosphere-t0=",
        "--inlet-sigma=",
        "--omp-pi_c=",
        "--comp-eta_stag_p=",
        "--comb_chamber-eta_burn=",
        "--comb_chamber-Q_n=",
        "--comb_chamber-T_stag_out=",
        "--turbine-eta_stag_p=",
        "--turbine-p_stag_out=",
        "--load-power=",
        "--outlet-sigma=",
        "--regenerator-T_stag_hot_in=",
        "--regenerator-T_stag_hot_out="
    ];
    $corridas = $_GET['data'];
    $respuesta = [];

    for($i = 0; $i < count($corridas); $i++){
        $resultado = [];
        $comando = "";
        for($j = 0; $j < count($corridas[$i]); $j++){
            if($corridas[$i][$j] != ""){
                $comando .= $comandos[$j].$corridas[$i][$j]." ";
            }
        }
        exec($ubicacionExe.$comando, $salida);
        $res = [];
        for($i = 0; $i < count($salida); $i ++){
            $split = explode("=", $salida[$i]);
            $res[$split[0]] = $split[1];
        }
        array_push($respuesta, $res);
    }

    $json = json_encode(["data" => $respuesta]);
    print $json;