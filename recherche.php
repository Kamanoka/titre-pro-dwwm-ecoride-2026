<?php $title = "Rechercher un trajet"; include 'includes/header.php'; include 'includes/db.php';

$depart = $_GET['depart'] ?? '';
$arrivee = $_GET['arrivee'] ?? '';
$date = $_GET['date'] ?? '';
$ecologique = isset($_GET['ecologique']) ? 1 : 0;
$prix_max = $_GET['prix_max'] ?? 100;

$where = "places_restantes > 0 AND statut = 'ouvert'";
$params = [];

if ($depart) {
    $where .= " AND depart_ville LIKE ?";
    $params[] = "%$depart%";
}
if ($arrivee) {
    $where .= " AND arrivee_ville LIKE ?";
    $params[] = "%$arrivee%";
}
if ($date) {
    $where .= " AND date_depart = ?";
    $params[] = $date;
}
if ($ecologique) {
    $where .= " AND ecologique = 1";
}
if ($prix_max) {
    $where .= " AND prix <= ?";
    $params[] = $prix_max;
}

$stmt = $pdo->prepare("SELECT t.*, u.pseudo, v.energie FROM trajets t 
    JOIN users u ON t.chauffeur_id = u.id 
    JOIN vehicules v ON t.vehicule_id = v.id 
    WHERE $where ORDER BY date_depart, heure_depart");
$stmt->execute($params);
$trajets = $stmt->fetchAll();
?>

<h1 class="text-4xl font-bold text-center mb-10 text-emerald-800">Trajets disponibles</h1>

<form method="GET" class="bg-white p-6 rounded-xl shadow-lg mb-10 grid grid-cols-1 md:grid-cols-4 gap-4">
    <input type="text" name="depart" value="<?= htmlspecialchars($depart) ?>" placeholder="Départ" class="border rounded-lg px-4 py-3">
    <input type="text" name="arrivee" value="<?= htmlspecialchars($arrivee) ?>" placeholder="Arrivée" class="border rounded-lg px-4 py-3">
    <input type="date" name="date" value="<?= htmlspecialchars($date) ?>" class="border rounded-lg px-4 py-3">
    <div class="flex items-center space-x-2">
        <input type="checkbox" name="ecologique" id="eco" <?= $ecologique ? 'checked' : '' ?> class="h-5 w-5 text-emerald-600">
        <label for="eco" class="text-gray-700">Écologique uniquement</label>
    </div>
    <input type="number" name="prix_max" value="<?= htmlspecialchars($prix_max) ?>" placeholder="Prix max (€)" class="border rounded-lg px-4 py-3">
    <button type="submit" class="md:col-span-4 bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700">Filtrer</button>
</form>

<?php if (empty($trajets)): ?>
    <p class="text-center text-gray-600">Aucun trajet trouvé. Essayez une autre date ou ville.</p>
<?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($trajets as $t): ?>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-2xl transition">
                <h3 class="text-xl font-semibold text-emerald-800"><?= htmlspecialchars($t['depart_ville']) ?> → <?= htmlspecialchars($t['arrivee_ville']) ?></h3>
                <p class="text-gray-600 mt-2">
                    <?= date('d/m/Y', strtotime($t['date_depart'])) ?> à <?= date('H:i', strtotime($t['heure_depart'])) ?>
                </p>
                <p class="mt-4">
                    Chauffeur : <strong><?= htmlspecialchars($t['pseudo']) ?></strong><br>
                    Prix : <strong><?= number_format($t['prix'], 2) ?> €</strong><br>
                    Places restantes : <strong><?= $t['places_restantes'] ?></strong><br>
                    Écologique : <?= $t['energie'] === 'electrique' ? '<span class="text-green-600 font-bold">Oui</span>' : 'Non' ?>
                </p>
                <a href="detail.php?id=<?= $t['id'] ?>" class="mt-4 block bg-emerald-600 text-white text-center py-2 rounded-lg hover:bg-emerald-700">Voir détails</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
