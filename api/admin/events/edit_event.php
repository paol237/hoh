<?php
// admin/events/edit_event.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

$event = null;
$message = '';
$error = '';

// --- 1. Récupération de l'événement à modifier ---
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_evenement = $_GET['id'];
    
    $sql = "SELECT id_evenement, titre, description, date_evenement, heure_evenement, lieu, image_url 
            FROM evenements 
            WHERE id_evenement = ?";
            
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id_evenement);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $event = $result->fetch_assoc();
        } else {
            $error = "Événement non trouvé.";
        }
        $stmt->close();
    } else {
        $error = "Erreur de préparation de la requête de sélection : " . $conn->error;
    }
    
} elseif ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si l'ID manque et qu'on n'est pas en soumission de formulaire
    $error = "ID de l'événement manquant.";
}

// --- 2. Traitement de la soumission du formulaire (Mise à jour) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_evenement'])) {
    $id_evenement = $_POST['id_evenement'];
    $titre = trim($_POST['titre'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $date_evenement = $_POST['date_evenement'] ?? '';
    $heure_evenement = $_POST['heure_evenement'] ?? NULL;
    $lieu = trim($_POST['lieu'] ?? '');
    $current_image_url = $_POST['current_image_url'] ?? '';
    $image_url = $current_image_url; // Par défaut, on garde l'ancienne image

    // --- Gestion de l'Upload de Nouvelle Image ---
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/events/";
        $file_extension = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
        $new_file_name = time() . uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_file_name;

        // Vérifications de sécurité
        if ($_FILES["image"]["size"] > 5000000) { // 5MB max
            $error = "Désolé, la nouvelle image est trop volumineuse.";
        } elseif (!in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $error = "Seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = "uploads/events/" . $new_file_name;
                
                // Supprimer l'ancienne image si elle existe et si elle n'est pas vide
                if (!empty($current_image_url) && file_exists('../../' . $current_image_url)) {
                    unlink('../' . $current_image_url);
                }
            } else {
                $error = "Erreur lors du téléchargement de la nouvelle image.";
            }
        }
    }
    
    // Si l'utilisateur a coché la case pour supprimer l'image
    if (isset($_POST['delete_image']) && $_POST['delete_image'] == 1 && !empty($current_image_url)) {
        if (file_exists('../' . $current_image_url)) {
            unlink('../' . $current_image_url);
        }
        $image_url = NULL; // Mettre le champ de la BD à NULL
    }
    
    // --- Mise à jour de la Base de Données ---
    if (!$error && $titre && $date_evenement && $lieu) {
        $sql = "UPDATE evenements SET titre=?, description=?, date_evenement=?, heure_evenement=?, lieu=?, image_url=? 
                WHERE id_evenement=?";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssi", $titre, $description, $date_evenement, $heure_evenement, $lieu, $image_url, $id_evenement);

            if ($stmt->execute()) {
                $message = "Événement mis à jour avec succès !";
                // Recharger les nouvelles données dans la variable $event pour rafraîchir le formulaire
                $event['titre'] = $titre;
                $event['description'] = $description;
                $event['date_evenement'] = $date_evenement;
                $event['heure_evenement'] = $heure_evenement;
                $event['lieu'] = $lieu;
                $event['image_url'] = $image_url;
            } else {
                $error = "Erreur SQL lors de la mise à jour : " . $conn->error;
            }
            $stmt->close();
        } else {
            $error = "Erreur de préparation de la requête de mise à jour: " . $conn->error;
        }
    }
}
$conn->close();

// Si l'événement n'a pas été chargé ou s'il y a une erreur critique, rediriger
if (!$event && $error) {
    header('Location: manage_events.php?status=error_not_found');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'Événement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include '../../includes/admin_styles.php'; ?>
    <style> .current-img { max-width: 150px; height: auto; margin-top: 10px; border: 1px solid #ccc; } </style>
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <div class="content-wrapper p-4">
        <h1>Modifier l'Événement : <?= htmlspecialchars($event['titre']) ?? 'Chargement...' ?></h1>

        <?php if ($message): ?>
            <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($event): ?>
        <form method="POST" action="edit_event.php?id=<?= $event['id_evenement'] ?>" enctype="multipart/form-data">
            <input type="hidden" name="id_evenement" value="<?= htmlspecialchars($event['id_evenement']) ?>">
            <input type="hidden" name="current_image_url" value="<?= htmlspecialchars($event['image_url']) ?>">
            
            <div class="form-group">
                <label for="titre">Titre de l'événement *</label>
                <input type="text" class="form-control" id="titre" name="titre" 
                       value="<?= htmlspecialchars($event['titre']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($event['description']) ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="date_evenement">Date de l'événement *</label>
                    <input type="date" class="form-control" id="date_evenement" name="date_evenement" 
                           value="<?= htmlspecialchars($event['date_evenement']) ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="heure_evenement">Heure</label>
                    <input type="time" class="form-control" id="heure_evenement" name="heure_evenement"
                           value="<?= htmlspecialchars($event['heure_evenement']) ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="lieu">Lieu *</label>
                <input type="text" class="form-control" id="lieu" name="lieu" 
                       value="<?= htmlspecialchars($event['lieu']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="image">Image actuelle</label><br>
                <?php if ($event['image_url']): ?>
                    <img src="../../<?= htmlspecialchars($event['image_url']) ?>" alt="Image actuelle" class="current-img">
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" name="delete_image" value="1" id="delete_image">
                        <label class="form-check-label" for="delete_image">Supprimer l'image actuelle</label>
                    </div>
                <?php else: ?>
                    <p>Aucune image n'est actuellement définie.</p>
                <?php endif; ?>
                
                <label for="new_image" class="mt-3">Télécharger une nouvelle image (remplacera l'ancienne)</label>
                <input type="file" class="form-control-file" id="new_image" name="image" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-success" style="background-color: #28a745; border-color: #28a745;">
                Enregistrer les modifications
            </button>
            <a href="manage_events.php" class="btn btn-secondary">Retour à la gestion</a>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>