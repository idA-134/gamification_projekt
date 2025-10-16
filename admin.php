<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rolle'] != "Administrator") {
    header("Location: index.php");
    exit();
}

$fragen_pool = [
    ['frage' => 'Was bedeutet die Abkürzung „RAM“?', 'antwort' => 'Random Access Memory', 'hinweis' => 'Es ist der Arbeitsspeicher des Computers.'],
    ['frage' => 'Wofür steht das Kürzel „IP“?', 'antwort' => 'Internet Protocol', 'hinweis' => 'Es bezeichnet die Adressierung von Computern im Netz.'],
    ['frage' => 'Wofür steht SQL?', 'antwort' => 'Structured Query Language', 'hinweis' => 'Es ist eine Datenbank-Abfragesprache.'],
    ['frage' => 'Was muss man machen, wenn man ein Netzwerkkabel zusammen bauen will?', 'antwort' => 'Crimpen', 'hinweis' => 'Mit einer speziellen Zange werden die Stecker befestigt.'],
    ['frage' => 'Was überprüft Pakete auf Viren, bevor sie ins Netzwerk gelangen?', 'antwort' => 'Firewall', 'hinweis' => 'Diese schützt das Netzwerk vor unerwünschten Zugriffen.'],
    ['frage' => 'Wofür steht die Abkürzung IT?', 'antwort' => 'Informationstechnik', 'hinweis' => 'Es geht um die Verarbeitung und Speicherung von Daten.'],
    ['frage' => 'Mit was beeinflusst man das Aussehen einer Website?', 'antwort' => 'CSS', 'hinweis' => 'Diese Sprache wird für Design verwendet.'],
    ['frage' => 'Wie viele Schichten hat das OSI Modell?', 'antwort' => '7', 'hinweis' => 'Es gibt diverse Schichten in diesem Netzwerkmodell.'],
    ['frage' => 'Welcher Ausbildungszweig befasst sich hauptsächlich mit dem Entwickeln von Programmen?', 'antwort' => 'Anwendungsentwicklung', 'hinweis' => 'Es geht um Softwareentwicklung.'],
    ['frage' => 'Was nennt man umgangssprachlich das Eindringen in Computersysteme, um Daten zu manipulieren oder zu stehlen?', 'antwort' => 'Hacken', 'hinweis' => 'Das Wort wird oft in Zusammenhang mit IT-Sicherheit verwendet.'],
    ['frage' => 'Was bedeutet die Abkürzung „PC“?', 'antwort' => 'Personal Computer', 'hinweis' => 'Es ist ein Computer für den privaten Gebrauch.'],
    ['frage' => 'Wie nennt man das Betriebssystem von Microsoft?', 'antwort' => 'Windows', 'hinweis' => 'Das meistgenutzte Betriebssystem weltweit.'],
    ['frage' => 'Nenne einen bekannten Browser.', 'antwort' => 'Chrome', 'hinweis' => 'Ein Browser von Google.'],
    ['frage' => 'Womit schützt man einen Benutzer zum einloggen ab?', 'antwort' => 'Passwort', 'hinweis' => 'Ein geheimer Zugangscode.'],
    ['frage' => 'Womit schützt man einen Computer vor Viren?', 'antwort' => 'Antivirus', 'hinweis' => 'Ein Schutzprogramm.'],
    ['frage' => 'Wie nennt man das Gerät, das den Internetzugang zu Hause ermöglicht?', 'antwort' => 'Router', 'hinweis' => 'Es verteilt das Internet im Haus.'],
    ['frage' => 'Was macht man, wenn der Computer „abstürzt“?', 'antwort' => 'Neustarten', 'hinweis' => 'Man schaltet ihn aus und wieder ein.'],
    ['frage' => 'Was ist das Kürzel für den Arbeitsspeicher?', 'antwort' => 'RAM', 'hinweis' => 'Es ist das temporäre Speichergerät des Computers.'],
    ['frage' => 'Wie nennt man das Gerät zur Anzeige von Bildern am Computer?', 'antwort' => 'Monitor', 'hinweis' => 'Du siehst darauf alles, was der Computer anzeigt.'],
    ['frage' => 'Wie heißt das Betriebssystem von Apple-Computern?', 'antwort' => 'macOS', 'hinweis' => 'Es wird auf Macs genutzt.'],
    ['frage' => 'Wie nennt man das Gerät zur Eingabe von Buchstaben?', 'antwort' => 'Tastatur', 'hinweis' => 'Du tippst damit Buchstaben.'],
    ['frage' => 'Was ist das Standardprotokoll für Webseiten?', 'antwort' => 'HTTP', 'hinweis' => 'Es steht am Anfang jeder Webadresse.'],
    ['frage' => 'Wie nennt man den Hauptprozessor eines Computers?', 'antwort' => 'CPU', 'hinweis' => 'Er führt alle Rechenoperationen aus.'],
    ['frage' => 'Was ist das Kürzel für das kabellose Netzwerk?', 'antwort' => 'WLAN', 'hinweis' => 'Du verbindest dich damit im Haus ohne Kabel.'],
    ['frage' => 'Wie nennt man die Hardware, die Daten dauerhaft speichert?', 'antwort' => 'Festplatte', 'hinweis' => 'Hier werden deine Dateien gespeichert.'],
    ['frage' => 'Wie heißt das Format für komprimierte Dateien?', 'antwort' => 'ZIP', 'hinweis' => 'Es wird zum Packen von Dateien verwendet.'],
    ['frage' => 'Wie nennt man das Gerät zur Aufnahme von Bildern am Computer?', 'antwort' => 'Webcam', 'hinweis' => 'Sie ist meist oben am Monitor eingebaut.'],
    ['frage' => 'Wie heißt das Protokoll zum Versand von E-Mails?', 'antwort' => 'SMTP', 'hinweis' => 'Es wird beim Senden von E-Mails verwendet.'],
    ['frage' => 'Wie nennt man die Hauptplatine?', 'antwort' => 'Mainboard', 'hinweis' => 'Hier werden alle Komponenten verbunden.'],
    ['frage' => 'Wie nennt man die Software zum Schutz vor Schadprogrammen?', 'antwort' => 'Antivirus', 'hinweis' => 'Sie schützt deinen Computer vor Viren.'],
    ['frage' => 'Was ist das Kürzel für die Grafikkarte?', 'antwort' => 'GPU', 'hinweis' => 'Sie berechnet die Bilder für den Monitor.'],
    ['frage' => 'Wie nennt man die Schnittstelle zum Anschließen externer Geräte?', 'antwort' => 'USB', 'hinweis' => 'Hier werden Sticks und Drucker angeschlossen.'],
    ['frage' => 'Wie heißt die Software zum Surfen im Internet?', 'antwort' => 'Browser', 'hinweis' => 'Damit öffnest du Webseiten.'],
    ['frage' => 'Was ist das Standard-Office-Programm für Tabellen?', 'antwort' => 'Excel', 'hinweis' => 'Damit erstellst du Tabellen.'],
    ['frage' => 'Wie nennt man das Protokoll für sichere Webseiten?', 'antwort' => 'HTTPS', 'hinweis' => 'Es ist eine sichere Variante von HTTP.'],
    ['frage' => 'Wie heißt die Sprache zur Gestaltung von Webseiten?', 'antwort' => 'HTML', 'hinweis' => 'Damit werden Webseiten aufgebaut.'],
];

