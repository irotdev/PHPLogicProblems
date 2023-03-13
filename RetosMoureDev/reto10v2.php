<?php
/**
 * Reto10 of MoureDev: https://github.com/mouredev/retos-programacion-2023/tree/main/Retos/Reto%20%2310%20-%20LA%20API%20%5BMedia%5D
 * Example of use of the AEMET API: https://opendata.aemet.es/centrodedescargas/inicio
 * This API needs 2 calls (for get the URL with the link to the data, and the URL with the data (real data).
 * @author José Manuel Muñoz Simó | irotdev
 * @version v2.0
 */

// Adding AEMETKEY (constant with my personal API key)
// Ask for another one for you here: https://opendata.aemet.es/centrodedescargas/inicio
// CONST AEMETKEY = "XXXXXXXXXXXXXXXXXX";
include('../private.php');

// Municipality code: https://www.ine.es/daco/daco42/codmun/codmunmapa.htm
CONST MUNICIPALITY = "04075"; // City: Almería --> Pulpí

// AEMET API return the 1st part of the json with the URL of the data in "datos"
$url = "https://opendata.aemet.es/opendata/api/prediccion/especifica/municipio/diaria/" . MUNICIPALITY . "/?api_key=" . AEMETKEY;
$arr = json_decode(file_get_contents($url), true);
$urlData = utf8_encode($arr["datos"]);

// AEMET API return the 2nd part of the json starting with "[" (which is wrong)
$json = "{\"data\": " . utf8_encode(file_get_contents($urlData)) . "}";     // The data is in iso-8859-1
$arr2 = json_decode($json, true);

// Showing data
echo "AEMET API - test";
echo "Temperature prediction for " . $arr2["data"][0]["nombre"] . ", " . $arr2["data"][0]["provincia"] . " (Spain)<br>";
$arrDay = $arr2["data"][0]["prediccion"]["dia"];

echo "Today, day " . date_format(date_create($arrDay[0]["fecha"]), "Y-m-d") . ": <br>";
echo "-> " . $arrDay[0]["temperatura"]["dato"][0]["value"] . "ºC at " . $arrDay[0]["temperatura"]["dato"][0]["hora"] . "h.<br>";
echo "-> " . $arrDay[0]["temperatura"]["dato"][1]["value"] . "ºC at " . $arrDay[0]["temperatura"]["dato"][1]["hora"] . "h.<br>";
echo "-> " . $arrDay[0]["temperatura"]["dato"][2]["value"] . "ºC at " . $arrDay[0]["temperatura"]["dato"][2]["hora"] . "h.<br>";
echo "-> " . $arrDay[0]["temperatura"]["dato"][3]["value"] . "ºC at " . $arrDay[0]["temperatura"]["dato"][3]["hora"] . "h.<br>";
echo "<br>";
echo "Tomorrow, day " . date_format(date_create($arrDay[1]["fecha"]), "Y-m-d") . ": <br>";
echo "-> " . $arrDay[1]["temperatura"]["dato"][0]["value"] . "ºC at " . $arrDay[1]["temperatura"]["dato"][0]["hora"] . "h.<br>";
echo "-> " . $arrDay[1]["temperatura"]["dato"][1]["value"] . "ºC at " . $arrDay[1]["temperatura"]["dato"][1]["hora"] . "h.<br>";
echo "-> " . $arrDay[1]["temperatura"]["dato"][2]["value"] . "ºC at " . $arrDay[1]["temperatura"]["dato"][2]["hora"] . "h.<br>";
echo "-> " . $arrDay[1]["temperatura"]["dato"][3]["value"] . "ºC at " . $arrDay[1]["temperatura"]["dato"][3]["hora"] . "h.<br>";
