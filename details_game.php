<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>GameVault - Game</title>
</head>

<body class="bg-[#f9dbbd]">
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->
    <?php include "header.php"; ?>
    <!-- header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  header  -->

    <section class="relative h-max overflow-hidden">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay
            loop
            muted
            playsinline>
            <source src="images/privacy_002.mp4" type="video/mp4" />
        </video>
        <!-- <img src="images/game_1.jpg" alt=""class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 "> -->
        <div class="relative z-10 flex flex-col gap-4 h-full text-center text-white bg-black bg-opacity-50 p-4">
            <h1 class="text-5xl text-start pl-4">Title de game</h1>
            <div class="w-full h-max p-4 flex flex-row gap-4 ">

                <div class="w-1/2 min-h-screen flex  text-white text-lg animate-fade-in">
                    <table class="text-start bg-black w-full h-full bg-opacity-65 ">
                        <tr>
                            <td class="w-1/3 font-bold">Genre : </td>
                            <td class="w-2/3 ">Action, genre 2 ..</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 font-bold">Créer par : </td>
                            <td class="w-2/3 ">bou ba</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 font-bold">Average Score : </td>
                            <td class="w-2/3 ">12</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 font-bold">Date de création : </td>
                            <td class="w-2/3 ">02/01/2025</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 font-bold">Details : </td>
                            <td class="w-2/3 ">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sed beatae expedita dicta aliquam, adipisci perspiciatis.</td>
                        </tr>
                        <tr>
                            <td class="w-1/3 font-bold">Notation : </td>
                            <td class="w-2/3 ">
                                <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        fill="#facc15" />
                                </svg>
                                <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        fill="#facc15" />
                                </svg>
                                <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        fill="#facc15" />
                                </svg>
                                <svg class="w-[18px] h-4 inline mr-1" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        fill="#CED5D8" />
                                </svg>
                                <svg class="w-[18px] h-4 inline" viewBox="0 0 14 13" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z"
                                        fill="#CED5D8" />
                                </svg>
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/3 font-bold">Favoris :</td>
                            <td class="w-2/3 "><span class="text-red-600">&#10084;</span> 15</td>
                        </tr>
                    </table>
                </div>

                <div class="w-1/2 min-h-screen  grid grid-cols-2 justify-items-center items-center gap-2">
                    <div class="screenshot col-span-1 bg-gradient-to-r bg-transparent w-full h-full hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 shadow-lg hover:border-0 hover:border-white rounded-2xl hover:scale-[105%] p-1"><img src="images/game_1.jpg" alt="Image 1" class="w-full h-full  border-0 rounded-2xl "></div>
                    <div class="screenshot col-span-1 bg-gradient-to-r bg-transparent w-full h-full hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 shadow-lg hover:border-0 hover:border-white rounded-2xl hover:scale-[105%] p-1"><img src="images/game_1.jpg" alt="Image 1" class="w-full h-full  border-0 rounded-2xl "></div>
                    <div class="screenshot col-span-2 bg-gradient-to-r bg-transparent w-full h-full hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 shadow-lg hover:border-0 hover:border-white rounded-2xl hover:scale-[105%] p-1"><img src="images/game_1.jpg" alt="Image 1" class="w-full h-full  border-0 rounded-2xl "></div>
                    <!-- <img src="images/game_1.jpg" alt="Image 2" class="w-full h-full screenshot col-span-1 border-0 rounded-2xl hover:scale-110">
                    <img src="images/game_1.jpg" alt="Image 3" class="w-full h-full screenshot col-span-2 border-0 rounded-2xl hover:scale-110"> -->
                </div>
            </div>




        </div>

    </section>


    <section class="relative h-max overflow-hidden">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay
            loop
            muted
            playsinline>
            <source src="images/bg_2.mp4" type="video/mp4" />
        </video>
        <!-- <img src="images/game_1.jpg" alt=""class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 "> -->
        <div class="relative z-10 flex flex-col gap-4 h-full text-center text-white bg-black bg-opacity-50 p-4">
        </div>


    </section>


    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->
    <?php include "footer.php"; ?>
    <!-- footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer  footer -->

</body>

<script src="js/header.js"></script>

</html>