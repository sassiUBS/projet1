<?php
//Afficher une liste de contacts stockés dans une base de données MySQL, dans un tableau HTML 
//Partie PHP :Connexion à la base de données
$host = 'localhost';
$dbname = 'ma_base';
$user = 'root';
$pass = '';
//Tentative de connexion avec PDO (PHP Data Object) est une méthode sécurisé/
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
//Requête SQL et récupération des données:fetchAll(PDO::FETCH_ASSOC) permet de récupérer les résultats sous forme de tableau clé , valeur, une ligne par contact.-->
$sql = "SELECT * FROM contact_ensibs ORDER BY date_envoi DESC";
$stmt = $pdo->query($sql);
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des contacts ENSIBS</title>
    <style>
        table { border-collapse: collapse; width: 90%; margin: auto; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Liste des prises de contact ENSIBS</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date de naissance</th>
            <th>Formation</th>
            <th>Année</th>
            <th>Langues</th>
            <th>Demande</th>
            <th>Date d'envoi</th>
        </tr>
<!--Affichage dynamique des lignes:foreach:parcourt chaque contact td cellule par cellule-->
<!--htmlspecialchars()  éviter les failles (sécurité).-->
<!--nl2br() transforme les retours à la ligne en balises <br>, utile pour la colonne "Demande".-->

        <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= htmlspecialchars($contact['id']) ?></td>
            <td><?= htmlspecialchars($contact['nom']) ?></td>
            <td><?= htmlspecialchars($contact['prenom']) ?></td>
            <td><?= htmlspecialchars($contact['email']) ?></td>
            <td><?= htmlspecialchars($contact['date_naissance']) ?></td>
            <td><?= htmlspecialchars($contact['formations']) ?></td>
            <td><?= htmlspecialchars($contact['annee']) ?></td>
            <td><?= htmlspecialchars($contact['langues']) ?></td>
            <td><?= nl2br(htmlspecialchars($contact['demande'])) ?></td>
            <td><?= $contact['date_envoi'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>