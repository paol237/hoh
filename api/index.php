<?php
// Fichier: /ONG/api/admin_login.php (Hypothèse de chemin)
session_start();

// Si l'utilisateur est déjà connecté, rediriger vers le tableau de bord
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Redirection corrigée : remonter (../) puis descendre dans admin/
    header('Location: admin_dashboard.php'); 
    exit;
}

$error_message = '';
// Inclure le fichier de connexion à la base (db_connect.php est dans le même dossier api/)
require_once 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        $username = $conn->real_escape_string($_POST['username']);
        $password = $_POST['password']; // Le mot de passe entré par l'utilisateur

        $sql = "SELECT id, nom_utilisateur, mot_de_passe, role FROM utilisateurs WHERE nom_utilisateur = ?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
                // **** CORRECTION CRITIQUE (Comparaison de mot de passe en clair) ****
                // AVERTISSEMENT : C'EST NON SÉCURISÉ. Changer votre mot de passe en hash est la seule solution sûre.
                if($password === $user['mot_de_passe']) {
                    
                    // Connexion réussie : enregistrer les variables de session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['nom_utilisateur'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['logged_in'] = true;
                    
                    // Redirection corrigée : remonter (../) puis descendre dans admin/
                    header('Location: admin_dashboard.php');
                    exit;
                } else {
                    $error_message = "Mot de passe incorrect.";
                }
            } else {
                $error_message = "Nom d'utilisateur non trouvé.";
            }
            $stmt->close();
        } else {
            $error_message = "Erreur interne du serveur.";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin - Hand on Heart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styles CSS ici */
        body { background-color: #f8f9fa; }
        .login-container { max-width: 400px; margin-top: 100px; padding: 30px; border: 1px solid #ccc; border-radius: 10px; background-color: white; box-shadow: 0 4px 8px rgba(0,0,0,.05); }
        .login-container h2 { color: #004085; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container mx-auto">
            <h2 class="text-center mb-4">Connexion Administrateur</h2>
            
            <?php if ($error_message): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>
            
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="background-color: #004085; border-color: #004085;">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>