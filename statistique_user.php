<?php

require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/personne.Class.php';
require_once 'classes/favoris.Class.php';

session_start();


$favoris = new favoris();
$Allfavoris = $favoris->showAllMesFavoris();


if (isset($_POST['btn_delete_from_favor'])) {
    $delete = $favoris->deleteFromMesFavoris($_POST['btn_delete_from_favor']);

    if ($delete > 0) {
        header('Location: mesFavoris.php');
    }
}


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
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            </div>
        </div>

    </section>


</body>

<script src="js/header.js"></script>

</html>