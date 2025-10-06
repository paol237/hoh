<?php
// admin/events/manage_events.php
session_start();
require_once '../../auth_functions.php'; 
require_once '../../db_connect.php'; 

require_login(); 

$events = [];
$error = '';

// Récupérer tous les événements, triés par date la plus récente
$sql = "SELECT id_evenement, titre, date_evenement, heure_evenement, lieu, date_publication, image_url 
        FROM evenements 
        ORDER BY date_evenement DESC";

$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
} else {
    $error = "Erreur lors de la récupération des événements : " . $conn->error;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gérer les Événements</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php include '../../includes/admin_styles.php'; ?>
    <style>
        .event-img { width: 80px; height: 50px; object-fit: cover; border-radius: 5px; }
    </style>
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <div class="content-wrapper p-4">
        <h1>Gestion des Événements</h1>

        <a href="create_event.php" class="btn btn-success mb-3" style="background-color: #28a745; border-color: #28a745;">
            + Ajouter un nouvel événement
        </a>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if (empty($events)): ?>
            <div class="alert alert-info">Aucun événement n'a encore été publié.</div>
        <?php else: ?>
            <table class="table table-striped table-hover">
                <thead class="bg-primary text-white" style="background-color: #004085 !important;">
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Date & Heure</th>
                        <th>Lieu</th>
                        <th>Publié le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td>
                                <?php if ($event['image_url']): ?>
                                    <img src="<?= htmlspecialchars($event['image_url']) ?>" alt="Image <?= htmlspecialchars($event['titre']) ?>" class="event-img">
                                <?php else: ?>
                                    Aucune
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($event['titre']) ?></td>
                            <td>
                                <?= date('d/m/Y', strtotime($event['date_evenement'])) ?>
                                <?php if ($event['heure_evenement']): ?>
                                    à <?= date('H:i', strtotime($event['heure_evenement'])) ?>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($event['lieu']) ?></td>
                            <td><?= date('d/m/Y', strtotime($event['date_publication'])) ?></td>
                            <td>
                                <a href="edit_event.php?id=<?= $event['id_evenement'] ?>" class="btn btn-sm btn-info">Modifier</a>
                                <a href="delete_event.php?id=<?= $event['id_evenement'] ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                    Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>