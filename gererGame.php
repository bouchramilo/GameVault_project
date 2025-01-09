
<?php
require 'classes/admin.Class.php';
session_start();
$admin = new Admin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nom_game']) && isset($_POST['categorie_game']) && isset($_POST['desc_game']) && isset($_POST['prix_game']) && isset($_POST['image_game'])) {
        $admin->addGame($_POST['nom_game'],$_POST['categorie_game'], $_POST['desc_game'],$_POST['prix_game'],$_POST['image_game']);
    }
    elseif(isset($_POST['id_game']) ){
        $admin->deleteGame($_POST['id_game']);
    }
    elseif(isset($_POST['idgame']) && isset($_POST['title']) && isset($_POST['details']) && isset($_POST['releaseDate']) && isset($_POST['price'])  && isset($_POST['genre'])  && isset($_POST['modifierphoto'])){
    $admin->updateGame($_POST['idgame'],$_POST['title'], $_POST['details'],$_POST['releaseDate'],$_POST['price'],$_POST['genre'],$_POST['modifierphoto']);}

}

$games=$admin->afficherGames();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Gestion des utilisateurs </title>

</head>

<body class="flex flex-col">

    <?php include 'menu_admin.php' ?>



    <div class="font-[sans-serif] overflow-x-auto grid justify-end w-screen grid-cols-[84%]">
        <h1 class="mx-6 mt-6 text-3xl font-bold md:text-5xl text-start">Gestion des jeux</h1>
        <div class="  font-[sans-serif] flex justify-end mx-[20px] my-[25px] gap-4">
            <button type="button" class=" addgame px-5 py-2.5 flex items-center justify-center rounded text-white text-sm tracking-wider font-medium border-none outline-none bg-[#da627d] hover:bg-[#f9dbbd] active:bg-[#da627d]">
            <span class="border-r border-white pr-3">Ajouter jeu</span>
            <img class=" ml-4 w-[28px] h-[28px] " src="images/controle-du-jeu.png" alt="">
          </button>
        </div>
        <div class="grid grid-cols-[25%_25%_25%_25%] gap-4">
        <?php if (count($games) > 0): ?>
            <?php foreach ($games as $game): ?>
            <div class="bg-white shadow-[0_4px_12px_-5px_rgba(0,0,0,0.4)] w-full h-[450px] py-6 max-w-[280px] rounded-lg font-[sans-serif] overflow-hidden mx-auto mt-4">
                <div class="flex items-center gap-2 px-6">
                    <h3 class="text-xl text-gray-800 font-bold flex-1"><a href="details_game.php?id_game=<?= htmlspecialchars($game["id_game"]) ?>"> <?= htmlspecialchars($game["title"]) ?></a></h3> 
                    <span>5</span>
                    <img class="comment w-[20px] h-[20px] hover:content-[url(images/icons8-comment.gif)]" src="images/icons8-comment-50.png " alt=" ">
                    <span>12</span>
                    <img class="adorer w-[20px] h-[20px] hover:content-[url(images/heart.gif)]" src="images/icons8-heart-50.png" alt="">
                </div>
                <div class="relative photo w-full h-[94%] group">
                    <img src="images/Minecraft.jpg" class=" w-full h-[100%] my-6" />

                    <div class="details bottom-0 left-0 absolute w-full hidden group-hover:block ">
                        <div class="px-6 bg-black opacity-75 ">
                            <p class="text-sm text-white leading-relaxed pt-6"> <?= htmlspecialchars($game["details"]) ?></p>

                            <div class="mt-8 flex items-center flex-wrap gap-4 ">
                                <h3 class="text-xl text-white font-bold flex-1 "> <?= htmlspecialchars($game["price"]) ?>DH</h3>
                                <br>
                                <button onclick="modifierbtn('<?= $game['id_game'] ?>','<?= $game['title'] ?>','<?= $game['details'] ?>','<?= $game['releaseDate']?>','<?= $game['price'] ?>','<?= $game['genre'] ?>')" class="updateform px-1 py-2.5 rounded-lg  bg-white outline-none "><img class="w-[22px] h-[22px] hover:content-[url(images/icons8-edit.gif)]" src="images/icons8-edit-50.png" alt=""></button>
                                <button onclick="deletebtn('<?= $game['id_game'] ?>')" class=" text-white sprm px-1 py-2.5 rounded-lg bg-white outline-none "><img class="w-[22px] h-[22px] hover:content-[url(images/icons8-trash.gif)]" src="images/icons8-trash-50.png" alt=""></button>

                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
                <?php else: ?>
                    <h4> Aucun utilisateur trouvé</h4>

                    <?php endif; ?>

        
        </div>
    </div>

    <!-- modifier modal  -->

    <div id="formContainerModifier" class="hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full overflow-auto font-[sans-serif]">
        <div class="bg-[#1d1d1d] opacity-90 text-white p-6 flex flex-col gap-6 rounded-lg shadow-lg w-[60%] max-sm:w-full">
            <h2 class="text-2xl font-bold text-center">Modifier le jeu</h2>
            <form class="space-y-4 mt-8" method="POST">
                <div>
                    <label class="text-white text-sm mb-2 block">Name of the game</label>
                    <input id="idgame" type="hidden" name="idgame">
                    <input  id="title" name="title" type="text" placeholder="Enter game name" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label class="text-white text-sm mb-2 block">Descriptions</label>
                    <textarea id="details"  name="details" placeholder='Write about the game' class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" rows="3"></textarea>
                </div>

                <div>
                    <label class="text-white text-sm mb-2 block">Date_creation</label>
                    <input id="releaseDate" name="releaseDate" type="date" placeholder="Enter quantity" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label class="text-white text-sm mb-2 block">Price</label>
                    <input id="price" name="price" type="number" placeholder="Enter price" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label class="text-white text-sm mb-2 block">Categorie</label>
                    <input id="genre" name="genre" type="text" placeholder="Enter product category" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>
                <div>
                    <label class="text-white text-sm mb-2 block">Add background image</label>
                    <input id="modifierphoto" name="modifierphoto" type="file" accept="image/*" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>
                <div class="flex justify-center h-12">
                    <button type="submit" class="bg-[#d025a0] border-2 rounded-sm w-44 h-10 font-sans hover:bg-[#830c61] hover:text-white">
                              Save
                            </button>
                </div>

            </form>
        </div>
    </div>


    <!-- supprimer modal -->

    <div class=" deletemodal fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif] hidden">
        <div class="  w-full max-w-lg bg-white shadow-lg rounded-lg p-6 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class=" pic w-3.5 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500 float-right" viewBox="0 0 320.591 320.591">
            <path
                d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                data-original="#000000"></path>
            <path
                d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                data-original="#000000"></path>
        </svg>

            <div class="my-4 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 fill-red-500 inline" viewBox="0 0 24 24">
                <path
                    d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                    data-original="#000000" />
                <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                    data-original="#000000" />
            </svg>
            
                <h4 class="text-gray-800 text-base font-semibold mt-4">Are you sure you want to delete it?</h4>
                <form method="POST">
                <input type="hidden" id="id_game" name="id_game">
                <div class="text-center space-x-4 mt-8">
                    <button type="button" class="px-4 py-2 rounded-lg text-gray-800 text-sm bg-gray-200 hover:bg-gray-300 active:bg-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded-lg text-white text-sm bg-red-600 hover:bg-red-700 active:bg-red-600">Delete</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- j adore modal -->
    <div class=" adoremodal hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg px-8 py-6 relative">
            <div class="flex items-start">
                <div class="flex-1">
                    <h3 class="text-gray-800 text-2xl font-bold">Likes</h3>
                    <p class="text-gray-500 text-sm mt-1">Voir ceux qui ont adoré votre jeu.</p>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" class=" croix w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500" viewBox="0 0 320.591 320.591">
                <path
                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                    data-original="#000000"></path>
                <path
                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                    data-original="#000000"></path>
            </svg>
            </div>

            <div class="flex flex-wrap gap-4 mt-6">
                <div class="flex flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus-within:border-blue-600 min-w-[220px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-gray-400 mr-4">
                    <path
                        d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                    </path>
                </svg>
                    <input type="email" placeholder="Search by name or user id" class="w-full outline-none bg-transparent text-gray-500 text-sm" />
                </div>

                <button type="button" class="px-5 py-2.5 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Chercher</button>
            </div>

            <div class="mt-6 divide-y">
                <div class="flex flex-wrap items-center gap-4 py-3 cursor-pointer">
                    <img src='https://readymadeui.com/team-1.webp' class="w-11 h-11 rounded-full" />
                    <div>
                        <p class="text-sm text-gray-800 font-bold">John Doe</p>
                        <p class="text-xs text-gray-500 mt-0.5">johndoe23@gmail.com</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5 ml-auto">User</p>
                </div>


            </div>
        </div>
    </div>
























    <!-- modal game  -->
    <div class="gamemodal hidden fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="bg-[#1d1d1d] opacity-90 text-white p-6 flex flex-col gap-6 rounded-lg shadow-lg w-[60%] max-sm:w-full">
            <div class="flex items-center">
                <h3 class="text-white text-2xl font-bold flex-1">Ajouter un jeu</h3>

                <svg xmlns="http://www.w3.org/2000/svg" class=" close w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500" viewBox="0 0 320.591 320.591">
                <path
                    d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                    data-original="#000000"></path>
                <path
                    d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                    data-original="#000000"></path>
            </svg>
            </div>

            <form class="space-y-4 mt-8" method="POST">
                <div>
                    <label  for="nom_game" class="text-white text-sm mb-2 block">Name of the game</label>
                    <input name="nom_game" type="text" placeholder="Enter game name" class="px-4 py-3 bg-gray-100 w-full text-white text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label for="desc_game" class="text-white text-sm mb-2 block">Descriptions</label>
                    <textarea name="desc_game" placeholder='Write about the game' class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" rows="3"></textarea>
                </div>

                <!-- <div>
                    <label for="date_game" class="text-white text-sm mb-2 block">Date_creation</label>
                    <input name="date_game" type="date" placeholder="Enter quantity" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div> -->

                <div>
                    <label for="prix_game" class="text-white text-sm mb-2 block">Price</label>
                    <input  name="prix_game" type="number" placeholder="Enter price" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>

                <div>
                    <label for="categorie_game" class="text-white text-sm mb-2 block">Categorie</label>
                    <input name="categorie_game" type="text" placeholder="Enter product category" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>
                <div>
                    <label for="image_game" class="text-white text-sm mb-2 block">Add background image</label>
                    <input name="image_game" type="file" accept="image/*" class="px-4 py-3 bg-gray-100 w-full text-gray-800 text-sm border-none focus:outline-blue-600 focus:bg-transparent rounded-lg" />
                </div>

                <div class="flex justify-end gap-4 !mt-8">
                    <button type="button" class="px-6 py-3 rounded-lg text-gray-800 text-sm border-none outline-none tracking-wide bg-gray-200 hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="px-6 py-3 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Submit</button>
                </div>
            </form>
        </div>
    </div>

















    <!-- comment modal -->

    <div class=" commentmodal hidden  fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg px-8 py-6 relative">
            <div class="flex items-start">
                <div class="flex-1">
                    <h3 class="text-gray-800 text-2xl font-bold">Commentaire</h3>
                    <p class="text-gray-500 text-sm mt-1">Voir les commentaire associés à votre jeu.</p>
                </div>

                <svg xmlns="http://www.w3.org/2000/svg" class=" croixx w-3 ml-2 cursor-pointer shrink-0 fill-gray-400 hover:fill-red-500" viewBox="0 0 320.591 320.591">
                    <path
                        d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                        data-original="#000000"></path>
                    <path
                        d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                        data-original="#000000"></path>
                </svg>
            </div>

            <div class="flex flex-wrap gap-4 mt-6">
                <div class="flex flex-1 px-4 py-2.5 rounded-lg border border-gray-300 focus-within:border-blue-600 min-w-[220px]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-gray-400 mr-4">
                        <path
                            d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z">
                        </path>
                    </svg>
                    <input type="email" placeholder="Search by name or user id" class="w-full outline-none bg-transparent text-gray-500 text-sm" />
                </div>

                <button type="button" class="px-5 py-2.5 rounded-lg text-white text-sm border-none outline-none tracking-wide bg-blue-600 hover:bg-blue-700">Chercher</button>
            </div>

            <div class="mt-6 divide-y">
                <div class="flex flex-wrap items-center gap-4 py-3 cursor-pointer">
                    <img src='images/gamevault-high-resolution-logo.png' class="w-11 h-11 rounded-full" />
                    <div>
                        <p class="text-sm text-gray-800 font-bold">Heiji</p>
                        <p class="text-l text-gray-500 mt-0.5">a ecrit qlq chose .........</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-0.5 ml-auto">User</p>
                </div>

            </div>
        </div>
    </div>
    <script>
        const updateform = document.querySelectorAll('.updateform');
        const deletemodal = document.querySelector('.deletemodal');
        const sprm = document.querySelectorAll('.sprm');
        const pic = document.querySelector('.pic');
        const close = document.querySelector('.close');
        const croix = document.querySelector('.croix');
        const gamemodal = document.querySelector('.gamemodal');
        const adorer = document.querySelectorAll('.adorer');
        const adoremodal = document.querySelector('.adoremodal');
        const addgame = document.querySelector('.addgame');
        const commentmodal = document.querySelector('.commentmodal');
        const comment = document.querySelectorAll('.comment');
        const croixx = document.querySelector('.croixx');

        const formContainerModifier = document.getElementById('formContainerModifier');

        adorer.forEach(adr => {
            adr.addEventListener('click', () => {
                adoremodal.classList.toggle('hidden');
            });
        });
        comment.forEach(cmt => {
            cmt.addEventListener('click', () => {
                commentmodal.classList.toggle('hidden');
            });
        });

        updateform.forEach(upd => {
            upd.addEventListener('click', () => {
                formContainerModifier.classList.toggle('hidden');
            })

        });
        sprm.forEach(del => {
            del.addEventListener('click', () => {
                deletemodal.classList.toggle('hidden');
            });
        })

        pic.addEventListener('click', () => {
            deletemodal.classList.toggle('hidden');
        });
        croix.addEventListener('click', () => {
            adoremodal.classList.toggle('hidden');
        });
        addgame.addEventListener('click', () => {
            gamemodal.classList.toggle('hidden');
        })
        close.addEventListener('click', () => {
            gamemodal.classList.toggle('hidden');
        })
        croixx.addEventListener('click', () => {
            commentmodal.classList.toggle('hidden');
        });



        function deletebtn(id) {
            document.getElementById('id_game').value = id;
        }
        function modifierbtn(id,title,details,releaseDate,price,genre) {
            document.getElementById('idgame').value = id;
            document.getElementById('title').value = title;
            document.getElementById('details').value = details;
            document.getElementById('releaseDate').value = releaseDate;
            document.getElementById('price').value = price;
            document.getElementById('genre').value = genre;
        }


    </script>

</body>

</html>

</html>