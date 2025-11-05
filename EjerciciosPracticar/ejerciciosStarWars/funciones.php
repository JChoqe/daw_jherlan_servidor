<?php
require_once "../../data/datos.php";

$mas100 = 
    array_map(
        function($nave) {
            return [
                "name" => $nave["name"],
                "model" => $nave["model"]
            ];
        },
    array_filter($sw["results"], 
        function($nave) {
            return (int)$nave["passengers"] > 100;
        }
    )
    )
;

echo "Naves con más de 100 pasajeros:<br>";
print_r($mas100);
$menos100 = array_map(
    function($nave) {
        return [
            "name" => $nave["name"],
            "model" => $nave["model"]
        ];
    },
    array_filter($sw["results"], function($nave) {
        return 
            $nave["passengers"] === "unknown" ||
            $nave["passengers"] === "n/a" ||
            $nave["passengers"] === "" ||
            ((int)$nave["passengers"] <= 100);
    })
);

echo "<br>Naves con 100 o menos pasajeros o sin info:<br>";
print_r($menos100);
