<?php
require 'classes/chat.Class.php';
session_start();

$chat = new Chat();
$id_game=1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['mymessage'])) {
   $chat->sendMessage($id_game,$_POST['mymessage']);

  }}
 $chats= $chat->getMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

  <!-- Chat Form -->
  <div class="w-full max-w-md bg-white shadow-md rounded-lg p-4">
    <div id="chat-box" class="h-64 overflow-y-auto border border-gray-300 rounded-lg p-4 mb-4 bg-gray-50">
    <?php if (count($chats) > 0): ?>
    <?php foreach ($chats as $chat): ?>
      <div>
      <p class="text-xl font-bold  leading-relaxed pt-6"> <?= htmlspecialchars($_SESSION["ID_user"]) ?></p>
      <h5 class="text-xl  font-semibold flex-1 "> <?= htmlspecialchars($chat["message_chat"]) ?></h5>
      <h5 class="text-xl  flex-1 "> <?= htmlspecialchars($chat["massage_at"]) ?></h5>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <h4> Soiez le 1 ere dans le chat </h4>

  <?php endif; ?>
    </div>
    <form id="chat-form" class="flex gap-2" method="POST">
      <input name="mymessage"
        type="text" 
        id="chat-input" 
        class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
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


  <script>
  </script>

</body>
</html>
