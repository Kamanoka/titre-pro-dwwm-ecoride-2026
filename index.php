<?php $title = "Accueil"; ?>
<?php include 'includes/header.php'; ?>

<main class="container mx-auto px-4 py-12">
    <section class="text-center py-16">
        <h2 class="text-5xl font-bold text-emerald-700 mb-6">Déplacez-vous responsablement</h2>
        <p class="text-xl text-gray-600 mb-10 max-w-3xl mx-auto">
            Rejoignez la communauté EcoRide et réduisez votre empreinte carbone en partageant vos trajets. 
            Priorité aux véhicules électriques et aux conducteurs respectueux de l'environnement.
        </p>

        <!-- Barre de recherche -->
        <div class="bg-white p-8 rounded-2xl shadow-xl max-w-4xl mx-auto">
            <form action="recherche.php" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="depart" placeholder="Ville de départ" required class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-500">
                <input type="text" name="arrivee" placeholder="Ville d'arrivée" required class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-500">
                <input type="date" name="date" required class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-500">
                <button type="submit" class="bg-emerald-600 text-white font-semibold py-3 rounded-lg hover:bg-emerald-700 transition">
                    Rechercher un trajet
                </button>
            </form>
        </div>

        <!-- Images présentation (exemples Unsplash) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
            <img src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?w=600" alt="Voiture électrique" class="rounded-xl shadow-lg">
            <img src="https://images.unsplash.com/photo-1518791841217-8f162f1e1131?w=600" alt="Covoiturage" class="rounded-xl shadow-lg">
            <img src="https://images.unsplash.com/photo-1508514177223-4af1a2c3b3a9?w=600" alt="Route écologique" class="rounded-xl shadow-lg">
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
