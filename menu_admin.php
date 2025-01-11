<?php

$test = new personne();
if (isset($_POST['deconnexion'])) {
    $test->logout();
}
$user = $test->getUser();
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<nav class="bg-[#121e31] h-screen fixed top-0 left-0 min-w-[250px] py-6 px-4 font-[sans-serif] tracking-wide overflow-auto">
    <a href="profil.php">
        <div class="flex flex-wrap items-center gap-4 cursor-pointer">
            <img src="data:<?= $user['mimi']; ?>;base64,<?= $user['photo']; ?>" class="w-10 h-10 rounded-full border-2 border-white" />
            <div>
                <p class="text-sm text-white"><?= $test->getNameP(); ?></p>
                <p class="text-xs text-gray-300 mt-0.5"><?= $test->getRole(); ?></p>
            </div>
        </div>
    </a>
    <hr class="my-6 border-gray-400" />

    <ul class="space-y-7">
        <li>
            <a href="home.php" class="text-white text-sm flex items-center hover:bg-gray-700 rounded px-4 py-3 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4" viewBox="0 0 512 512">
                    <path
                        d="M197.332 170.668h-160C16.746 170.668 0 153.922 0 133.332v-96C0 16.746 16.746 0 37.332 0h160c20.59 0 37.336 16.746 37.336 37.332v96c0 20.59-16.746 37.336-37.336 37.336zM37.332 32A5.336 5.336 0 0 0 32 37.332v96a5.337 5.337 0 0 0 5.332 5.336h160a5.338 5.338 0 0 0 5.336-5.336v-96A5.337 5.337 0 0 0 197.332 32zm160 480h-160C16.746 512 0 495.254 0 474.668v-224c0-20.59 16.746-37.336 37.332-37.336h160c20.59 0 37.336 16.746 37.336 37.336v224c0 20.586-16.746 37.332-37.336 37.332zm-160-266.668A5.337 5.337 0 0 0 32 250.668v224A5.336 5.336 0 0 0 37.332 480h160a5.337 5.337 0 0 0 5.336-5.332v-224a5.338 5.338 0 0 0-5.336-5.336zM474.668 512h-160c-20.59 0-37.336-16.746-37.336-37.332v-96c0-20.59 16.746-37.336 37.336-37.336h160c20.586 0 37.332 16.746 37.332 37.336v96C512 495.254 495.254 512 474.668 512zm-160-138.668a5.338 5.338 0 0 0-5.336 5.336v96a5.337 5.337 0 0 0 5.336 5.332h160a5.336 5.336 0 0 0 5.332-5.332v-96a5.337 5.337 0 0 0-5.332-5.336zm160-74.664h-160c-20.59 0-37.336-16.746-37.336-37.336v-224C277.332 16.746 294.078 0 314.668 0h160C495.254 0 512 16.746 512 37.332v224c0 20.59-16.746 37.336-37.332 37.336zM314.668 32a5.337 5.337 0 0 0-5.336 5.332v224a5.338 5.338 0 0 0 5.336 5.336h160a5.337 5.337 0 0 0 5.332-5.336v-224A5.336 5.336 0 0 0 474.668 32zm0 0"
                        data-original="#000000" />
                </svg>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="statistique.php" class="text-white text-sm flex items-center hover:bg-gray-700 rounded px-4 py-3 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-4" viewBox="0 0 16 16">
                    <path
                        d="M13 .5H3A2.503 2.503 0 0 0 .5 3v10A2.503 2.503 0 0 0 3 15.5h10a2.503 2.503 0 0 0 2.5-2.5V3A2.503 2.503 0 0 0 13 .5ZM14.5 13a1.502 1.502 0 0 1-1.5 1.5H3A1.502 1.502 0 0 1 1.5 13v-.793l3.5-3.5 1.647 1.647a.5.5 0 0 0 .706 0L10.5 7.207V8a.5.5 0 0 0 1 0V6a.502.502 0 0 0-.5-.5H9a.5.5 0 0 0 0 1h.793L7 9.293 5.354 7.647a.5.5 0 0 0-.707 0L1.5 10.793V3A1.502 1.502 0 0 1 3 1.5h10A1.502 1.502 0 0 1 14.5 3Z"
                        data-original="#000000" />
                </svg>
                <span>Statistique</span>
            </a>
        </li>
        <li>
            <a href="gererUser.php" class="text-white text-sm flex items-center hover:bg-gray-700 rounded px-4 py-3 transition-all">
                <img src="images/icons8-users-60.png" class="w-[22px] h-[22px] mr-4" alt="">
                <span>Users</span>
            </a>
        </li>
        <li>
            <a href="gererGame.php" class="text-white text-sm flex items-center hover:bg-gray-700 rounded px-4 py-3 transition-all">
                <div class="w-[22px] h-[22px] mr-4">
                    <i class="fas fa-gamepad" style="color: white; font-size: 1.25rem;"></i>
                </div>
                <span>Games</span>
            </a>
        </li>
        <li>
            <a href="home.php"
                class="text-gray-300 hover:text-white text-sm flex items-center rounded-md pl-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    class="w-[18px] h-[18px] mr-4" viewBox="0 0 6.35 6.35">
                    <path
                        d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                        data-original="#000000" />
                </svg>
                <form action="" method="post">
                    <button name="deconnexion">Logout</button>
                </form>
            </a>
        </li>
        
</nav>