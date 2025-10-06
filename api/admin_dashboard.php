<?php
// /votre_projet/admin/admin_dashboard.php
session_start();
require_once 'auth_functions.php';

// Cette ligne protège la page : si non connecté, l'utilisateur est redirigé vers admin_login.php
require_login(); 

// Le tableau de bord
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #004085; }
        .nav-link { color: white; }
        .nav-link:hover { background-color: #007bff; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar text-white p-3">
            <h4 class="mb-4">HOH Admin</h4>
            <p>Bienvenue, <?= htmlspecialchars($username) ?>!</p>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="admin_dashboard.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="admin/events/manage_events.php">Gérer les Événements</a></li>
                <li class="nav-item"><a class="nav-link" href="admin/blogs/manage_blogs.php">Gérer les Blogs</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_logout.php">Déconnexion</a></li>
            </ul>
        </div>

        <div class="content p-4 flex-grow-1">
            <h1>Tableau de Bord</h1>
            <p>Rôle : <?= htmlspecialchars($role) ?></p>
            <div class="alert alert-info">
                Utilisez le menu latéral pour gérer le contenu de l'ONG.
            </div>
        </div>
    </div>
</body>
</html>