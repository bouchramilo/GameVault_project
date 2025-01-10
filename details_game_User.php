<?php
require 'classes/admin.Class.php';
require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/personne.Class.php';
require_once 'classes/user.Class.php';
require_once 'classes/critique.Class.php';

session_start();

$admin = new Admin();
if (isset($_GET['id_game'])) {
    // echo 'azerty' . $_GET['id_game'];
    $game = $admin->detailsGame($_GET['id_game']);
}


$critic = new critique();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_critique'])) {
    $critique = $critic->addCritique($_GET['id_game'], $_POST['critique']);
}

$AllCritique = $critic->getAllCritiquesForGame($_GET['id_game']);

$utilisateur = new user();

$isBanner = $utilisateur->isBanner($_SESSION['ID_user']);

?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Jeu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .screenshots.active {
            border: 3px solid#da627d;
            transform: scale(1.1);
        }


        .screenshots {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .screenshots:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 10px rgba(166, 47, 170, 0.5);
        }
    </style>
</head>

<body class="bg-gray-900 text-white font-sans w-full ">
    <section class="relative h-max min-h-screen overflow-hidden pb-10">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay loop muted playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>
        <div class="relative z-10 flex flex-row gap-4 h-max text-center text-white bg-black bg-opacity-30">
            <div class="w-1/5 h-full">
                <?php require_once "menu_user.php"; ?>
            </div>

            <div class="w-4/5 h-full pr-4">
                <main class=" w-full mx-auto pr-0 p-6  rounded-lg shadow-lg mt-8 grid grid-cols-[100%] justify-end">
                    <section class="flex flex-wrap w-4/5 gap-6">
                        <div class="w-full sm:w-1/3">
                            <img src="images/Paner.jpg" alt="Image principale du jeu" class="w-full rounded-lg shadow-lg">
                        </div>

                        <div class="flex-1 text-start items-start justify-start">
                            <h2 class="text-3xl font-bold text-[#da627d] mb-4">Détails du Jeu</h2>
                            <ul class="space-y-2 ">
                                <li><strong>Nom :</strong> <?= htmlspecialchars($game["title"]); ?></li>
                                <li><strong>Catégorie :</strong> <?= htmlspecialchars($game["genre"]); ?></li>
                                <li><strong>Date de sortie :</strong> <?= htmlspecialchars($game["releaseDate"]) ?></li>
                                <li><strong>Createur :</strong> <?= htmlspecialchars($game["first_name"]) . " " . htmlspecialchars($game["last_name"]) ?></li>
                                <li><strong>Prix :</strong> <?= htmlspecialchars($game["price"]) ?> DH</li>
                            </ul>
                            <p class="description mt-4">
                                <?= htmlspecialchars($game["details"]) ?> </p>
                            <div class="mt-6 flex gap-4">
                                <button class="bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d]  transition">
                                    Jouer
                                </button>
                                <button class="bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d]  transition">
                                    Acheter le Jeu
                                </button>
                                <button class=" ajout bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d] transition">
                                    Ajouter au bibliotheque
                                </button>
                            </div>
                        </div>
                    </section>

                    <section class="mt-12 text-center">
                        <h2 class="text-3xl font-bold text-[#da627d] mb-6">Screenshots</h2>
                        <div class="flex flex-col items-center gap-6">
                            <div class="relative w-[70%] h-[500px] rounded-lg overflow-hidden shadow-lg">
                                <img id="current-screenshot" src="images/Paner.jpg" alt="Capture 1" class="w-full h-full object-[length:100%_100%]">
                                <p id="screenshot-caption" class="absolute bottom-0 bg-black bg-opacity-75 text-2xl text-white w-full py-2 text-left px-4">
                                    Decrire 1 er Screen
                                </p>
                            </div>

                            <div class="flex gap-6 overflow-x-auto  p-4">
                                <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="images/Paner.jpg" alt="" data-caption="Decrire 1 er Scren">
                                <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1928870/ss_4dba4e59eabcf5c3631e5c28b52ffcae46d3bad8.600x338.jpg?t=1717003087"
                                    alt="" data-caption="Decrire 2 eme Screen">
                                <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1928870/ss_65720eb73a2dd8fc993172cfbfcdc8fe40ec44c2.600x338.jpg?t=1717003087"
                                    alt="" data-caption="Decrire 3 eme Screen">
                                <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="images/Minecraft.jpg" alt="" data-caption="Decrire 4 eme Screen">
                                <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/230410/ss_2e4077f215eccde84171a4b8e0f2bc8a3264c776.600x338.jpg" alt=""
                                    data-caption="Decrire 5 eme Screen">
                                <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="images/Minecraft.jpg" alt="" data-caption="Decrire 6 eme Screen">

                            </div>
                        </div>
                    </section>

                    <!-- critique -->
                    <section class="flex flex-row  w-full">

                        <div class="mt-12 text-center w-2/5 bg-yellow-500">
                            <!-- chate -->
                        </div>
                        <div class="mt-12 text-center w-3/5 ">
                            <h2 class="text-3xl font-bold text-[#da627d] mb-6">Avis des Joueurs : </h2>
                            <div class="flex flex-col items-center gap-6 min-h-96 pb-6">
                                <!-- <div id="reviews-container" class="mt-6 space-y-4"> -->
                                <!-- <h3 class="text-xl font-semibold text-gray-800">Avis des Joueurs :</h3> -->
                                <form id="" method="post" class="space-y-4 w-3/4">
                                    <div>
                                        <label for="comment" class="block text-gray-300 text-start mb-2 font-medium">Ajouter votre critique</label>
                                        <textarea
                                            <?php if ($isBanner['banner'] === 1) {
                                                echo 'disabled';
                                            } ?>
                                            id="comment"
                                            name="critique"
                                            rows="4"
                                            class="w-full bg-gray-700 resize-none border-0 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#da627d]"
                                            placeholder="Votre avis sur le jeu..."
                                            required></textarea>
                                    </div>


                                    <button
                                        name="add_critique" <?php if ($isBanner['banner'] === 1) {
                                                                echo 'disabled';
                                                            } ?>
                                        class="w-2/4 bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d] transition">
                                        Soumettre
                                    </button>
                                </form>
                                <?php foreach ($AllCritique as $critique): ?>
                                    <div class="bg-gray-700 rounded-lg p-4 shadow-md w-3/4">
                                        <div class="text-gray-300 flex gap-6 h-10">
                                            <img src="images/<?= $critique['photo'] ?>" alt="" class="w-10 border-none rounded-full">
                                            <span class="font-bold"><?= $critique['user_full_name'] ?></span>
                                            <span><?= $critique['create_at'] ?></span>
                                        </div>
                                        <p class="text-gray-300 pl-12 text-start"><?= $critique['content'] ?></p>
                                    </div>
                                <?php endforeach; ?>
                                <!-- </div> -->
                            </div>
                        </div>

                    </section>
                </main>
            </div>

    </section>


    <script>
        const screenshots = document.querySelectorAll('.screenshots');
        const mainImage = document.getElementById('current-screenshot');
        const caption = document.getElementById('screenshot-caption');
        screenshots.forEach((screenshot) => {
            screenshot.addEventListener('click', () => {
                mainImage.src = screenshot.src;
                caption.textContent = screenshot.getAttribute('data-caption');
                screenshots.forEach((scr) => scr.classList.remove('active'));
                screenshot.classList.add('active');
            });
        });
    </script>
</body>

</html>