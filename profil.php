<?php
require_once 'classes/personne.Class.php';
// require_once 'classes/admin.Class.php'
session_start();

if (!isset($_SESSION['ID_user'])) {
    header("Location: login.php");
    exit();
}

$profile = new Personne();

if (isset($_POST['deconnexion'])) {
    $profile->logout();
}

$user = $profile->getUser();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['ID_user'];
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $dateNaissance = trim($_POST['date_naissance']);

    $resultMessage = $profile->updateUser($firstName, $lastName, $email, $dateNaissance);

    if (isset($_FILES['upload-photo']) && is_uploaded_file($_FILES['upload-photo']['tmp_name'])) {

        $image = file_get_contents($_FILES['upload-photo']['tmp_name']);
        $imagePath = $_FILES['upload-photo']['tmp_name'];
        $imagetype = getimagesize($imagePath);
        if ($imagetype === false) {
            echo "Ce fichier n est pas une image ";
            exit;
        }
        $mimi = $imagetype['mime'];
        $image = base64_encode($image);
        $profile->updatephoto($image, $mimi);
    }
}

if (!$user) {
    echo "Utilisateur introuvable.";
    exit();
}

$test = new Personne();
?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hover-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(154, 79, 132, 0.3);
        }
    </style>
</head>

<body class="bg-gray-900 text-white font-sans">

    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <?php if ($test->getRole() === "admin") : ?>
        <?php include 'menu_admin.php' ?>
    <?php elseif ($test->getRole() === "user") : ?>
        <?php include 'menu_user.php' ?>
    <?php endif; ?>
    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="grid-cols-[84%] grid justify-end">
        <div class=" py-6">
            <div class="container mx-auto flex justify-end items-center px-6">
                <button id="darkmode" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                    🌗 Mode Dark/Light
                </button>
            </div>
        </div>

        <div class="container mx-auto mt-10 px-6">
            <!-- Profile Card -->
            <section class="bg-gray-800 p-8 rounded-lg shadow-lg relative hover-card transition transform duration-300">
                <form id="myprofil" class="space-y-6" method="POST" enctype="multipart/form-data">

                    <div class="absolute -top-14 left-1/2 transform -translate-x-1/2">

                        <div class="relative w-28 h-28 rounded-full border-4 border-[#da627d] overflow-hidden">
                            <img src="data:<?= $user['mimi']; ?>;base64,<?= $user['photo']; ?>" alt="Photo de profil" class="w-full h-full object-cover">
                            <label for="upload-photo" class="absolute bottom-0 right-0 bg-[#da627d] text-white p-2 rounded-full cursor-pointer ">
                                📷
                            </label>
                            <input type="file" accept="image/*" id="upload-photo" name="upload-photo" class="hidden">
                        </div>
                    </div>
                    <h2 class="text-center text-2xl font-bold mb-20 mt-20"><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h2>
                    <div class="mt-6 space-y-4">
                        <!-- Profile Info -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium pb-2">Prénom :</label>
                                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:ring-2 focus:ring-blue-500" disabled>
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium pb-2">Nom :</label>
                                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:ring-2 focus:ring-blue-500" disabled>
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium pb-2">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:ring-2 focus:ring-blue-500" disabled>
                        </div>
                        <div>
                            <label for="create_at" class="block text-sm font-medium pb-2">Membre depuis :</label>
                            <input type="text" id="create_at" name="create_at" value="<?php echo htmlspecialchars($user['create_at']); ?>" readonly class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-gray-400">
                        </div>
                        <div>
                            <label for="date_naissance" class="block text-sm font-medium pb-2">Date de naissance :</label>
                            <input type="date" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($user['date_naissance']); ?>" class="w-full p-3 rounded bg-gray-700 border border-gray-600 text-white focus:ring-2 focus:ring-blue-500" disabled>
                        </div>
                        <button type="button" id="modifier" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-500 transition">
                            Modifier
                        </button>
                        <button type="submit" id="save" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-500 transition hidden">
                            💾 Sauvegarder les modifications
                        </button>
                    </div>
                </form>
            </section>
        </div>
        </section>

        <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <!-- Account Settings -->
        <section class="mt-10 grid grid-cols-1 md:grid-cols-2 ml-6 gap-6">
            <div class="bg-gradient-to-tr from-gray-700 via-gray-800 to-gray-900 p-6 rounded-lg shadow-lg hover-card">
                <h3 class="text-xl font-bold text-yellow-400 mb-4">Paramètres du compte</h3>
                <p class="text-gray-400 mb-6">Désactivez temporairement votre compte si vous prenez une pause.</p>
                <button class="w-full bg-yellow-500 text-white py-3 rounded hover:bg-yellow-400 transition">
                    ⚠️ Désactiver temporairement
                </button>
            </div>
            <div class="bg-gradient-to-tr from-gray-700 via-gray-800 to-gray-900 p-6 rounded-lg shadow-lg hover-card">
                <h3 class="text-xl font-bold text-red-500 mb-4">Supprimer mon compte</h3>
                <p class="text-gray-400 mb-6">Cette action est irréversible. Tous vos données seront supprimées.</p>
                <button class="w-full bg-red-600 text-white py-3 rounded hover:bg-red-500 transition">
                    🗑️ Supprimer définitivement
                </button>
            </div>
        </section>
    </div>


    <script>
        const DarkLight = document.getElementById('darkmode');
        DarkLight.addEventListener('click', () => {
            document.body.classList.toggle('bg-gray-900');
            document.body.classList.toggle('bg-gray-100');
            document.body.classList.toggle('text-white');
            document.body.classList.toggle('text-black');
        });

        const btnmodifier = document.getElementById('modifier');
        const btnsave = document.getElementById('save');
        const formElements = document.querySelectorAll('#myprofil input');

        btnmodifier.addEventListener('click', () => {
            formElements.forEach(input => input.disabled = false);
            btnmodifier.classList.add('hidden');
            btnsave.classList.remove('hidden');
        });
    </script>
</body>

</html>