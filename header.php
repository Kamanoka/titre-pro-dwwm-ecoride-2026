<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoRide - <?= $title ?? 'Covoiturage écologique' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-green-50 min-h-screen flex flex-col">

<header class="bg-emerald-700 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="index.php" class="text-2xl font-bold">EcoRide 🌿</a>
        <nav class="space-x-6">
            <a href="index.php" class="hover:text-emerald-200">Accueil</a>
            <a href="recherche.php" class="hover:text-emerald-200">Covoiturages</a>
            <?php if (estConnecte()): ?>
                <a href="espace.php" class="hover:text-emerald-200">Mon espace</a>
                <a href="deconnexion.php" class="hover:text-emerald-200">Déconnexion</a>
            <?php else: ?>
                <a href="connexion.php" class="hover:text-emerald-200">Connexion</a>
                <a href="inscription.php" class="hover:text-emerald-200">Inscription</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main class="flex-grow max-w-7xl mx-auto px-4 py-8">
