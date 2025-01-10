<?php

require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/personne.Class.php';
require_once 'classes/favoris.Class.php';
require_once 'classes/user.Class.php';

session_start();


$utilisateur = new user();

$statistique = $utilisateur->getStatistique();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-[#f9dbbd]">

    <section class="relative h-max min-h-screen overflow-hidden pb-10">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay loop muted playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>
        <div class="relative z-10 flex flex-row gap-4 h-max text-center text-white bg-black bg-opacity-30">
            <div class="w-1/5 h-full">

                <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->
                <?php require_once "menu_user.php"; ?>
                <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->

            </div>
            <!-- tableau ==================================================================================================================================================== -->

            <div class="w-4/5 h-full pr-4">
                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                <div class="font-[sans-serif] overflow-x-auto h-full w-full flex flex-col gap-14 pt-20">
                    <h1 class="text-3xl font-bold md:text-5xl text-start">Statistique</h1>

                    <div class="grid grid-cols-2 gap-2 p-4 min-w-full  h-max bg-opacity-80">

                        <div class="h-64 w-full bg-opacity-80 border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-black">
                            <img src="images/controle-du-jeu.png" alt="statistique" class="w-10 ">
                            <p> Game dans bibliothèque</p>
                            <p class="font-bold text-3xl text-gray-500"><?= $statistique['totalGames'] ?></p>
                        </div>
                        <div class="h-64 w-full bg-opacity-80 border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-black">
                            <img src="images/icons8-heart-50.png" alt="statistique" class="w-10 ">
                            <p> Game favoris</p>
                            <p class="font-bold text-3xl text-gray-500"><?= $statistique['totalFavorites'] ?></p>
                        </div>
                        <div class="h-64 w-full bg-opacity-80 border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-black">
                            <img src="images/icones/star.png" alt="statistique" class="w-10 ">
                            <p> Game noté</p>
                            <p class="font-bold text-3xl text-gray-500"><?= $statistique['totalNota'] ?></p>
                        </div>
                        <div class="h-64 w-full bg-opacity-80 border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-black">
                            <img src="images/icones/time.png" alt="statistique" class="w-10 ">
                            <p> Time passé</p>
                            <p class="font-bold text-3xl text-gray-500"><?= $statistique['totalPlayTime'] ?></p>
                        </div>

                    </div>
                    <!-- <div class="flex gap-1 p-1 min-w-full  h-max bg-black bg-opacity-80">

                        <div class="h-max w-full border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-gray-800">
                            <canvas></canvas>
                        </div>
                        <div class="h-max w-full border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-gray-800">
                            <canvas></canvas>
                        </div>
                        <div class="h-max w-1/4 border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-gray-800">
                            <canvas></canvas>
                        </div>
                        <div class="h-max w-1/4 border-none rounded-2xl flex flex-col gap-2 p-2 justify-center items-center bg-gray-800">
                            <canvas></canvas>
                        </div>

                    </div> -->
                </div>






















                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            </div>
        </div>

    </section>


</body>

<script src="js/header.js"></script>

</html>