// Beim ersten Start: 10 zufällige Fragen aus dem Pool ziehen
if (!isset($_SESSION['fragen'])) {
    $fragen_gemischt = $fragen_pool;
    shuffle($fragen_gemischt);
    $_SESSION['fragen'] = array_slice($fragen_gemischt, 0, 10);
    $_SESSION['station_index'] = 0;
    $_SESSION['versuche'] = [];
}

$korrekt = false;
$meldung = "";
$station_index = $_SESSION['station_index'];

// Erst prüfen, ob das Quiz fertig ist!
if (isset($_SESSION['fertig']) && $_SESSION['fertig'] === true) {
    $loesungswort = "Bulettenfett.";
    session_destroy();
    echo "<h2>Glückwunsch!</h2><p>Du hast die Schnitzeljagd beendet.</p><p>Du hast dein Praktikum erfolgreich beendet, das Lösungswort lautet:  <b>$loesungswort</b></p><a href='index.php'>Zurück zum Login</a>";
    exit();
}

// Nur wenn noch Fragen übrig sind, hole die aktuelle Frage!
if ($station_index < count($_SESSION['fragen'])) {
    $frage = $_SESSION['fragen'][$station_index];
    $aktuelle_frage = $frage['frage'];
    // Versuche zählen pro Frage
    if (!isset($_SESSION['versuche'][$station_index])) {
        $_SESSION['versuche'][$station_index] = 0;
    }
}

if (isset($_POST['antwort']) && $station_index < count($_SESSION['fragen'])) {
    $userAntwort = strtolower(trim($_POST['antwort']));
    $richtigeAntwort = strtolower($frage['antwort']);

    if ($userAntwort === $richtigeAntwort) {
        $korrekt = true;
        $_SESSION['station_index']++;
        $_SESSION['versuche'][$station_index + 1] = 0;
        if ($_SESSION['station_index'] >= count($_SESSION['fragen'])) {
            $_SESSION['fertig'] = true;
            // Redirect, damit die Fertig-Seite geladen wird
            header("Location: admin.php");
            exit();
        }
        header("Location: admin.php");
        exit();
    } else {
        $_SESSION['versuche'][$station_index]++;
        $meldung = "Leider falsch, bitte erneut versuchen!";
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Schnitzeljagd - Station <?php echo ($station_index + 1); ?> von 10</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if ($station_index < count($_SESSION['fragen'])): ?>
        <h2>Schnitzeljagd – Station <?php echo ($station_index + 1); ?> von 10</h2>
        <form method="post">
            <p><?php echo $aktuelle_frage; ?></p>
            <input type="text" name="antwort" required autocomplete="off">
            <button type="submit">Antwort überprüfen</button>
        </form>
        <?php if ($meldung) echo "<p class='error'>$meldung</p>"; ?>

        <?php
        // Hinweis ausgeben nach 5 Fehlversuchen
        if ($_SESSION['versuche'][$station_index] >= 5) {
            $hinweis = $frage['hinweis'];
            echo "<script>
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    new Notification('Hinweis zur Frage', { body: '$hinweis' });
                } else if (Notification.permission !== 'denied') {
                    Notification.requestPermission().then(function(permission) {
                        if (permission === 'granted') {
                            new Notification('Hinweis zur Frage', { body: '$hinweis' });
                        }
                    });
                }
            }
            </script>";
            echo "<div style='color: blue; margin-top:10px;'>Hinweis: $hinweis</div>";
        }
        ?>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>
</html>