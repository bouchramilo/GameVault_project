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
                <img src="images/Paner.jpg" alt="Image principale du jeu" class="w-full rounded-lg shadow-lg">
            </div>

            <div class="flex-1">
                <h2 class="text-3xl font-bold text-[#da627d] mb-4">Détails du Jeu</h2>
                <ul class="space-y-2">
                    <li><strong>Nom :</strong> Micraft</li>
                    <li><strong>Catégorie :</strong> Action - Tactique </li>
                    <li><strong>Date de sortie :</strong> 15 janvier 2025</li>
                    <li><strong>Createur :</strong> Admin(......)</li>
                    <li><strong>Prix :</strong> 50 DH</li>
                </ul>
                <p class="description mt-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam fugit obcaecati repellat, molestias reprehenderit sed saepe eligendi deleniti magni rem voluptatem, beatae doloremque nemo ipsum, reiciendis blanditiis eos nam voluptatibus!
                </p>
                <div class="mt-6 flex gap-4">
                    <button class="bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d]  transition">
                        Jouer
                    </button>
                    <button class="bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d]  transition">
                        Acheter le Jeu
                    </button>
                    <button class="bg-[#da627d] text-white py-2 px-4 rounded-md hover:bg-[#f9dbbd] hover:text-[#da627d] transition">
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