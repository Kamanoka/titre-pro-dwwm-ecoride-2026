<?php $title = "Mon espace"; include 'includes/header.php'; include 'includes/db.php';

if (!estConnecte()) header("Location: connexion.php");

// Simulation action participer (à sécuriser !)
if (isset($_GET['action']) && $_GET['action'] === 'participer' && isset($_GET['id'])) {
    $trajet_id = (int)$_GET['id'];
    // Logique simplifiée : mise à jour places + credits (à améliorer)
    $pdo->prepare("UPDATE trajets SET places_restantes = places_restantes - 1 WHERE id = ?")->execute([$trajet_id]);
    $pdo->prepare("UPDATE users SET credits = credits - ? WHERE id = ?")->execute([10, $_SESSION['user_id']]); // ex 10 crédits
    echo "<p class='bg-green-100 text-green-700 p-4 rounded mb-6'>Participation confirmée !</p>";
}

// Récup trajets proposés / réservés (simplifié)
$mes_trajets = $pdo->query("SELECT * FROM trajets WHERE chauffeur_id = " . $_SESSION['user_id'])->fetchAll();
?>

<h1 class="text-4xl font-bold text-center mb-10 text-emerald-800">Mon espace</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6">Devenir chauffeur</h2>
        <p class="mb-4">Ajoutez votre véhicule et proposez des trajets.</p>
        <!-- Formulaire simplifié -->
        <form method="POST" action="">
            <input type="text" name="marque" placeholder="Marque" class="w-full border rounded-lg px-4 py-3 mb-4">
            <input type="text" name="modele" placeholder="Modèle" class="w-full border rounded-lg px-4 py-3 mb-4">
            <select name="energie" class="w-full border rounded-lg px-4 py-3 mb-4">
                <option value="electrique">Électrique</option>
                <option value="hybride">Hybride</option>
                <option value="essence">Essence</option>
            </select>
            <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg hover:bg-emerald-700">Ajouter véhicule</button>
        </form>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6">Mes trajets</h2>
        <?php if (empty($mes_trajets)): ?>
            <p>Aucun trajet proposé pour l'instant.</p>
        <?php else: ?>
            <ul class="space-y-4">
                <?php foreach ($mes_trajets as $t): ?>
                    <li class="border-b pb-4">
                        <?= htmlspecialchars($t['depart_ville']) ?> → <?= htmlspecialchars($t['arrivee_ville']) ?> 
                        - <?= date('d/m/Y', strtotime($t['date_depart'])) ?>
                        <span class="text-sm text-gray-500">(<?= $t['places_restantes'] ?> places)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
