<?php
// admin/events/create_event.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $date_evenement = $_POST['date_evenement'] ?? '';
    $heure_evenement = $_POST['heure_evenement'] ?? '';
    $lieu = trim($_POST['lieu'] ?? '');
    $id_utilisateur = $_SESSION['user_id'];
    $image_url = '';

    // --- 1. Gestion de l'Upload d'Image ---
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/events/"; // Créez ce dossier !
        
        // Assurez-vous que le dossier existe et est inscriptible
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES["image"]["name"]);
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $new_file_name = time() . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_file_name;

        // Vérification de la taille et du type de fichier (sécurité)
        if ($_FILES["image"]["size"] > 5000000) { // 5MB max
            $error = "Désolé, votre fichier est trop volumineux.";
        } elseif (!in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $error = "Seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = "../uploads/events/" . $new_file_name; // Chemin relatif pour la base de données
            } else {
                $error = "Erreur lors du téléchargement du fichier.";
            }
        }
    }

    // --- 2. Insertion en Base de Données ---
    if (!$error && $titre && $date_evenement && $lieu) {
        $sql = "INSERT INTO evenements (titre, description, date_evenement, heure_evenement, lieu, image_url, id_utilisateur) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssi", $titre, $description, $date_evenement, $heure_evenement, $lieu, $image_url, $id_utilisateur);

            if ($stmt->execute()) {
                $message = "Événement ajouté avec succès !";
                // Réinitialiser les champs après succès ou rediriger
                // header('Location: manage_events.php'); 
            } else {
                $error = "Erreur SQL : " . $conn->error;
            }
            $stmt->close();
        } else {
            $error = "Erreur de préparation de la requête: " . $conn->error;
        }
    } elseif (!$error) {
        $error = "Veuillez remplir tous les champs obligatoires (Titre, Date, Lieu).";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Événement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include '../../includes/admin_styles.php'; // Fichier de style pour la sidebar ?>
</head>
<body>
    <?php include '../sidebar.php'; // Incluez la sidebar ?>
    
    <div class="content-wrapper p-4">
        <h1>Ajouter un Nouvel Événement</h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="create_event.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre de l'événement *</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_evenement">Date de l'événement *</label>
                    <input type="date" class="form-control" id="date_evenement" name="date_evenement" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="heure_evenement">Heure</label>
                    <input type="time" class="form-control" id="heure_evenement" name="heure_evenement">
                </div>
            </div>

            <div class="form-group">
                <label for="lieu">Lieu *</label>
                <input type="text" class="form-control" id="lieu" name="lieu" required>
            </div>

            <div class="form-group">
                <label for="image">Image (Max 5MB)</label>
                <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-primary" style="background-color: #004085; border-color: #004085;">
                Créer l'événement
            </button>
            <a href="manage_events.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>