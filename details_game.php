<?php
require 'classes/admin.Class.php';
require 'classes/game.Class.php';
require 'classes/chat.Class.php';
require_once 'classes/notation.Class.php';
require_once 'classes/favoris.Class.php';
require_once 'classes/critique.Class.php';
require_once 'classes/user.Class.php';
session_start();

$admin = new Admin();
$notat = new Notation();
$fovoriss = new favoris();

$critic = new critique();
$AllCritique = $critic->getAllCritiquesForGame($_GET['id_game']);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_delete_critique'])) {
    $critique = $critic->deleteCritique($_POST['btn_delete_critique']);

    if ($critique) {
        $id = $_POST['ID_GAME'];
        header("Location: details_game.php?id_game=$id ");
    }
}

if (isset($_GET['id_game'])) {
    echo 'azerty' . $_GET['id_game'];
    $game = $admin->detailsGame($_GET['id_game']);
}

$chat = new Chat();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mymessage'])) {
        $chat->sendMessage($_GET['id_game'], $_POST['mymessage']);
    }
    if (isset($_FILES['screenImage']) && is_uploaded_file($_FILES['screenImage']['tmp_name']) && isset($_POST['screenCaption'])) {

        $image = file_get_contents($_FILES['screenImage']['tmp_name']);
        $imagePath = $_FILES['screenImage']['tmp_name'];
        $imagetype = getimagesize($imagePath);
        if ($imagetype === false) {
            echo "Ce fichier n est pas une image ";
            exit;
        }
        $mimi = $imagetype['mime'];
        $image = base64_encode($image);
        $admin->addScreenshot($_GET['id_game'], $_POST['screenCaption'], $image, $mimi);
    }
}

$chats = $chat->getMessage($_GET['id_game']);
$screenshotsimg = $admin->afficherScreenshot($_GET['id_game']);

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

