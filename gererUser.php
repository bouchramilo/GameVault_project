<?php
require_once 'classes/admin.Class.php';
session_start();

$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_user']) && isset($_POST['role'])) {
        $admin->updateRole($_POST['id_user'], $_POST['role']);
    } elseif (isset($_POST['id_user'])) {
        $admin->deleteUser($_POST['id_user']);
    } elseif (isset($_POST['id_banner']) && isset($_POST['banner'])) {
        $admin->updateBanner($_POST['id_banner'], $_POST['banner']);
    }
}

$users = $admin->getUsers();
?>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Gestion des utilisateurs </title>
</head>

<body class="flex flex-col w-screen">
    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <section class="relative h-max min-h-screen overflow-hidden pb-10">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay loop muted playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>
        <div class="relative z-10 flex flex-row gap-4 h-max text-center text-white bg-black bg-opacity-30">

            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <?php include 'menu_admin.php' ?>
            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="font-[sans-serif] overflow-x-auto grid justify-end w-screen grid-cols-[84%] px-12">
                <h1 class="mx-6 text-3xl font-bold md:text-5xl text-start my-6">Gestion des utilisateurs</h1>


                <table class="min-w-full bg-black bg-opacity-50 mt-10 ">
                    <thead class="bg-gray-800 whitespace-nowrap">
                        <tr>
                            <th class="p-4 text-center text-sm font-medium text-white">
                                Name
                            </th>
                            <th class="p-4 text-center text-sm font-medium text-white">
                                Email
                            </th>
                            <th class="p-4 text-center text-sm font-medium text-white">
                                Role
                            </th>
                            <th class="p-4 text-center text-sm font-medium text-white">
                                Joined At
                            </th>
                            <th class="p-4 text-center text-sm font-medium text-white">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="whitespace-nowrap">
                        <?php if (count($users) > 0): ?>
                            <?php foreach ($users as $user): ?>
                                <tr class="bg-gray-600 ">
                                    <td class="p-4 text-sm text-white text-center">
                                        <?= htmlspecialchars($user["first_name"] . " " . $user["last_name"]) ?>
                                    </td>
                                    <td class="p-4 text-sm text-white text-center">
                                        <?= htmlspecialchars($user["email"]) ?>
                                    </td>
                                    <td class="p-4 text-sm text-white text-center">
                                        <?= htmlspecialchars($user["role"]) ?>
                                    </td>
                                    <td class="p-4 text-sm text-white text-center">
                                        <?= htmlspecialchars($user["create_at"]) ?>
                                    </td>
                                    <td class="p-4">
                                        <button class="mr-4 " title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class=" w-5 fill-blue-500 hover:fill-blue-700" onclick="editUser('<?= $user['id_user'] ?>', '<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>', '<?= htmlspecialchars($user['role']) ?>')"
                                                viewBox="0 0 348.882 348.882">
                                                <path
                                                    d="m333.988 11.758-.42-.383A43.363 43.363 0 0 0 304.258 0a43.579 43.579 0 0 0-32.104 14.153L116.803 184.231a14.993 14.993 0 0 0-3.154 5.37l-18.267 54.762c-2.112 6.331-1.052 13.333 2.835 18.729 3.918 5.438 10.23 8.685 16.886 8.685h.001c2.879 0 5.693-.592 8.362-1.76l52.89-23.138a14.985 14.985 0 0 0 5.063-3.626L336.771 73.176c16.166-17.697 14.919-45.247-2.783-61.418zM130.381 234.247l10.719-32.134.904-.99 20.316 18.556-.904.99-31.035 13.578zm184.24-181.304L182.553 197.53l-20.316-18.556L294.305 34.386c2.583-2.828 6.118-4.386 9.954-4.386 3.365 0 6.588 1.252 9.082 3.53l.419.383c5.484 5.009 5.87 13.546.861 19.03z"
                                                    data-original="#000000" />
                                                <path
                                                    d="M303.85 138.388c-8.284 0-15 6.716-15 15v127.347c0 21.034-17.113 38.147-38.147 38.147H68.904c-21.035 0-38.147-17.113-38.147-38.147V100.413c0-21.034 17.113-38.147 38.147-38.147h131.587c8.284 0 15-6.716 15-15s-6.716-15-15-15H68.904C31.327 32.266.757 62.837.757 100.413v180.321c0 37.576 30.571 68.147 68.147 68.147h181.798c37.576 0 68.147-30.571 68.147-68.147V153.388c.001-8.284-6.715-15-14.999-15z"
                                                    data-original="#000000" />
                                            </svg>
                                        </button>
                                        <form method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');" style="display:inline;">
                                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                            <button type="submit" class="mr-4" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-red-500 hover:fill-red-700" viewBox="0 0 24 24">
                                                    <path
                                                        d="M19 7a1 1 0 0 0-1 1v11.191A1.92 1.92 0 0 1 15.99 21H8.01A1.92 1.92 0 0 1 6 19.191V8a1 1 0 0 0-2 0v11.191A3.918 3.918 0 0 0 8.01 23h7.98A3.918 3.918 0 0 0 20 19.191V8a1 1 0 0 0-1-1Zm1-3h-4V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v2H4a1 1 0 0 0 0 2h16a1 1 0 0 0 0-2ZM10 4V3h4v1Z"
                                                        data-original="#000000" />
                                                    <path d="M11 17v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Zm4 0v-7a1 1 0 0 0-2 0v7a1 1 0 0 0 2 0Z"
                                                        data-original="#000000" />
                                                </svg>
                                            </button>
                                        </form>
                                        <button name="banner" onclick="banner('<?= $user['id_user'] ?>', '<?= htmlspecialchars($user['banner']) ?>')">
                                            <img src="images/icons8-unfriend-50.png " class=" w-6 fill-blue-500 hover:fill-blue-700" alt="">
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Aucun utilisateur trouvé</td>
                            </tr>
                        <?php endif; ?>


                    </tbody>
                </table>
            </div>

            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            <!-- banissement ****************************************************************************************** -->
            <div id="bannerModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
                <div class="bg-white text-black rounded-lg shadow-lg max-w-md w-full p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le rôle :</h2>

                    <form method="POST">
                        <input type="hidden" id="id_banner" name="id_banner">

                        <div class="mb-4">
                            <label for="banner" class="block text-sm font-medium text-gray-600 mb-1">
                                Banissement:
                            </label>
                            <select id="banner" name="banner" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                                <option value="0">non banner</option>
                                <option value="1">banner</option>
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
            <!-- modification           ************************************************************************ -->
            <div id="roleModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden z-50">
                <div class="bg-white text-black rounded-lg shadow-lg max-w-md w-full p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Modifier le rôle :</h2>

                    <form method="POST">
                        <input type="hidden" id="id_user" name="id_user">

                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-600 mb-1">
                                Nom de l'utilisateur
                            </label>
                            <input type="text" id="username" name="username" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300" value="" disabled>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-600 mb-1">
                                Nouveau rôle
                            </label>
                            <select id="role" name="role" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
                                <option value="admin">Admin</option>
                                <option value="user">Utilisateur</option>
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

        </div>
    </section>

    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <script>
        function editUser(id, username, role) {
            document.getElementById('id_user').value = id;
            document.getElementById('username').value = username;
            document.getElementById('role').value = role;

            document.getElementById('roleModal').classList.remove('hidden');
        }

        function banner(id, banner) {
            document.getElementById('id_banner').value = id;
            document.getElementById('banner').value = banner;

            document.getElementById('bannerModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('roleModal').classList.add('hidden');
        }
    </script>



</body>

</html>

</html>