<?php

include "config.php";

function createQuestion($row){



}

/**
 * Gibt alle kategorien bei ihrer ID wieder.
 * We do not send the database id to the WebUI, for securtiy reasons. 
 * 
 * Since we have a proper index on table text, we reload the database row by text.
 */
function getKategorien(){
    $conn=getDbConnection();

    $count=0;
    $result = array();
    $rs = $conn->query("select KategorieID, Kategorie from kategorie");
    foreach($rs as $row){
        $result[$count] = $row["Kategorie"];
        $count++;
    }
    $conn=NULL;

    return $result;
}

/**
 * Gibt alle fragen anhand der kategorie wieder.
 * We do not send the database id to the WebUI, for securtiy reasons. 
 * 
 * Since we have a proper index on table text, we reload the database row by text.
 */
function getFragenByKategorie($kategorie){
    $conn=getDbConnection();

    $count=0;
    $result = array();
    $rs = $conn->query("select Frage from fragen
    JOIN kategorie ON kategorie.KategorieID = fragen.FK_Kategorie
    WHERE kategorie.Kategorie = '$kategorie' ");
    foreach($rs as $row){
        $result[$count] = $row["Frage"];
        $count++;
    }
    $conn=NULL;

    return $result;
}

/**
 * Gibt alle fragen anhand antworten wieder. 
 */
function getAntwortenByFrage($frage){
    $conn=getDbConnection();

    $count=0;
    $result = array();
    $rs = $conn->query("SELECT * FROM `antworten`
    JOIN fragen ON fragen.FrageID = antworten.FK_Frage
    WHERE fragen.Frage = '$frage' ");
    foreach($rs as $row){
        $antwortObj = new AntwortObj();
        $antwortObj->text = $row["text"];
        $antwortObj->id = $row["ID"];
        $result[$count] = $antwortObj;
        $count++;
    }
    $conn=NULL;

    return $result;
}

/**
 * Liefert ValidatedAntwort, wenn die Kombination aus antwort und checked richtig ist, ansonsten falsch.
 * 
 * @param $id - ID der Antwort
 * @param $check - true wenn der User die Antwort angehakt hat. Ansonsten NULL.
 */
function checkAntwort($id, $checked){

    

    $cvtChecked = 1;
    if ($checked == NULL){
        $cvtChecked = 0;
    }

    // wenn der User die Antwort nicht gewählt hat, dann keine Prüfung notwendig.
    if($cvtChecked == 0) {
        return null;
    }
    
    

    $conn=getDbConnection();
    $rs = $conn->query("SELECT ID FROM antworten WHERE ID = $id AND richtig = $cvtChecked");
    
    //Wenn Antwort count >0, dann richtig sonst falsch.
    $validatedAntwort = new ValidatedAntwort();
    $validatedAntwort->antwortID=$id;    

    
    if ($rs->rowCount() > 0){
        // wenn die Antwort des Users richtig ist, dann alles gut
        $validatedAntwort->richtigeAntwort=$id;
    }else{
        // wenn die Antwort des Users falsch ist, dann suchen wir die richtige Antwort und schreiben sie in das ValidatedAntwort->richtigeAntwort Objekt
        // Diese ID wird dann im Frontend auf grün gesetzt.

        $validatedAntwort->falscheAntwort=$id;

        // Wir suchen nach der FrageID, um alle dazugehörigen Antworten zu finden
        $rsFrage = $conn->query("SELECT FK_Frage FROM `antworten` WHERE antworten.ID = $id");
        foreach($rsFrage as $frageRow){
            $frageID = $frageRow["FK_Frage"];
            
            // mit dieser frageID suchen wir jetzt die korrekte Antwort
            $rsRichtigeAntwort = $conn->query("SELECT ID FROM antworten WHERE FK_Frage=$frageID AND richtig=1");
            foreach($rsRichtigeAntwort as $richtigeAntwortRow){
                 $richtigeAntwortID = $richtigeAntwortRow["ID"];
                 $validatedAntwort->richtigeAntwort=$richtigeAntwortID;
                 break;
            }
            $rsRichtigeAntwort = null;
            break;
        }
        $rsFrage = null;
    }

    $conn=NULL;
    return $validatedAntwort;
}

class AntwortObj {

}

class ValidatedAntwort{
    public $antwortID = -1;
    public $richtigeAntwort = -1;
    public $falscheAntwort = -1;
}

?>