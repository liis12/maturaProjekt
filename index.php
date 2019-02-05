<!DOCTYPE html>

<?php
include "functions/functions.php";

// Umlaute auch als diese darstellen
header('Content-Type: text/html; charset=ISO-8859-1');
// header('Content-Type: text/html; charset=UTF-8');

// createTestData();
// print_r(getKategorien());
?>

<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Titel der Seite | Name der Website</title>
  </head>
  <body>
    <h1>BW-FRAGETOOL</h1>

    <div>Themen</div>
    <ul>
    <?php
      foreach(getKategorien() as $kategorie) {
        echo "<li><a href='fragen.php?kategorie=$kategorie'>$kategorie</a></li>";
      }
    ?>
    </ul>


    <p><div>Beim Klick auf ein Thema beginnt die dazugeh&ouml;rige &Uuml;bung</div></p>
  </body>
  <footer>Copyright</footer>
</html>
