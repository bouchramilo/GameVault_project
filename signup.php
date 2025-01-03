<?php


require_once 'classes/dataBase.Class.php';
require_once 'classes/historique.Class.php';
require_once 'classes/game.Class.php';
require_once 'classes/library.Class.php';
require_once 'classes/personne.Class.php';


$db = new Database();
$message = '';
$personne = new personne();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $photo = $_POST["photo"] ?? '';
    $fname = $_POST["fname"] ?? '';
    $lname = $_POST["lname"] ?? '';
    $bdate = $_POST["bdate"] ?? '';
    $email = $_POST["email"] ?? '';
    $pass = $_POST["pass"] ?? '';
    $cpass = $_POST["cpass"] ?? '';

    $result = $personne->register($photo, $fname, $lname, $bdate, $email, $pass, $cpass);

    if (isset($result['error'])) {
        $message = $result['error'];
    } elseif (isset($result['success'])) {
        $message = $result['success'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sign Up</title>
</head>

<body class="h-[100vh] relative ">
    <?php include "header.php"; ?>
    <div class="relative h-max py-20 overflow-hidden flex flex-row justify-center">
        <video
            class="absolute top-1/2 left-1/2 w-auto min-w-full min-h-full transform -translate-x-1/2 -translate-y-1/2 object-cover"
            autoplay
            loop
            muted
            playsinline>
            <source src="images/bg_1.mp4" type="video/mp4" />
        </video>

        <div class="relative z-10 text-white text-center h-max flex flex-col gap-4 mx-auto border-0 rounded-[15px] p-4 w-[40%] py-6 self-center bg-black opacity-75 ">
             <!-- <img class="absolute top-0 left-0" src="images/BDLBzN2QSOW6Gd7Un7iKsw-removebg-preview.png" alt=""> -->

            <h1 class="text-2xl uppercase font-semibold mb-[40px]">Sign Up page </h1>


            <form class="flex flex-col gap-4" method="POST" action="">
                <div class="grid grid-cols-[30%_70%] gap-4 w-[75%] mx-auto">
                    <label class="text-x1 font-semibold text-right pr-[15px] " for="">Photo:</label>
                    <input class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" name="photo" id="photo" accept="image/*" type="file">
                </div>

                <div class="grid grid-cols-[30%_70%] gap-4  w-[75%] mx-auto">
                    <label class="text-x1 font-semibold text-right pr-[15px]" for="">First name:</label>
                    <input class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" type="text" name="fname" placeholder="Enter yout first name">
                </div>
                <div class="grid grid-cols-[30%_70%] gap-4  w-[75%] mx-auto">
                    <label class="text-x1 font-semibold text-right pr-[15px]" for="">Last Name:</label>
                    <input class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" type="text" name="lname" placeholder="Enter yout last name">
                </div>
                <div class="grid grid-cols-[30%_70%] gap-4  w-[75%] mx-auto">
                    <label class="text-x1 font-semibold text-right pr-[15px]" for="">Birthday:</label>
                    <input class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" type="date" name="bdate" placeholder="DATE">
                </div>
                <div class="grid grid-cols-[30%_70%] gap-4  w-[75%] mx-auto">
                    <label class="text-x1 font-semibold text-right pr-[15px]" for="">Email:</label>
                    <input class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" type="email" name="email" placeholder="Enter yout email">
                </div>
                <div class="grid grid-cols-[30%_70%] gap-4  w-[75%] mx-auto relative">
                    <label class="text-x1 font-semibold text-right pr-[15px]" for="">Password:</label>
                    <input class="passo relative outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" type="password" name="pass" placeholder="Enter your password">
                    <button type="button" class="icone "><img class="cursor-pointer absolute right-0 top-3 w-[20px] h-[20px]" src="images/icons8-closed-eye-48.png" alt="">
                    </button>
                </div>
                <div class="grid grid-cols-[30%_70%] gap-4  w-[75%] mx-auto relative">
                    <label class="text-x1 font-semibold text-right pr-[15px]" for="">Confirm Password:</label>
                    <input class="passo relative outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" type="password" name="cpass" placeholder="Confirm your password">
                    <button type="button" class="icone "><img class="cursor-pointer absolute right-0 top-4 w-[20px] h-[20px]" src="images/icons8-closed-eye-48.png" alt="">
                    </button>
                </div>
                <?php if (!empty($message)): ?>
                    <div class="error"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>
                <div class="text-md flex gap-4 mx-auto items-center underline text-[#da627d]">
                    <a class="hover:text-[#450920]" href="">Forgot Password</a>
                </div>
                <button class="bg-[#da627d] px-4 py-2 text-white text-x1 w-[200px] mx-auto  transition-all ease-in-out duration-300 hover:bg-[#fff] hover:text-[#da627d] hover:border-[#da627d] border-2" name="sign">Sign Up</button>

            </form>
        </div>
        <img class="absolute z-10 bottom-0 left-0 w-[720px] h-[720px]" src="images/image1-removebg-preview (1).png" alt="">
    </div>
    <?php include "footer.php"; ?>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let icones = document.querySelectorAll(".icone");
            icones.forEach((icone) => {
                console.log("test");
                icone.addEventListener("click", (e) => {
                    let ps = icone.closest('.relative').querySelector(".passo");
                    const src1 = "images/icons8-eye-48.png";
                    const src2 = "images/icons8-closed-eye-48.png";
                    if (icone.getAttribute("src") === src1) {
                        icone.setAttribute("src", src2);
                        ps.setAttribute("type", "password");
                    } else if (icone.getAttribute("src") === src2) {
                        icone.setAttribute("src", src1);
                        ps.setAttribute("type", "text");
                    }
                });
            });
        });
    </script>
</body>

</html>