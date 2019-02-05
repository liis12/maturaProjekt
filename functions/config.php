<?php
$dbURL="localhost";
$dbName="bwltrainer";
$dbUser="root";
$dbPwd="";

function getDbConnection(){

    global $dbURL;
    global $dbName;
    global $dbUser;
    global $dbPwd;

    // <!-- sonst erstelle eine neue Verbindung und mache sie für den späteren Gebrauch global -->
    try {

        $conn = new PDO("mysql:host=$dbURL;dbname=$dbName", $dbUser, $dbPwd);
        $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed:" . $e->getMessage();
    }
}

// function createTestData(){
//     $conn=getDbConnection();
//
//     // lösche alle Tabellen und erstelle Testdaten
//     //
//     $conn->query("delete from antworten");
//     $conn->query("delete from fragen");
//     $conn->query("delete from fragetyp");
//     $conn->query("delete from fragetyp");
//     $conn->query("delete from kategorie");
//
//     // erstelle Kategorien
//     //
//     $conn->query("INSERT INTO `kategorie`(`KategorieID`, `Kategorie`)
//     VALUES (1,'Physik')");
//     $conn->query("INSERT INTO `kategorie`(`KategorieID`, `Kategorie`)
//     VALUES (2,'BWL')");
//     $conn->query("INSERT INTO `kategorie`(`KategorieID`, `Kategorie`)
//     VALUES (3,'Mathe')");
//

//
//     // erstelle fragen und antworten
//     //
//
//     $frageId = 0;
//     $antwortId = 0;
//
//     // frage Weihnachten
//     $frageId++;
//     $conn->query("INSERT INTO `fragen`(`FrageID`, `Frage`, `FK_Kategorie`, `FK_Fragetyp`)
//     VALUES ($frageId, 'Wann ist Weihnachten?', 1, 2)");
//
//     // antworten Weihnachten
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '21.6.',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '24.9.',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '24.12.',$frageId,1)");
//
//     // frage absoluter Nullpunkt
//     $frageId++;
//     $conn->query("INSERT INTO `fragen`(`FrageID`, `Frage`, `FK_Kategorie`, `FK_Fragetyp`)
//     VALUES ($frageId, 'Was ist der absolute Nullpunkt?', 1, 2)");
//
//     // antworten Weihnachten
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '+100',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '0',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, 'exakt -273,15',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, 'ähnlich -273,15. Ein genauer Nullpunkt existiert nicht.',$frageId,1)");
//
//     // frage Mathematik
//     $frageId++;
//     $conn->query("INSERT INTO `fragen`(`FrageID`, `Frage`, `FK_Kategorie`, `FK_Fragetyp`)
//     VALUES ($frageId, 'Wie viel ist 2*3',2,2)");
//
//     // antworten Mathematik
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '5',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '7',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, '6',$frageId,1)");
//
//
//      // frage Politik
//     $frageId++;
//     $conn->query("INSERT INTO `fragen`(`FrageID`, `Frage`, `FK_Kategorie`, `FK_Fragetyp`)
//     VALUES ($frageId,'Wer ist österreichischer Präsident', 3,2)");
//
//     // antworten Mathematik
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, 'Waldheim',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, 'Klestil',$frageId,0)");
//     $antwortId++;
//     $conn->query("INSERT INTO `antworten`(`ID`, `text`, `FK_Frage`, `richtig`)
//     VALUES ($antwortId, 'Van der Bellen',$frageId,1)");
//
//
//     //$conn->close();
// }
?>
