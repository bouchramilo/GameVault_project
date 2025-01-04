<?php

require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/personne.Class.php';

session_start();


$historic = new historique();
$historiques = $historic->consulter();


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>GameVault - Historique</title>
</head>

<body class="bg-[#f9dbbd]">
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->

    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->




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
                    <h1 class="text-3xl font-bold md:text-5xl text-start">Historique</h1>

                    <table class="min-w-full h-max bg-black bg-opacity-80">
                        <thead class="whitespace-nowrap bg-black">
                            <tr>
                                <th class="p-4 text-left text-sm font-semibold text-white w-1/4">
                                    Date & Time
                                </th>
                                <th class="p-4 text-left text-sm font-semibold text-white w-3/4">
                                    Action
                                </th>

                            </tr>
                        </thead>

                        <tbody class="whitespace-nowrap">
                            <?php foreach ($historiques as $historique) {  ?>
                                <tr class="text-left">
                                    <td class="p-4 text-sm text-white w-1/4">
                                    <?php echo $historique['action_at'] ; ?>
                                    </td>
                                    
                                    <td class="p-4 text-sm text-white h-max w-3/4">
                                        <p><?php echo $historique['action'] ; ?> </p>
                                    </td>
                                </tr>
                                <?php }  ?>





                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>








    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
    <!-- <?php include "footer.php"; ?> -->
    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
</body>

<script src="js/header.js"></script>

</html>