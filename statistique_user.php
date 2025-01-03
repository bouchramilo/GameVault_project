<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>GameVault - Statistique</title>
</head>
<body class="bg-[#f9dbbd] flex flex-col gap-1 ">
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->
    <?php include "header.php" ; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->


    <section class="relative h-screen overflow-hidden">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay loop muted playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>
        <div
            class="relative z-10 flex flex-col gap-4 items-center justify-center h-full text-center text-white bg-black bg-opacity-30">

            <div class="w-1/5 h-full">
            <?php require_once "menu_user.php"; ?>
            </div>

        </div>

    </section>






    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
     <?php include "footer.php" ; ?>
    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
</body>

<script src="js/header.js"></script>

</html>