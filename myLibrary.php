<?php

require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/library.Class.php';
require_once 'classes/favoris.Class.php';

session_start();

$biblio = new library();
$jeux_biblio = $biblio->getMyLibrary();

$favoris = new favoris();

// delete game from biblio :
if (isset($_POST['btn_delete_from_biblio'])) {
    $biblio->deleteFromMyLibrary($_POST['btn_delete_from_biblio']);
}

// delete game from favoris : 
if (isset($_POST['delete_from_favoris'])) {
    $delete = $favoris->deleteFromMesFavoris($_POST['delete_from_favoris']);
    
    if ($delete > 0) {
        header('Location: myLibrary.php');
    }
}

// add game to favoris : 
if (isset($_POST['add_to_favoris'])) {
    $addToF = $favoris->addToMesFavoris($_POST['add_to_favoris']);
    
    if ($addToF > 0) {
        header('Location: myLibrary.php');
    }
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>GameVault - My Library</title>
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
                <?php require_once "menu_user.php"; ?>
            </div>
            <!-- tableau ==================================================================================================================================================== -->

            <div class="w-4/5 h-full pr-4">
                <div class="font-[sans-serif] overflow-x-auto h-full w-full flex flex-col gap-32 pt-20">
                    <h1 class="text-3xl font-bold md:text-5xl text-start">Ma Bibliothèque</h1>

                    <table class="min-w-full h-max bg-black bg-opacity-80">
                        <thead class="whitespace-nowrap bg-black">
                            <tr>
                                <th class="pl-4 w-10">
                                    <form action="POST">
                                        <input type="hidden" name="btn_delete_from_biblio">
                                        <button><img src="images/icones/corbeille.png" alt="button delete game from biblio"></button>
                                    </form>
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-white">
                                    Title
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-white">
                                    Status
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-white">
                                    Genre
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-white">
                                    Favoris
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-white">
                                    Créateur
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-white">
                                    Rating
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-3 h-3 fill-gray-500 inline cursor-pointer ml-2"
                                        viewBox="0 0 401.998 401.998">
                                        <path
                                            d="M73.092 164.452h255.813c4.949 0 9.233-1.807 12.848-5.424 3.613-3.616 5.427-7.898 5.427-12.847s-1.813-9.229-5.427-12.85L213.846 5.424C210.232 1.812 205.951 0 200.999 0s-9.233 1.812-12.85 5.424L60.242 133.331c-3.617 3.617-5.424 7.901-5.424 12.85 0 4.948 1.807 9.231 5.424 12.847 3.621 3.617 7.902 5.424 12.85 5.424zm255.813 73.097H73.092c-4.952 0-9.233 1.808-12.85 5.421-3.617 3.617-5.424 7.898-5.424 12.847s1.807 9.233 5.424 12.848L188.149 396.57c3.621 3.617 7.902 5.428 12.85 5.428s9.233-1.811 12.847-5.428l127.907-127.906c3.613-3.614 5.427-7.898 5.427-12.848 0-4.948-1.813-9.229-5.427-12.847-3.614-3.616-7.899-5.42-12.848-5.42z"
                                            data-original="#000000" />
                                    </svg>
                                </th>
                                <th class="p-4 text-center text-sm font-semibold text-white">
                                    plus
                                </th>
                            </tr>
                        </thead>

                        <tbody class="whitespace-nowrap">

                            <?php foreach ($jeux_biblio as $game) :  ?>
                                <tr class="">
                                    <td class="pl-4 w-10">
                                        <form action="" method="POST">
                                            <button name="btn_delete_from_biblio" value="<?= $game['id_lib']; ?>"><img src="images/icones/corbeille.png" alt="button delete game from biblio"></button>
                                        </form>
                                    </td>
                                    <td class="p-4 text-sm text-center text-white">
                                        <?php echo $game['game_title']; ?>
                                    </td>
                                    <td class="p-4 text-sm text-center text-white">
                                        <?php if ($game['status'] === "En cours") :  ?>
                                            <span class="w-[68px] block text-center py-1 border border-green-500 text-green-600 rounded text-xs">En cours</span>
                                        <?php elseif ($game['status'] === "Terminé") :  ?>
                                            <span class="w-[68px] block text-center py-1 border border-blue-500 text-blue-600 rounded text-xs">Terminé</span>
                                        <?php elseif ($game['status'] === "Abandonné") :  ?>
                                            <span class="w-[68px] block text-center py-1 border border-orange-500 text-orange-600 rounded text-xs">Abandonné</span>
                                        <?php endif;  ?>
                                    </td>
                                    <td class="p-4 text-sm text-center text-white">
                                        <?php echo $game['game_genre']; ?>
                                    </td>
                                    <td class="p-4 text-sm text-center">
                                        <form action="" method="post">
                                            <?php if (!empty($game['favoris_id'])) : ?>
                                                <button name="delete_from_favoris" value="<?= $game['favoris_id'] ?>" class="text-red-600">&#10084;</button>
                                            <?php else :  ?>
                                                <button name="add_to_favoris" value="<?= $game['id_game'] ?>" class="text-white">&#10084;</button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td class="p-4 text-sm text-center text-white">
                                        <div class="flex items-center cursor-pointer">
                                            <img src='https://readymadeui.com/profile_4.webp'
                                                class="w-7 h-7 rounded-full shrink-0" />
                                            <div class="ml-4">
                                                <p class="text-sm text-white"><?php echo ($game['admin_full_name']); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <?php
                                        $note = $game['note'];
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
                                    </td>
                                    <td class="p-4">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5 cursor-pointer fill-gray-500 rotate-90" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="2" data-original="#000000" />
                                            <circle cx="4" cy="12" r="2" data-original="#000000" />
                                            <circle cx="20" cy="12" r="2" data-original="#000000" />
                                        </svg>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

</body>

<script src="js/header.js"></script>

</html>