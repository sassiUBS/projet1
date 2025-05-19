<!--traiter  formulaire HTML et  insérer les données  dans une base de données MySQL.-->
<!--traiter  formulaire HTML et  insérer les données  dans une base de données MySQL.-->
<?php
$host = 'localhost';
$dbname = 'ma_base';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupération sécurisée des données
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$email = htmlspecialchars($_POST['email']);
$date = $_POST['date'];
$formations = htmlspecialchars($_POST['formations']);
$annee = htmlspecialchars($_POST['annee']);
$langues = isset($_POST['langues']) ? $_POST['langues'] : [];
$langues = is_array($langues) ? implode(', ', $langues) : '';
$demande = htmlspecialchars($_POST['demande']);

// Insertion dans la base de données
$sql = "INSERT INTO contact_ensibs 
        (nom, prenom, email, date_naissance, formations, annee, langues, demande, date_envoi)
        VALUES 
        (:nom, :prenom, :email, :date, :formations, :annee, :langues, :demande, NOW())";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':date' => $date,
    ':formations' => $formations,
    ':annee' => $annee,
    ':langues' => $langues,
    ':demande' => $demande
]);

header("Location: liste.php");
exit;
?>
