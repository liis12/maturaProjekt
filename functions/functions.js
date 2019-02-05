/**
 * Validiert die Eingaben des Users per AJAX request am Server und sendet die Information richtig/falsch in Form eines JSON zurück.
 */
function validate(){

    // Sammle alle Antworten mittels ID und ob ausgewählt oder nicht.
    //
    var validobj = createValidObj();


    // In diesem Schritt wird das validobj mittel AJAX an validate.php gesendet.
    // validate.php verwendet den Inhalt von validobj um die ausgewählten/nicht ausgewählten Antworten gegen die DB zu prüfen.
    //
    //validat.php sendet ein JSON file per POST respone zurück. Mithilfe dem JSON vom Server wird richtig/falsch Style (CSS Class) je Antwort gesetzt.
    //

    // neues AJAX Objekt erzeugen
    var xhttp = new XMLHttpRequest
    
    // Asynchrone callback function registrieren
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            applyValidationResult(this.response);
        }
    }

    // request öffnen, Daten setzen und senden
    xhttp.open("POST", "functions/validate.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(JSON.stringify(validobj));


   // console.log(JSON.stringify(validobj));
    
}
/**
 * Setzt die Styles richtig/falsch auf den Antworten.
 * 
 * Der Response hat die Informationen welche Fragen wie markiert werden sollen.
 * Richtige Antworten grün und falsche (sofern es diese gibt) rot.
 * 
 * @param responeObj 
 */
function applyValidationResult(responseObj){
    console.log(responseObj);

    // if(alreadyValidated){
    //     document.getElementsByClassName("richtigeAntwort").remove.classList("richtigeAntwort");
    //     document.getElementsByClassName("falscheAntwort").remove.classList("falscheAntwort");
    // alreadyValidated=false;    
    // }
    
    var richtigCount = 0;
    var falschCount = 0;
    // JSON Object mit validation results
    var antwortenObj = JSON.parse(responseObj);

    // Nun setzen wir die neuen Styles
    for(id in antwortenObj) {
        var antwort = antwortenObj[id];

        // Definiere IDs für grün und rot. Richtig und falsch.
        var idGreen = -1;
        var idRed = -1;
        // wenn falscheAntwort === -1, dann ist die Antwort des Users richtig.
        if(antwort.falscheAntwort === -1) {
            idGreen = antwort.antwortID;
        }else{
            // User hat eine falsche Antwort angegeben.
            idGreen = antwort.richtigeAntwort;
            idRed = antwort.falscheAntwort;
        }

        if(idGreen > -1) {
            richtigCount++;
            var greenElement = document.getElementById(idGreen+"-container");
            greenElement.classList.add("richtigeAntwort");
        }

        if(idRed > -1) {
            falschCount++;
            var redElement = document.getElementById(idRed+"-container");
            redElement.classList.add("falscheAntwort");
        }

    }

    document.getElementById("ergebnis").innerHTML = createErgenisHTML(richtigCount, falschCount);

}

function createErgenisHTML(richtigCount, falschCount){
    return "Du hast von "+ getGesamtCount() + " Fragen " + (richtigCount-falschCount) + " richtig beantwortet.";
}

function getGesamtCount(){
    var g = document.getElementsByClassName("frageContainer").length;
    return g;
}

/**
 * Erzeut ein JSON mit einem Eintrag für jede Antwort und den Infos je Antwort - ID und checked.
 */
function createValidObj(){

    // leeres JSON wird erzeugt
    var validobj = {
        // array an Antworten
        antwortObjs : [
        ]
    };

    // finde alle HTML elemente mit der CSS Class "antwort"
    var antworten = document.getElementsByClassName('antwort');
    var i;

    // lese alle elemente durch
    for (i=0; i< antworten.length; i++) {
        // console.log(antworten[i]);
        // erzeuge ein neues leeres Objekt für ID und checked 
        var antwortObj = {};
        antwortObj.id = antworten[i].id;
        antwortObj.checked = antworten[i].checked;
        
        // füge das antwortObj an das Antworten-Array hinzu
        validobj.antwortObjs[i] = antwortObj;
    }
    return validobj;
}



