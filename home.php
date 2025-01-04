<?php

require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/personne.Class.php';

// session_start();

$jeu = new game();
$games = $jeu->getAllGame();


// if (isset($_SESSION["ID_user"])) {
//     echo $_SESSION["ID_user"];
// } else {
//     echo "Aucun utilisateur connecté.";
// }

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
                <a href="singup.php">
                    <button class="w-32 h-12 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 shadow-lg hover:border-2 hover:border-white rounded-sm ">S'inscrire</button>
                </a>
                <p>Ou</p>
                <a href="login.php">
                    <button class="w-32 h-12 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 shadow-lg hover:border-2 hover:border-white rounded-sm ">Se connecter</button>
                </a>
            </div>
        </div>

    </section>

    <section class="relative h-max overflow-hidden">
        <img src="images/bg_3.jpg" alt="" class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover">
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white bg-black bg-opacity-50">
            <div class="w-full h-max py-4 pl-10 flex flex-col gap-4 justify-start items-start">
                <h1 class="text-3xl font-bold md:text-5xl">Nouveau et tendance</h1>
                <!-- <p class="mt-4 text-lg md:text-2xl">Basé sur le nombre de joueurs et la date de sortie</p> -->
            </div>
            <div class="w-full h-max flex flex-row justify-evenly">
                <form action="" method="post" class="w-full h-12 flex flex-row gap-4 justify-center px-10">
                    <select name="" id="" class="w-1/3 h-full border-0 rounded-sm px-2 bg-black bg-opacity-50 ">
                        <option value="">Genre</option>
                        <option value="">Genre1</option>
                        <option value="">Genre2</option>
                        <option value="">Genre3</option>
                        <option value="">Genre4</option>
                    </select>
                    <select name="" id="" class="w-1/3 h-full border-0 rounded-sm px-2 bg-black bg-opacity-50 ">
                        <option value="">Notation</option>
                        <option value="">Notation1</option>
                        <option value="">Notation2</option>
                        <option value="">Notation3</option>
                    </select>
                    <input type="search" class="w-1/3 h-full border-0 rounded-sm px-2 bg-black bg-opacity-50 " placeholder="test">
                </form>
            </div>
            <div class="h-full w-full grid grid-cols-4 gap-4 p-8 bg-red-00 ">



                <?php foreach ($games as $game) :  ?>
                    <div class="h-96 bg-[#6e2598] bg-opacity-50 border-0 rounded-xl flex flex-col   ">

                        <img src="images/game_1.jpg" alt="image game" class="h-1/2 w_full border-0 rounded-t-xl">
                        <div class="h-1/2 w-full flex flex-col gap-1 justify-start items-start p-2">

                            <h2 class=" w-full text-center text-xl font-medium "><?php echo $game['title']; ?></h2>
                            <p class=" text-gray-300 w-full text-start flex flex-row justify-between">Genres : <span class="text-end "><?php echo $game['genre']; ?></span></p>
                            <p class=" text-gray-300 w-full text-start flex flex-row justify-between">date de création : <span class="text-end "><?php echo $game['releaseDate']; ?></span></p>
                            <p class=" text-gray-300 w-full text-start flex flex-row justify-between"> Créateur: <span class="text-end "><?php echo $game['id_admin']; ?></span></p>

                            <div class="flex flex-row justify-between w-full">
                                <span>&#10084; 15</span>

                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                    <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                </div>
                            </div>

                            <form action="" method="post" class="w-full flex justify-end gap-2">
                                <input type="hidden" name="" value="<?php echo $game['id_game']; ?>">
                                <button class="h-8 w-20 text-white font-medium bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 rounded-sm shadow-lg">
                                    Ajouter
                                </button>
                                <button class="h-8 w-20 text-white font-medium bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 rounded-sm shadow-lg">
                                    Détails
                                </button>
                            </form>
                        </div>

                    </div>

                <?php endforeach;  ?>

            </div>

        </div>

    </section>



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



    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
    <?php include "footer.php"; ?>
    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
</body>

<script src="js/header.js"></script>

</html>