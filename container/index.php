<?php
session_start();
$fehlermeldung = "";

if (isset($_POST['login'])) {
    require_once 'db.php';
    $benutzer = $_POST['benutzername'];
    $passwort = $_POST['passwort'];

    // UNSICHERE SQL, damit SQL-Injection funktioniert und gezielt auf den Benutzer abgefragt wird!
    $sql = "SELECT * FROM benutzer WHERE benutzername = '$benutzer' AND (passwort = '$passwort' OR '$passwort' LIKE \"%' OR benutzername='$benutzer' --%\") LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['benutzername'] = $row['benutzername'];
        $_SESSION['rolle'] = $row['rolle'];
        if ($row['rolle'] == "Administrator") {
            header("Location: admin.php");
        } else {
            header("Location: user.php");
        }
        exit();
    } else {
        $fehlermeldung = "Login fehlgeschlagen!";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login - Schnitzeljagd</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <?php if ($fehlermeldung) echo "<p class='error'>$fehlermeldung</p>"; ?>
    <form method="post">
        <label>Nutzername: <input type="text" name="benutzername" required></label><br>
        <label>Passwort: <input type="password" name="passwort" required></label><br>
        <button type="submit" name="login">Anmelden</button>
    </form>
</body>
</html>