<?php
if(isset($_SERVER["HTTP_ORIGIN"]))
{
    // You can decide if the origin in $_SERVER['HTTP_ORIGIN'] is something you want to allow, or as we do here, just allow all
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
}
else
{
    //No HTTP_ORIGIN set, so we allow any. You can disallow if needed here
    header("Access-Control-Allow-Origin: *");
}

header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 600");    // cache for 10 minutes

if($_SERVER["REQUEST_METHOD"] == "OPTIONS")
{
    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_METHOD"]))
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT"); //Make sure you remove those you do not want to support

    if (isset($_SERVER["HTTP_ACCESS_CONTROL_REQUEST_HEADERS"]))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    //Just exit with 200 OK with the above headers for OPTIONS method
    exit(0);
}
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
    if(isset($_GET['data'])) {
        $corridas = $_GET['data'];

        if($corridas != "") {
            $respuesta = [];

            for ($i = 0; $i < count($corridas); $i++) {
                // print_r($corridas[$i]);
                $resultado = [];
                $comando = "";
                for ($j = 0; $j < count($corridas[$i]); $j++) {
                    if ($corridas[$i][$j] != "") {
                        $comando .= $comandos[$j] . $corridas[$i][$j] . " ";
                    }
                }
                exec($ubicacionExe . $comando, $salida);
                $res = [];
                $flag = 0;
                for ($k = 0; $k < count($salida); $k++) {
                    $split = explode("=", $salida[$k]);
                    $res['output' . $flag] = $split[1];
                    $flag++;
                }
                array_push($respuesta, $res);
                unset($res, $salida);
            }
                $json = json_encode(["res" => "1", "data" => $respuesta]);
                print $json;
        }else{
            print("<h1 style='width: 100%; margin-top: 20%; text-align: center'>Error</h1>");
        }
    }else if(isset($_GET["android"])){


    }else{
        print("<h1 style='width: 100%; margin-top: 20%; text-align: center'>Error</h1>");
    }