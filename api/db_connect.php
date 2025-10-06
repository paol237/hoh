<?php
// /votre_projet/api/db_connect.php

// Récupération des variables depuis l'environnement.

// Les valeurs par défaut sont basées sur votre configuration locale (hoh_db, utilisateur ong, mdp handonheart)
$default_host = '127.0.0.1';
$default_username = 'ong';
$default_password = 'handonheart';
$default_dbname = 'hoh_db';
$default_port = 3306;

// Utilisation de la fonction getenv() avec une vérification explicite
// Cette méthode est plus robuste si l'opérateur ?: n'est pas supporté ou si getenv() retourne false.
$servername = getenv('DB_HOST');
if (empty($servername)) {
    $servername = $default_host;
}

$username = getenv('DB_USERNAME');
if (empty($username)) {
    $username = $default_username;
}

$password = getenv('DB_PASSWORD');
if (empty($password)) {
    $password = $default_password;
}

$dbname = getenv('DB_DATABASE');
if (empty($dbname)) {
    $dbname = $default_dbname;
}

$port = getenv('DB_PORT');
if (empty($port)) {
    $port = $default_port;
}

// --- DEBUG LOCAL ---
// Ceci affichera les valeurs utilisées dans le code source HTML (à commenter après le debug)
/*
echo "<!-- DEBUG DB: HOST=$servername, USER=$username, DB=$dbname -->";
*/
// -------------------

// Connexion à la base de données
// Note : Le port est ajouté comme 5ème argument.
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Vérification de la connexion
if ($conn->connect_error) {
    // Si APP_DEBUG est 'true' (ou si l'environnement le permet), affichez l'erreur complète.
    $error_message = "Une erreur de connexion à la base de données est survenue.";
    if (getenv('APP_DEBUG') === 'true' || $username === $default_username) { 
        $error_message = "La connexion à la base de données a échoué: " . $conn->connect_error;
    }
    
    // Journalise l'erreur et assure que $conn est null pour la gestion d'erreur dans le code appelant.
    error_log($error_message);
    $conn = null;
    
} else {
    // Connexion réussie
    $conn->set_charset("utf8mb4");
}

// Maintenant, $conn est prêt à être utilisé pour vos requêtes.
?>
