<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Benutzerbereich</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Willkommen, <?php echo htmlspecialchars($_SESSION['benutzername']); ?>!</h2>
    <p>Du bist als normaler Benutzer eingeloggt. Um das Lösungswort zu bekommen brauchst du einen anderen Benutzer :D</p>
    <a href="logout.php">Logout</a>
</body>
</html>