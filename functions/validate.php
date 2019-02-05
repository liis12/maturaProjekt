<?php 
include "functions.php";

// Reines JSON lesen
$jsonText = trim(file_get_contents("php://input"));
 
// Objekt daraus erzeugen
$json = json_decode($jsonText, true);
// print_r($json);

$antworten = $json["antwortObjs"];

$validedAntworten = array();
foreach($antworten as $antwort) {
    $id = $antwort["id"];
    $checked = $antwort["checked"];
    $antwortResult = checkAntwort($id, $checked);

    if($antwortResult != null) {  
        // echo "per Ro: ".$id."\n";
        // print_r($antwortResult);
        // echo "\n\n";

        $validedAntworten[$antwortResult->antwortID] = $antwortResult;
    }
}

echo json_encode($validedAntworten);

?>