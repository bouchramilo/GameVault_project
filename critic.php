<?php
require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/library.Class.php';
require_once 'classes/favoris.Class.php';
require_once 'classes/admin.Class.php';
require_once 'classes/critique.Class.php';

session_start();

$critic = new critique();
if (isset($_POST['add_critique'])) {
  // echo 'azerty'.$_GET['id_game'];
  $critique = $critic->addCritique(1, $_POST['critique']);
}

$AllCritique = $critic->getAllCritiquesForGame(1);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter une critique</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-lg bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Ajouter une Critique</h2>
    <form id="" method="post" class="space-y-4">
      <div>
        <label for="comment" class="block text-gray-700 font-medium">Ajouter votre critique</label>
        <textarea
          id="comment"
          name="critique"
          rows="4"
          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Votre avis sur le jeu..."
          required></textarea>
      </div>


      <button
        type="" name="add_critique"
        class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 font-medium">
        Soumettre la Critique
      </button>
    </form>

    <div id="reviews-container" class="mt-6 space-y-4">
        <h3 class="text-xl font-semibold text-gray-800">Avis des Joueurs :</h3>
        <?php foreach($AllCritique as $critique): ?>
          <div class="bg-white rounded-lg p-4 shadow-md">
            <p class="text-gray-700"><span class="font-bold"><?= $critique['user_full_name'] ?></span> - <span><?= $critique['create_at'] ?></span> -</p>
            <p class="text-gray-700"><?= $critique['content'] ?></p>
          </div>
        <?php endforeach ; ?>
      </div>
  </div>

  <script>

  </script>

</body>

</html>