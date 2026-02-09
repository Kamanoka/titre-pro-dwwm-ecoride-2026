<?php
session_start();

try {
    $pdo = new PDO('mysql:host=localhost;dbname=ecoride;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur BDD : " . $e->getMessage());
}

// Fonction simple pour vérifier si connecté
function estConnecte() {
    return isset($_SESSION['user_id']);
}

function estChauffeur() {
    return estConnecte() && $_SESSION['role'] === 'chauffeur';
}
