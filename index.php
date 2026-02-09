<?php $title = "Accueil"; include 'includes/header.php'; include 'includes/db.php'; ?>

<div class="text-center py-16">
    <h1 class="text-5xl font-bold text-emerald-800 mb-6">Voyagez écolo, ensemble</h1>
    <p class="text-xl text-gray-700 max-w-3xl mx-auto mb-10">
        Réduisez votre empreinte carbone en covoiturant avec EcoRide.
        Priorité aux véhicules électriques et aux trajets partagés.
    </p>

    <form action="recherche.php" method="GET" class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="text" name="depart" placeholder="Ville de départ" required class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-emerald-500 focus:border-emerald-500">
        <input type="text" name="arrivee" placeholder="Ville d'arrivée" required class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-emerald-500 focus:border-emerald-500">
        <input type="date" name="date" required class="border border-gray-300 rounded-lg px-4 py-3 focus:ring-emerald-500 focus:border-emerald-500">
        <button type="submit" class="bg-emerald-600 text-white font-semibold py-3 rounded-lg hover:bg-emerald-700">Rechercher</button>
    </form>

    <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Images exemples -->
        <img src="https://images.unsplash.com/photo-1503387762-592deb58caa5?w=800" alt="Voiture électrique" class="rounded-xl shadow-lg">
        <img src="https://images.unsplash.com/photo-1567808291548-fc3ee04dbcf0?w=800" alt="Covoiturage" class="rounded-xl shadow-lg">
        <img src="https://images.unsplash.com/photo-1449452198679-0143d8c25d4d?w=800" alt="Nature" class="rounded-xl shadow-lg">
    </div>
</div>

<?php include 'includes/footer.php'; ?>
