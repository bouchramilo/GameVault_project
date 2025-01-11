<?php

require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/personne.Class.php';
require_once 'classes/library.Class.php';

session_start();

$jeu = new game();
$games = $jeu->getAllGame();

$biblio = new library();


// add game to mylibrary : 
if (isset($_POST['btn_add_to_library'])) {

    if (!isset($_SESSION['ID_user'])) {
        header('Location: login.php');
        exit;
    } else {
        $addToLibraryResult = $biblio->addGameToLibrary($_POST['btn_add_to_library']);

        if ($addToLibraryResult > 0) {
            header('Location: myLibrary.php');
            exit;
        } else {
            echo "Failed to add the game to your library. Please try again.";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>GameVault - HOME</title>
</head>

<body class="bg-[#f9dbbd]">
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->

    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <section class="relative h-screen overflow-hidden">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay
            loop
            muted
            playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>

        <div class="relative z-10 flex flex-col gap-4 items-center justify-center h-full text-center text-white bg-black bg-opacity-30">
            <h1 class="text-4xl font-bold md:text-6xl">GameVault, votre collection à portée de main</h1>
            <p class="mt-4 text-lg md:text-2xl">Favoris, critiques, chat… tout ce dont vous avez besoin au même endroit</p>
            <div class="flex flex-row gap-4 justify-center items-center">
                <a href="signup.php">
                    <button class="w-32 h-12 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 shadow-lg hover:border-2 hover:border-white rounded-sm ">S'inscrire</button>
                </a>
                <p>Ou</p>
                <a href="login.php">
                    <button class="w-32 h-12 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 shadow-lg hover:border-2 hover:border-white rounded-sm ">Se connecter</button>
                </a>
            </div>
        </div>

    </section>


    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <section class="relative h-max overflow-hidden">
        <img src="images/bg_3.jpg" alt="" class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover">
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white bg-black bg-opacity-50">
            <div class="w-full h-max py-4 pl-10 flex flex-col gap-4 justify-start items-start">
                <h1 class="text-3xl font-bold md:text-5xl">Nouveau et tendance</h1>
            </div>

            <div class="h-full w-full grid grid-cols-4 gap-4 p-8 bg-red-00 ">

                <?php foreach ($games as $game) :  ?>
                    <div class="h-96 bg-[#6e2598] bg-opacity-50 border-0 rounded-xl flex flex-col   ">

                        <div class="h-1/2 w-full flex flex-col gap-1 justify-start items-start">
                            <img src="images/game_1.jpg" alt="image game" class="h-full w_full border-0 rounded-t-xl">
                        </div>
                        <div class="h-1/2 w-full flex flex-col gap-1 justify-start items-start p-2">

                            <h2 class=" w-full text-center text-xl font-medium "><?php echo $game['title']; ?></h2>
                            <p class=" text-gray-300 w-full text-start flex flex-row justify-between">Genres : <span class="text-end "><?php echo $game['genre']; ?></span></p>
                            <p class=" text-gray-300 w-full text-start flex flex-row justify-between">date de création : <span class="text-end "><?php echo $game['releaseDate']; ?></span></p>
                            <p class=" text-gray-300 w-full text-start flex flex-row justify-between"> Créateur: <span class="text-end "><?php echo $game['nom_admin']; ?></span></p>

                            <div class="flex flex-row justify-between w-full">
                                <span>&#10084; <?php echo $game['Nbr_Favoris_total']; ?></span>

                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <?php
                                    $note = $game['average_note'];
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
                            </div>

                            <form action="" method="post" class="w-full flex justify-end gap-2">
                                <button name="btn_add_to_library" value="<?php echo $game['id_game']; ?>" class="h-8 w-20 text-white font-medium bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 rounded-sm shadow-lg">
                                    Ajouter
                                </button>
                                <a href="details_game_User.php?id_game=<?= $game["id_game"] ?>" name="btn_show_more_details" value="<?php echo $game['id_game']; ?>" class="flex justify-center items-center h-8 w-20 text-white font-medium bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 rounded-sm shadow-lg">
                                    Détails
                                </a>
                            </form>
                        </div>

                    </div>

                <?php endforeach;  ?>

            </div>

        </div>

    </section>


    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- about app  -->
    <section class="relative h-screen bottom-1 overflow-hidden">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay
            loop
            muted
            playsinline>
            <source src="images/bg_2.mp4" type="video/mp4" />
        </video>
        <div class="relative z-10 flex flex-col gap-4 items-center justify-center h-full text-center text-white bg-black bg-opacity-50">
            <div class="w-full flex flex-col justify-center items-center">
                <img src="images/icones/collection.png" alt="collection">
                <h1 class="text-2xl font-bold md:text-4xl">Vos jeux</h1>
                <p class="mt-4 text-lg md:text-2xl px-96">Organisez vos jeux sur toutes les plateformes en une seule bibliothèque fonctionnelle et magnifique.</p>
            </div>
            <div class="flex flex-row gap-4 justify-center items-center">
                <div class="w-1/3 px-8 flex flex-col justify-center items-center">
                    <img src="images/icones/collection.png" alt="collection">
                    <h1 class="text-xl font-bold md:text-3xl">One library</h1>
                    <p class="mt-4 text-md md:text-lg"> Import all your games from PC and consoles, build and organize them into one master collection. </p>
                </div>
                <div class="w-1/3 px-8 flex flex-col justify-center items-center">
                    <img src="images/icones/collection.png" alt="collection">
                    <h1 class="text-xl font-bold md:text-3xl">Vos jeuxGame stats </h1>
                    <p class="mt-4 text-md md:text-lg"> Keep track of all your achievements, hours played and games owned, combined across platforms. </p>
                </div>
                <div class="w-1/3 px-8 flex flex-col justify-center items-center">
                    <img src="images/icones/collection.png" alt="collection">
                    <h1 class="text-xl font-bold md:text-3xl">Game launcher</h1>
                    <p class="mt-4 text-md md:text-lg"> Install and launch any PC game you own, no matter the platform. </p>
                </div>
            </div>

            <div class="flex flex-row gap-4 justify-center items-center">
                <div class="w-1/3 px-8 flex flex-col justify-center items-center">
                    <img src="images/icones/collection.png" alt="collection">
                    <h1 class="text-xl font-bold md:text-3xl">Full customization</h1>
                    <p class="mt-4 text-md md:text-lg"> Create custom library views by filtering, sorting, tagging and adding your own visuals like game backgrounds and covers. </p>
                </div>
                <div class="w-1/3 px-8 flex flex-col justify-center items-center">
                    <img src="images/icones/collection.png" alt="collection">
                    <h1 class="text-xl font-bold md:text-3xl">Games discovery</h1>
                    <p class="mt-4 text-md md:text-lg"> Follow upcoming releases, and discover games popular among your friends and the gaming community. </p>
                </div>
            </div>
        </div>

    </section>


    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
    <?php include "footer.php"; ?>
    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
</body>

<script src="js/header.js"></script>

</html>