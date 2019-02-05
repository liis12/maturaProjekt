<!DOCTYPE html>

<?PHP
    include "functions/functions.php";
    $kategorie = $_GET['kategorie'];

    header('Content-Type: text/html; charset=ISO-8859-1');
    // header('Content-Type: text/html; charset=UTF-8');

?>


<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Titel der Seite | Name der Website</title>

    <script type="text/javascript" src="functions/functions.js"></script>

    <style>
      input[type=radio] + label:before {
        vertical-align: baseline;
        display: inline-block;
      }
      input[type=radio] + label:before {
        background-color: green;
      }
      .richtigeAntwort {
        background-color: green;
      }
      .falscheAntwort {
        background-color: red;
      }
  </style>
  </head>
  <body>

    <h1>Fragen zur Kategorie</h1> <button onclick="location.href='index.php'" value="Kategorienübersicht">Kategorien&uuml;bersicht</button>
    <?php
    //Create all fragen
    //
      foreach(getFragenByKategorie($kategorie) as $frage) {
        echo "<div class='frageContainer'>
        <h2 class='frage'>$frage</h2>";

       echo "<form action=''>";
        foreach(getAntwortenByFrage($frage) as $antwort) {
          // echo "<input id='$antwort->id' class='antwort' type='radio' name='antwort' value='$antwort->text'>$antwort->text<br>";
          echo "<div id='$antwort->id-container' class='antwort-container'>
                  <input id='$antwort->id' class='antwort' type='radio' name='antwort' value='$antwort->text'>
                    <label for='$antwort->id'>$antwort->text</label>
                </div>";

        }
        echo "</form>";
       echo "</div>";
      }

    ?>
  <button onclick='validate()'>&uuml;berpr&uuml;fen</button><button onclick="window.location.reload()" value="Übung neustarten">&Uuml;bung neustarten</button>

      <div id='ergebnis'>
        <!-- innerHTML wird von functions.js gesetzt -->
      </div>  
      </body>
  <footer>Copyright</footer>
</html>
