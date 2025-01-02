<?php
session_start();

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "gamevault_db";

try {
    $connexion = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $message = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"] ?? '';
        $password = $_POST["pass"] ?? '';

        $sql = "SELECT * FROM personne WHERE email = :email";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password_hash'])) { 
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['last_name'] = $user['last_name']; 
            $_SESSION['email'] = $user['email'];

            header("Location: index.php");
            exit;
        } else {
            $message = "email ou mot de passe incorrect !";
        }
    }
} catch (PDOException $e) {
    $message = 'y a un prob ! ' . htmlspecialchars($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body class="bg-[#f9dbbd] h-[100vh] relative ">
<?php include "header.php" ; ?>
<div class="relative w-[100%] h-[90%] flex">
    
    <div class="relative text-white text-center flex flex-col gap-4 mx-auto border-2 rounded-[15px] p-4 w-[40%] py-6 self-center bg-[#a53860]" >   
    <!-- <img class="absolute top-0 left-0" src="images/BDLBzN2QSOW6Gd7Un7iKsw-removebg-preview.png" alt=""> -->
     
    <h1 class="text-2xl uppercase font-semibold">Login page </h1>

    <form class="flex flex-col gap-6" method="POST" action="">
    <?php if (!empty($message)): ?>
                    <div class="message"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>
    <div class="flex flex-col gap-2 w-[75%] mx-auto">
        <label class="text-x1 font-semibold text-left " for="">Email</label>
        <input class="outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" name="email" type="email" placeholder="Enter yout email">
    </div>
    <div class="flex flex-col gap-2 w-[75%] mx-auto relative ">
        <label class="text-x1 font-semibold text-left" for="">Password</label>
        <input class=" passo relative outline-none px-4 py-2 rounded-full bg-transparent border-2 text-white" name="pass" type="password" placeholder="enter your password">
        <img class=" icone cursor-pointer absolute right-3 top-11 w-[20px] h-[20px]" src="images/icons8-closed-eye-48.png" alt="">
    </div>
    <div class="text-md flex gap-4 mx-auto items-center underline text-[#da627d]">
        <a class="hover:text-[#450920]" href="">Forgot Password</a>
    </div>
    <button class="bg-[#da627d] px-4 py-2 text-x1 w-[200px] mx-auto transition-all ease-in-out duration-300 hover:bg-[#fff] hover:text-[#da627d] hover:border-[#da627d] border-2">Login</button>
</form>
    </div>
    <img class="absolute bottom-0 left-0 w-[520px] h-[520px]" src="images/BDLBzN2QSOW6Gd7Un7iKsw-removebg-preview.png" alt="">
    </div>
    <?php include "footer.php" ; ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
    let icone=document.querySelector(".icone");
    console.log(icone);

    if (icone) { 
    icone.addEventListener("click",(e)=>{
        let ps= document.querySelector(".passo")
        const src1 ="images/icons8-eye-48.png";
        const src2 ="images/icons8-closed-eye-48.png";
        if(icone.getAttribute("src") ===src1){
            icone.setAttribute("src",src2);
            ps.setAttribute("type","password");
        }
        else if (icone.getAttribute("src") ===src2){
            icone.setAttribute("src",src1);
            ps.setAttribute("type","text");
        }
     
    }) } 
})

</script>
</body>
</html>