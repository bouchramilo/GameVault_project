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

// update status game from library : 
if (isset($_POST['status_update'])) {
    $updateLibStatus = $biblio->updateStatusGame($_POST['id_lib'], $_POST['status_update']);

    if ($updateLibStatus > 0) {
        header('Location: myLibrary.php');
    }
}
// update status game from library : 
if (isset($_POST['notation_update'])) {
    $updateLibNota = $biblio->updateNoteGame($_POST['id_jeu'], $_POST['nota_update']);

    echo "<script> alert('$updateLibNota');</script>";

    if ($updateLibNota > 0) {
        header('Location: myLibrary.php');
    }
}
// update status game from library : 
if (isset($_POST['btn_time_update'])) {
    $updateLibNota = $biblio->updateTimeGame($_POST['id_jeu_t'], $_POST['time_update']);

    echo "<script> alert('$updateLibNota');</script>";

    if ($updateLibNota > 0) {
        header('Location: myLibrary.php');
    }
}

?>



<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
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

            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <div class="w-1/5 h-full">
                <?php require_once "menu_user.php"; ?>
            </div>
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

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
                                    Time play
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

                            <?php foreach ($jeux_biblio as $gameBib) :  ?>
                                <tr class="">
                                    <td class="pl-4 w-10">
                                        <form action="" method="POST">
                                            <button name="btn_delete_from_biblio" value="<?= $gameBib['id_lib']; ?>"><img src="images/icones/corbeille.png" alt="button delete game from biblio"></button>
                                        </form>
                                    </td>
                                    <td class="p-4 text-sm text-center text-white">
                                        <?php echo $gameBib['game_title']; ?>
                                    </td>
                                    <td class="p-4 text-sm text-center text-white flex justify-center">
                                        <?php if ($gameBib['status'] === "En cours") :  ?>
                                            <button id="id_biblio" value="<?php echo ($gameBib['status']); ?>" onclick="editStatus(<?php echo ($gameBib['id_lib']); ?> )" class="w-[68px] block text-center py-1 border border-green-500 text-green-600 rounded text-xs"><?php echo ($gameBib['status']); ?></button>
                                        <?php elseif ($gameBib['status'] === "Terminé") :  ?>
                                            <button id="id_biblio" value="<?php echo ($gameBib['status']); ?>" onclick="editStatus(<?php echo ($gameBib['id_lib']); ?> )" class="w-[68px] block text-center py-1 border border-blue-500 text-blue-600 rounded text-xs"><?php echo ($gameBib['status']); ?></button>
                                        <?php elseif ($gameBib['status'] === "Abandonné") :  ?>
                                            <button id="id_biblio" value="<?php echo ($gameBib['status']); ?>" onclick="editStatus(<?php echo ($gameBib['id_lib']); ?> )" class="w-[68px] block text-center py-1 border border-orange-500 text-orange-600 rounded text-xs"><?php echo ($gameBib['status']); ?></button>
                                        <?php endif;  ?>
                                    </td>
                                    <td class="p-4 text-sm text-center text-white">
                                        <?php echo $gameBib['game_genre']; ?>
                                    </td>
                                    <td class="p-4 text-sm text-center">
                                        <form action="" method="post">
                                            <?php if (!empty($gameBib['favoris_id'])) : ?>
                                                <button name="delete_from_favoris" value="<?= $gameBib['favoris_id'] ?>" class="text-red-600">&#10084;</button>
                                            <?php else :  ?>
                                                <button name="add_to_favoris" value="<?= $gameBib['id_game'] ?>" class="text-white">&#10084;</button>
                                            <?php endif; ?>
                                        </form>
                                    </td>
                                    <td class="p-4 text-sm text-center">
                                        <button id="id_biblio_t" onclick="editTime(<?= ($gameBib['id_lib']); ?>)" value="<?php echo $gameBib['Time_jouer'] ?>" class=""><?php echo $gameBib['Time_jouer'] ?></button>

                                    </td>
                                    <td class="p-4 text-sm text-center text-white">
                                        <div class="flex items-center cursor-pointer">
                                            <img src='https://readymadeui.com/profile_4.webp'
                                                class="w-7 h-7 rounded-full shrink-0" />
                                            <div class="ml-4">
                                                <p class="text-sm text-white"><?php echo ($gameBib['admin_full_name']); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <button id="id_libra" value="<?php echo ($gameBib['note']); ?>" onclick="editNotation(<?= ($gameBib['id_game']); ?> )" class="">
                                            <?php
                                            $note = $gameBib['note'];
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
                                        </button>
                                    </td>
                                    <td class="p-4 flex justify-center">
                                        <a href="details_game_User.php?id_game=<?= $gameBib["id_game"] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5 cursor-pointer fill-gray-500 rotate-90" viewBox="0 0 24 24">
                                                <circle cx="12" cy="12" r="2" data-original="#000000" />
                                                <circle cx="4" cy="12" r="2" data-original="#000000" />
                                                <circle cx="20" cy="12" r="2" data-original="#000000" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;  ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- modification de status           ************************************************************************ -->

    <div id="statusModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le rôle :</h2>

            <form method="POST">
                <input type="hidden" id="id_lib" name="id_lib" value="">

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-600 mb-1">
                        Nouveau rôle
                    </label>
                    <select id="status" name="status_update" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="En cours">En cours</option>
                        <option value="Terminé">Terminé</option>
                        <option value="Abandonné">Abandonné</option>
                    </select>
                </div>


                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModal()">
                        Annuler
                    </button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- modification de note           ************************************************************************ -->
    <div id="notationModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le rôle :</h2>

            <form method="POST">
                <input type="hidden" id="id_jeu" name="id_jeu" value="">

                <div class="mb-4">
                    <label for="notation" class="block text-sm font-medium text-gray-600 mb-1">
                        Nouveau notation
                    </label>
                    <select id="nota" name="nota_update" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModalN()">
                        Annuler
                    </button>
                    <button name="notation_update" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <!-- modification de time jouer           ************************************************************************ -->
    <div id="timeModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le rôle :</h2>

            <form method="POST">
                <input type="hidden" id="id_jeu_t" name="id_jeu_t" value="">

                <div class="mb-4">
                    <label for="time" class="block text-sm font-medium text-gray-600 mb-1">
                        Nouveau time
                    </label>
                    <input type="time" id="time" name="time_update" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">

                </div>


                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModalT()">
                        Annuler
                    </button>
                    <button name="btn_time_update" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

<script src="js/header.js"></script>
<script src="js/status_note_form.js"></script>

</html>