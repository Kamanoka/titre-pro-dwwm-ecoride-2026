<?php $title = "Inscription"; include 'includes/header.php'; include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = trim($_POST['pseudo']);
    $email = trim($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (pseudo, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$pseudo, $email, $pass])) {
        header("Location: connexion.php?success=1");
        exit;
    } else {
        $error = "Erreur lors de l'inscription (pseudo/email déjà pris ?)";
    }
}
?>

<h1 class="text-4xl font-bold text-center mb-10 text-emerald-800">Inscription</h1>

<?php if (isset($error)): ?>
    <p class="bg-red-100 text-red-700 p-4 rounded mb-6 max-w-md mx-auto"><?= $error ?></p>
<?php endif; ?>

<form method="POST" class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg space-y-6">
    <input type="text" name="pseudo" placeholder="Pseudo" required class="w-full border rounded-lg px-4 py-3">
    <input type="email" name="email" placeholder="Email" required class="w-full border rounded-lg px-4 py-3">
    <input type="password" name="password" placeholder="Mot de passe" required class="w-full border rounded-lg px-4 py-3">
    <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700">S'inscrire</button>
</form>

<?php include 'includes/footer.php'; ?>
