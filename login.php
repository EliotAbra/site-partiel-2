<?php
session_start();

// Définir l'identifiant et le mot de passe
$valid_username = 'eliot';
$valid_password = '123';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        // Authentification réussie
        $_SESSION['loggedin'] = true;
        header('Location: add_project.php');
        exit();
    } else {
        $error = 'Identifiant ou mot de passe incorrect';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connection</title>
    <link rel="stylesheet" href="logins.css">
    <link rel="icon" href="logo-blanc-a.png" type="image/x-icon" />
</head>
<body>
    <div class="container">
        <h1>Connection - Ajouter un Projet</h1>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form action="login.php" method="post">
            <label>Identifiant:</label>
            <input type="text" name="username" required><br><br>
            <label>Mot de passe:</label>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Se connecter">
        </form>
        <div class="space2"></div>
        <div class="text-links">
            <a href="administrateur.html" class="text-link">Retour à la Page Administrateur</a>
        </div>
    </div>
</body>
</html>
