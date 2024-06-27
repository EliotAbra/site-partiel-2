<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Projets</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="logo-blanc-a.png" type="image/x-icon" />
</head>
<body>
    <header>
        <div style="width: 50%; text-align: right">
        <div logo>
          <a href="accueil.html" class="">
            <img src="logo-blanc-a.png" alt="logo" width="200" class="logo" />
          </a>
        </div>
      </div>
      <div style="width: 50%; text-align: left">
        <a href="accueil.html" class="image-link">
          <h1 class="logo">Eliot ABRAHAM</h1>
        </a>
      </div>
    </header>

    <nav>
        <div class="c6"></div>
      <div class="c7"></div>
      <div class="c8"></div>
      <div class="c9"></div>
      <div class="c10"></div>
      <div class="c11"></div>
      <div class="c12">
        <a href="accueil.html" class="nav-text"
          ><p class="text-zoom">Accueil</p></a
        >
      </div>
      <div class="c13">
        <a href="index.php" class="nav-text"
          ><p class="text-zoom">Mon Portfolio</p></a
        >
      </div>
      <div class="c14">
        <a href="contact.html" class="nav-text"
          ><p class="text-zoom">Contact</p></a
        >
      </div>
      <div class="c15">
        <a href="profil.html" class="nav-text"
          ><p class="text-zoom">Mon profil</p></a
        >
      </div>
    </nav>

    <div class="baniere"></div>

    <div class="space1"></div>

    <div class="container">
        <h2 class="title">Liste des Projets</h2>
        <div class="space3"></div>
        <?php
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

        // Requête SQL pour récupérer les projets triés par titre
        $sql = "SELECT id, titre FROM projets ORDER BY titre";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Affichage des projets
            while($row = $result->fetch_assoc()) {
                echo '<div class="project">';
                echo '<h2>' . $row["titre"] . '</h2>' ;
                echo '<div><a href="project.php?id=' . $row["id"] . '" class="btn-consult"><p class="text-button">Consulter le projet</p></a></div>';
                echo '</>';
            }
        } else {
            echo " <div class='mess'>Aucun projet trouvé.</div> ";
        }
        $conn->close();
        ?>
    </div>

    <footer>
      <div class="text-footer">
        <div class="right-columnf">
            <div class="space2"></div>
          <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
          <div class="space2"></div>
          <p>
            <a href="confidentialité.html" class="text-link"
              >Politique de confidentialité</a
            >
          </p>
          <div class="space2"></div>
          <p>
            <a href="charte-graphique.html" class="text-link"
              >charte graphique</a
            >
          </p>
        </div>
        <div class="left-columnf">
            <div class="space2"></div>
          <p>
            <a href="profil.html" class="text-link">Voir mon Profil</a>
          </p>
          <div class="space2"></div>
          <p>
            <a
              href="https://www.instagram.com/eliot.abra/"
              class="text-link"
              target="_blank"
              >eliot.abra/instagram</a
            >
          </p>
          <div class="space2"></div>
          <p>
            <a
              href="https://www.linkedin.com/in/eliot-abraham-731ba0299/"
              class="text-link"
              target="_blank"
              >eliot.abraham/linkedin</a
            >
          </p>
        </div>
      </div>
    </footer>
</body>
</html>
