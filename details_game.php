
<?php
require 'classes/admin.Class.php';
require 'classes/game.Class.php';
require 'classes/chat.Class.php';
session_start();

$admin = new Admin();
if(isset($_GET['id_game'])){
    echo 'azerty'.$_GET['id_game'];
    $game = $admin->detailsGame($_GET['id_game']);
}

$chat = new Chat();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['mymessage'])) {
   $chat->sendMessage($_GET['id_game'],$_POST['mymessage']);

  }}
 $chats= $chat->getMessage($_GET['id_game']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Jeu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .screenshots.active {
            border: 3px solid#da627d;
            transform: scale(1.1);
        }
        
        
        .screenshots {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .screenshots:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 10px rgba(166, 47, 170, 0.5);
        }
    </style>
</head>

<body class="bg-gray-900 text-white font-sans ">
    <?php include 'menu_admin.php' ?>
    <!-- <header class="relative bg-cover bg-center h-72" style="background-image: url('images/game-banner.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col items-center justify-center text-[#da627d] text-center">
            <h1 class="text-4xl font-bold">Nom du Jeu : Micraft</h1>
            <p class="text-lg mt-2">ptit slogan</p>
        </div>
        </header> -->

    <main class="container mx-auto p-6 bg-gray-800 rounded-lg shadow-lg mt-8 grid grid-cols-[84%] justify-end">
        <section class="flex flex-wrap gap-6">
            <div class="w-full sm:w-1/3">
                <img src="data:<?= $game['mimi'];?>;base64,<?= $game['photo']; ?>" alt="Image principale du jeu" class="w-full rounded-lg shadow-lg">
            </div>

            <div class="flex-1">
                <h2 class="text-3xl font-bold text-[#da627d] mb-4">Détails du Jeu</h2>
                <ul class="space-y-2">
                    <li><strong>Nom :</strong> <?= htmlspecialchars($game["title"]); ?></li>
                    <li><strong>Catégorie :</strong> <?= htmlspecialchars($game["genre"]) ;?></li>
                    <li><strong>Date de sortie :</strong> <?= htmlspecialchars($game["releaseDate"]) ?></li>
                    <li><strong>Createur :</strong> <?= htmlspecialchars($game["first_name"])." ". htmlspecialchars($game["last_name"])?></li>
                    <li><strong>Prix :</strong> <?= htmlspecialchars($game["price"]) ?> DH</li>
                </ul>
                <p class="description mt-4">
                <?= htmlspecialchars($game["details"]) ?>                </p>
                <div class="mt-6 flex gap-4">
                    <button class="bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d]  transition">
                        Jouer
                    </button>
                    <button class="bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d]  transition">
                        Acheter le Jeu
                    </button>
                    <button class=" ajout bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d] transition">
                        Ajouter au bibliotheque
                    </button>
                </div>
            </div>
        </section>

        <section class="mt-12 text-center">
            <h2 class="text-3xl font-bold text-[#da627d] mb-6">Screenshots</h2>
            <div class="flex flex-col items-center gap-6">
                <div class="relative w-[70%] h-[500px] rounded-lg overflow-hidden shadow-lg">
                    <img id="current-screenshot" src="images/Paner.jpg" alt="Capture 1" class="w-full h-full object-[length:100%_100%]">
                    <p id="screenshot-caption" class="absolute bottom-0 bg-black bg-opacity-75 text-2xl text-white w-full py-2 text-left px-4">
                        Decrire 1 er Screen
                    </p>
                </div>

                <div class="flex gap-6 overflow-x-auto  p-4">
                    <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="images/Paner.jpg" alt="" data-caption="Decrire 1 er Scren">
                    <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1928870/ss_4dba4e59eabcf5c3631e5c28b52ffcae46d3bad8.600x338.jpg?t=1717003087"
                        alt="" data-caption="Decrire 2 eme Screen">
                    <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1928870/ss_65720eb73a2dd8fc993172cfbfcdc8fe40ec44c2.600x338.jpg?t=1717003087"
                        alt="" data-caption="Decrire 3 eme Screen">
                    <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="images/Minecraft.jpg" alt="" data-caption="Decrire 4 eme Screen">
                    <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/230410/ss_2e4077f215eccde84171a4b8e0f2bc8a3264c776.600x338.jpg" alt=""
                        data-caption="Decrire 5 eme Screen">
                    <img class="screenshots w-24 h-15 object-[length:100%_100%] rounded-md hover:scale-105 transition cursor-pointer" src="images/Minecraft.jpg" alt="" data-caption="Decrire 6 eme Screen">

                </div>
            </div>
        </section>
        <body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <!-- Chat Form -->
  <div class="w-full max-w-md bg-white shadow-md rounded-lg p-4">
    <div id="chat-box" class="h-64 text-black overflow-y-auto border border-gray-300 rounded-lg p-4 mb-4 bg-gray-50">
    <?php if (count($chats) > 0): ?>
    <?php foreach ($chats as $chat): ?>
        <div class="mb-4">
                    <div class="flex items-center space-x-2 mb-1">
                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-bold">
      <p class="text-sm font-semibold text-gray-700"> <?= htmlspecialchars($_SESSION["ID_user"]) ?></p>
      </div>
      <div class="ml-10">
      <p class="bg-blue-100 text-gray-800 rounded-lg px-3 py-2 text-sm mb-1"> <?= htmlspecialchars($chat["message_chat"]) ?> </p>
      <span class="text-xs text-gray-500"> <?= htmlspecialchars($chat["massage_at"]) ?></span>
      </div>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center text-gray-500 italic">
      <h4> Soiez le 1 ere dans le chat </h4>
    </div>

  <?php endif; ?>
    </div>
    <form id="chat-form" class="flex gap-2" method="POST">
      <input name="mymessage"
        type="text" 
        id="chat-input" 
        class="flex-1 border border-gray-300 text-black rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
        placeholder="Type your message..." 
        required
      >
      <button 
        type="submit" 
        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300"
      >
        Send
      </button>
    </form>
  </div>

    </main>
    

    <script>
        const screenshots = document.querySelectorAll('.screenshots');
        const mainImage = document.getElementById('current-screenshot');
        const caption = document.getElementById('screenshot-caption');
        screenshots.forEach((screenshot) => {
            screenshot.addEventListener('click', () => {
                mainImage.src = screenshot.src;
                caption.textContent = screenshot.getAttribute('data-caption');
                screenshots.forEach((scr) => scr.classList.remove('active'));
                screenshot.classList.add('active');
            });
        });
    </script>
</body>

</html>