<body class="bg-gray-800 text-white font-sans ">
    <section class="relative h-max min-h-screen overflow-hidden pb-10">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay loop muted playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>
        <div class="relative z-10 flex flex-row gap-4 h-max text-center text-white bg-black bg-opacity-30">
            <?php include 'menu_admin.php' ?>

            <main class="container mx-auto p-6 rounded-lg shadow-lg mt-8 grid grid-cols-[84%] justify-end">

                <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                <section class="flex flex-wrap gap-6">
                    <div class="w-full sm:w-1/3">
                        <img src="data:<?= $game['mimi']; ?>;base64,<?= $game['photo']; ?>" alt="Image principale du jeu" class="w-full rounded-lg shadow-lg">
                    </div>

                    <!-- Détails du Jeu ======================================================================================================================================================================================== -->
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold text-[#da627d] mb-4">Détails du Jeu</h2>
                        <ul class="space-y-2">
                            <li class="text-start"><strong>Nom :</strong> <?= htmlspecialchars($game["title"]); ?></li>
                            <li class="text-start"><strong>Catégorie :</strong> <?= htmlspecialchars($game["genre"]); ?></li>
                            <li class="text-start"><strong>Date de sortie :</strong> <?= htmlspecialchars($game["releaseDate"]) ?></li>
                            <li class="text-start"><strong>Createur :</strong> <?= htmlspecialchars($game["first_name"]) . " " . htmlspecialchars($game["last_name"]) ?></li>
                            <li class="text-start"><strong>Prix :</strong> <?= htmlspecialchars($game["price"]) ?> DH</li>
                            <li class="w-full flex gap-10  ">
                                <div>
                                    <?php

                                    $not = $notat->getNoteGame($game["id_game"]) ?? null;
                                    $note = is_array($not) && isset($not['note']) ? $not['note'] : 0;
                                    $max_stars = 5;

                                    for ($i = 0; $i < $note; $i++) {
                                        echo '<svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                                                fill="#facc15" />
                                                    </svg>';
                                    }

                                    for ($i = 0; $i < ($max_stars - $note); $i++) {
                                        echo '<svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                                                fill="#ffffff" />
                                                    </svg>';
                                    }
                                    ?>
                                </div>
                                <div>
                                    <span>&#10084;</span> <?php $nbrf = $fovoriss->nbrFavorisForGame($game["id_game"]);
                                                            echo $nbrf['nbrFavorisForAGame'];  ?>
                                </div>
                            </li>
                        </ul>
                        <p class="description mt-4 text-start">
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
                            <button class=" ajout bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d] transition">
                                Ajouter une screen
                            </button>
                        </div>
                    </div>
                </section>

                <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                <!-- Screenshots ======================================================================================================================================================================================== -->
                <section class="mt-12 text-center">
                    <h2 class="text-3xl font-bold text-[#da627d] mb-6">Screenshots</h2>
                    <div class="flex flex-col items-center gap-6">
                        <?php if (count($screenshotsimg) > 0): ?>
                            <div class="relative w-[70%] h-[500px] rounded-lg overflow-hidden shadow-lg">
                                <img id="current-screenshot" src="data:<?= $screenshotsimg[0]['mimi']; ?>;base64,<?= $screenshotsimg[0]['photo']; ?>" alt="Capture 1" class="w-full h-full object-[length:100%_100%]">
                                <p id="screenshot-caption" class="absolute bottom-0 bg-black bg-opacity-75 text-2xl text-white w-full py-2 text-left px-4">
                                    <?= htmlspecialchars($screenshotsimg[0]['descri']) ?>
                                </p>

                            </div>
                        <?php else : ?>
                            <p class="text-gray-500 italic">Aucun screenshort disponible !!! </p>
                        <?php endif; ?>
                        <div class="flex gap-6 overflow-x-auto p-4">
                            <?php foreach ($screenshotsimg as $screenshot): ?>
                                <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer"
                                    src="data:<?= $screenshot['mimi']; ?>;base64,<?= $screenshot['photo']; ?>"
                                    alt="<?= htmlspecialchars($screenshot['descri']) ?>"
                                    data-caption="<?= htmlspecialchars($screenshot['descri']) ?>">
                            <?php endforeach; ?>
                        </div>

                    </div>
                </section>

                <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                <!-- Modal pour ajouter une screen ================================================================================================================================================================================== -->
                <div id="addScreenModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white rounded-lg p-6 w-full max-w-lg">
                        <h3 class="text-2xl font-bold text-[#da627d] mb-4">Ajouter une capture d'écran</h3>
                        <form id="addScreenForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="screenImage" class="block text-gray-700 font-semibold">Capture d'écran</label>
                                <input type="file" id="screenImage" name="screenImage" accept="image/*" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="mb-4">
                                <label for="screenCaption" class="block text-gray-700 font-semibold">Description</label>
                                <textarea id="screenCaption" name="screenCaption" rows="3" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                            </div>
                            <div class="flex justify-end gap-4">
                                <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Annuler</button>
                                <button type="submit" class="bg-[#da627d] text-white px-4 py-2 rounded-lg hover:bg-[#f9dbbd] hover:text-[#da627d] transition">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                <!-- messages et critiques ======================================================================================================================================================================================================= -->
                <section class="w-full min-h-screen flex mt-10 ">
                    <!-- messages +++++++++++++++++++++++++++++++++++++++++++++ -->
                    <div class="w-2/5 max-h-screen">
                        <h2 class="text-3xl text-center font-bold text-[#da627d] mb-6">Chate : </h2>
                        <div class="w-full h-4/5 max-w-md bg-black bg-opacity-70  shadow-md rounded-lg p-4 overflow-y-auto ">
                            <?php if (count($chats) > 0): ?>
                                <?php foreach ($chats as $chat): ?>
                                    <?php if ((int)$_SESSION["ID_user"] === (int)$chat["id_user"]):  ?>

                                        <div class="flex justify-end mb-4">
                                            <div class="text-right">
                                                <p style="color: rgba(109, 27, 112, 0.91);" class=" rounded-lg px-3  text-sm "> <?= htmlspecialchars($chat["first_name"]) . " " . htmlspecialchars($chat["last_name"]) ?> </p>

                                                <p class="bg-[#da627d] text-[#f9dbbd] rounded-lg px-3 py-2 text-sm mb-1">
                                                    <?= htmlspecialchars($chat["message_chat"]) ?>
                                                </p>
                                                <span class="text-xs text-gray-500">
                                                    <?= htmlspecialchars($chat["massage_at"]) ?>
                                                </span>
                                            </div>
                                            <div class="w-8 h-8  flex items-center justify-center text-[#f9dbbd] text-sm font-bold ml-2">
                                                <img class=" rounded-full" src="data:<?= $chat['mimi']; ?>;base64,<?= $chat['photo']; ?>" alt="">
                                            </div>
                                        </div>
                                    <?php else: ?>

                                        <div class="flex justify-start mb-4">
                                            <div class="w-8 h-8 flex items-center justify-center text-white text-sm font-bold mr-2">
                                                <img class=" rounded-full" src="data:<?= $chat['mimi']; ?>;base64,<?= $chat['photo']; ?>" alt="">
                                            </div>
                                            <div>
                                                <p style="color: rgba(109, 27, 112, 0.91);" class=" rounded-lg px-3  text-sm "> <?= htmlspecialchars($chat["first_name"]) . " " . htmlspecialchars($chat["last_name"]) ?> </p>
                                                <p class="bg-[#f9dbbd] text-gray-800 rounded-lg px-3 py-2 text-sm mb-1">
                                                    <?= htmlspecialchars($chat["message_chat"]) ?>
                                                </p>
                                                <span class="text-xs text-gray-500">
                                                    <?= htmlspecialchars($chat["massage_at"]) ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-gray-500 italic">
                                    <h4>Soyez le premier à écrire dans le chat</h4>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <!-- critiques ++++++++++++++++++++++++++++++++++++++++++++ -->
                    <div class="w-3/5 ">
                        <h2 class="text-3xl text-center font-bold text-[#da627d] mb-6">Avis des Joueurs : </h2>
                        <div class="flex flex-col items-center gap-6 min-h-96 pb-6">
                            <?php if (count($AllCritique) > 0): ?>
                                <?php foreach ($AllCritique as $critique): ?>
                                    <div class="bg-gray-700 rounded-lg p-4 shadow-md w-3/4">
                                        <div class="text-gray-300 flex justify-between gap-6 h-10 w-full ">
                                            <div class="flex gap-4">
                                                <img src="images/<?= $critique['photo'] ?>" alt="" class="w-10 border-none rounded-full">
                                                <span class="font-bold"><?= $critique['user_full_name'] ?></span>
                                                <span><?= $critique['create_at'] ?></span>
                                            </div>
                                            <form action="" method="post"><input type="hidden" name="ID_GAME" value="<?= $critique['id_game'] ?>"><button name="btn_delete_critique" value="<?= $critique['id_critique'] ?>" class="w-max h-max p-2 border-none rounded-xl bg-red-600">delete</button></form>
                                        </div>
                                        <p class="text-gray-300 pl-12 text-start"><?= $critique['content'] ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <h4 class="text-gray-500 italic">Pas de discussion pour le moment chat</h4>
                            <?php endif; ?>

                        </div>
                    </div>

                </section>

            </main>
        </div>
    </section>

</body>

<script src="js/screenshorts.js"></script>

</html>