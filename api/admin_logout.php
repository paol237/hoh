<?php
// /votre_projet/admin/admin_logout.php
session_start();
require_once 'auth_functions.php';

// Appel simple de la fonction de déconnexion
logout(); 
?>