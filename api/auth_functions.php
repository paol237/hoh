<?php
// /votre_projet/admin/auth_functions.php

function require_login() {
    // Vérifie si la session est active et l'utilisateur connecté
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // Redirige vers la page de connexion
        header('Location: index.php');
        exit;
    }
    // Optionnel : vérifier le rôle si vous voulez restreindre certaines pages
    // if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'editeur') {
    //     header('Location: admin_login.php?forbidden');
    //     exit;
    // }
}

function logout() {
    // Détruit toutes les variables de session
    $_SESSION = array();
    
    // Si la session utilise des cookies, détruire le cookie de session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Finalement, détruire la session
    session_destroy();
    
    // Rediriger vers la page de connexion
    header('Location: index.php');
    exit;
}
?>