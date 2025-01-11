<?php
require 'classes/admin.Class.php';
require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/personne.Class.php';
require_once 'classes/user.Class.php';
require_once 'classes/critique.Class.php';
require_once 'classes/chat.Class.php';
require_once 'classes/notation.Class.php';
require_once 'classes/favoris.Class.php';

session_start();

$admin = new Admin();
$chat = new Chat();
$critic = new critique();
$utilisateur = new user();
$notat = new Notation();
$fovoriss = new favoris();

if (isset($_GET['id_game'])) {
    // echo 'azerty' . $_GET['id_game'];
    $game = $admin->detailsGame($_GET['id_game']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mymessage'])) {
        $chat->sendMessage($_GET['id_game'], $_POST['mymessage']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_critique'])) {
    $critique = $critic->addCritique($_GET['id_game'], $_POST['critique']);
}

$AllCritique = $critic->getAllCritiquesForGame($_GET['id_game']);
$isBanner = $utilisateur->isBanner($_SESSION['ID_user']);
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

<body class="bg-[#121e31] text-white font-sans w-full ">
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

                    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
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

                    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
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
                            <?php else: ?>
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
                    <!-- critique et cahes -->
                    <section class="flex flex-row  w-full">

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
                            <form id="chat-form" class="flex max-w-md gap-2 mt-4" method="POST">
                                <input name="mymessage"
                                    type="text"
                                    <?php if ($isBanner['banner'] === 1) {
                                        echo 'disabled';
                                    } ?>
                                    id="chat-input"
                                    class="flex-1 border bg-black bg-opacity-80 border-[#da627d] text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#da627d]"
                                    placeholder="Type your message..."
                                    required>
                                <button
                                    type="submit"
                                    <?php if ($isBanner['banner'] === 1) {
                                        echo 'disabled';
                                    } ?>
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                                    Send
                                </button>
                            </form>
                            <!-- </div> -->

                        </div>

                        <!-- critique +++++++++++++++++++++++++++++++++++++++++++++ -->
                        <div class="mt-12 text-center w-3/5 ">
                            <h2 class="text-3xl font-bold text-[#da627d] mb-6">Avis des Joueurs : </h2>
                            <div class="flex flex-col items-center gap-6 min-h-96 pb-6">
                                <form id="" method="post" class="space-y-4 w-3/4">
                                    <div>
                                        <label for="comment" class="block text-gray-300 text-start mb-2 font-medium">Ajouter votre critique</label>
                                        <textarea
                                            <?php if ($isBanner['banner'] === 1 || $critic->isAlreadyCritique($game["id_game"])) {
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
                                        name="add_critique"
                                        <?php if ($isBanner['banner'] === 1 || $critic->isAlreadyCritique($game["id_game"])) {
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
                            </div>
                        </div>

                    </section>


                </main>

            </div>

    </section>

</body>

<script src="js/screenshorts.js"></script>

</html>