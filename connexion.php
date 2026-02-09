<?php $title = "Connexion"; include 'includes/header.php'; include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['role'] = $user['role'];
        header("Location: espace.php");
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<h1 class="text-4xl font-bold text-center mb-10 text-emerald-800">Connexion</h1>

<?php if (isset($error)): ?>
    <p class="bg-red-100 text-red-700 p-4 rounded mb-6 max-w-md mx-auto"><?= $error ?></p>
<?php endif; ?>

<?php if (isset($_GET['success'])): ?>
    <p class="bg-green-100 text-green-700 p-4 rounded mb-6 max-w-md mx-auto">Inscription réussie ! Connectez-vous.</p>
<?php endif; ?>

<form method="POST" class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg space-y-6">
    <input type="email" name="email" placeholder="Email" required class="w-full border rounded-lg px-4 py-3">
    <input type="password" name="password" placeholder="Mot de passe" required class="w-full border rounded-lg px-4 py-3">
    <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-lg font-semibold hover:bg-emerald-700">Se connecter</button>
</form>

<?php include 'includes/footer.php'; ?>
