<?php
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier et récupérer les données du formulaire
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';
    $date_publication = isset($_POST['date_publication']) ? $_POST['date_publication'] : '';
    $texte1 = isset($_POST['texte1']) ? $_POST['texte1'] : '';
    $texte2 = isset($_POST['texte2']) ? $_POST['texte2'] : '';
    $texte3 = isset($_POST['texte3']) ? $_POST['texte3'] : '';

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portfolio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer la requête SQL sécurisée pour l'insertion
    $sql = "INSERT INTO projets (titre, date_publication, texte1, texte2, texte3, image1, image2, image3)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Préparer le statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Erreur de préparation de la requête SQL : ' . $conn->error);
    }

    // Gestion des fichiers téléchargés
    $uploadDir = "uploads/";
    $uploadedFiles = [];

    // Fonction pour gérer les messages d'erreur d'upload
    function uploadErrorMessage($errorCode) {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return "Le fichier est trop volumineux.";
            case UPLOAD_ERR_FORM_SIZE:
                return "Le fichier est trop volumineux.";
            case UPLOAD_ERR_PARTIAL:
                return "Le fichier n'a été que partiellement téléchargé.";
            case UPLOAD_ERR_NO_FILE:
                return "Aucun fichier n'a été téléchargé.";
            case UPLOAD_ERR_NO_TMP_DIR:
                return "Dossier temporaire manquant.";
            case UPLOAD_ERR_CANT_WRITE:
                return "Échec de l'écriture du fichier.";
            case UPLOAD_ERR_EXTENSION:
                return "Une extension PHP a arrêté le téléchargement du fichier.";
            default:
                return "Erreur inconnue.";
        }
    }

    // Traiter chaque champ d'image
    for ($i = 1; $i <= 3; $i++) {
        $fieldName = "image$i";

        // Vérifier si un fichier a été téléchargé pour ce champ
        if (isset($_FILES[$fieldName])) {
            // Vérifier s'il y a eu une erreur lors du téléchargement
            if ($_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
                $fileName = $_FILES[$fieldName]['name'];
                $fileTmpName = $_FILES[$fieldName]['tmp_name'];

                // Générer un nom de fichier unique
                $newFileName = uniqid() . '_' . $fileName;
                $uploadPath = $uploadDir . $newFileName;

                // Déplacer le fichier téléchargé vers le dossier de destination
                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $uploadedFiles[$fieldName] = $uploadPath;
                } else {
                    echo "Erreur lors du déplacement du fichier $fileName vers $uploadPath.";
                    echo "Code d'erreur: " . $_FILES[$fieldName]['error'];
                }
            } elseif ($_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE) {
                // Aucun fichier n'a été téléchargé pour ce champ
                $uploadedFiles[$fieldName] = null;
            } else {
                // Autres erreurs de téléchargement
                echo "Erreur lors du téléchargement du fichier $fieldName: " . uploadErrorMessage($_FILES[$fieldName]['error']);
                echo "<br>";
            }
        } else {
            // Champ de fichier non trouvé
            $uploadedFiles[$fieldName] = null;
        }
    }

    // Lier les paramètres et exécuter la requête SQL
    $stmt->bind_param('ssssssss', $titre, $date_publication, $texte1, $texte2, $texte3,
                      $uploadedFiles['image1'], $uploadedFiles['image2'], $uploadedFiles['image3']);

    if ($stmt->execute()) {
        echo "Projet ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du projet: " . $stmt->error;
    }

    // Fermer le statement et la connexion
    $stmt->close();
    $conn->close();
}
?>
