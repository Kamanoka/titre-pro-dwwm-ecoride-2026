<?php $title = "Détail du trajet"; include 'includes/header.php'; include 'includes/db.php';

if (!isset($_GET['id'])) header("Location: recherche.php");

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT t.*, u.pseudo, v.marque, v.modele, v.energie, v.places FROM trajets t 
    JOIN users u ON t.chauffeur_id = u.id 
    JOIN vehicules v ON t.vehicule_id = v.id 
    WHERE t.id = ?");
$stmt->execute([$id]);
$trajet = $stmt->fetch();

if (!$trajet) header("Location: recherche.php");

$avis_stmt = $pdo->prepare("SELECT a.note, a.commentaire, u.pseudo FROM avis a JOIN users u ON a.auteur_id = u.id WHERE trajet_id = ? AND valide = 1");
$avis_stmt->execute([$id]);
$avis = $avis_stmt->fetchAll();
?>

<h1 class="text-4xl font-bold text-center mb-10 text-emerald-800">Détail du trajet</h1>

<div class="bg-white rounded-2xl shadow-xl p-8 max-w-4xl mx-auto">
    <h2 class="text-3xl font-semibold text-emerald-700"><?= htmlspecialchars($trajet['depart_ville']) ?> → <?= htmlspecialchars($trajet['arrivee_ville']) ?></h2>
    <p class="text-gray-600 mt-2 text-lg">
        Le <?= date('d/m/Y', strtotime($trajet['date_depart'])) ?> à <?= date('H:i', strtotime($trajet['heure_depart'])) ?>
    </p>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p><strong>Chauffeur :</strong> <?= htmlspecialchars($trajet['pseudo']) ?></p>
            <p><strong>Véhicule :</strong> <?= htmlspecialchars($trajet['marque'] . ' ' . $trajet['modele']) ?> (<?= $trajet['energie'] ?>)</p>
            <p><strong>Prix :</strong> <?= number_format($trajet['prix'], 2) ?> €</p>
            <p><strong>Places restantes :</strong> <?= $trajet['places_restantes'] ?></p>
            <p><strong>Écologique :</strong> <?= $trajet['energie'] === 'electrique' ? 'Oui' : 'Non' ?></p>
        </div>
        <div>
            <h3 class="text-xl font-semibold mb-4">Avis du chauffeur</h3>
            <?php if (empty($avis)): ?>
                <p class="text-gray-500">Aucun avis validé pour l'instant.</p>
            <?php else: ?>
                <?php foreach ($avis as $a): ?>
                    <div class="border-b py-3">
                        <p><strong><?= htmlspecialchars($a['pseudo']) ?></strong> - <?= $a['note'] ?>/5</p>
                        <p class="text-gray-600"><?= nl2br(htmlspecialchars($a['commentaire'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if (estConnecte() && $trajet['places_restantes'] > 0): ?>
        <a href="#" onclick="if(confirm('Confirmer votre participation ?')) location.href='espace.php?action=participer&id=<?= $id ?>';" class="mt-8 block bg-emerald-600 text-white text-center py-4 rounded-xl font-bold text-lg hover:bg-emerald-700">
            Participer (utilise <?= $trajet['prix'] ?> crédits)
        </a>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
