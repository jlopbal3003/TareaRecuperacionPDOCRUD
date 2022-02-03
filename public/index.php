<?php
session_start();
//Si no existe la variable usuario, redirige al login
if (!isset($_SESSION['usuario'])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sesión iniciada</title>
</head>

<body class="bg-gray-900">
    <div class="h-screen bg-gray-900 flex justify-center items-center w-full">
        <!-- Botón para cerrar sesión (redirige a cerrarsesion.php) -->
        <a href="cerrarsesion.php" class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-2 border-b-4 border-red-700 hover:border-red-500 mt-5 rounded-full">&nbsp;<i class="fas fa-power-off"></i>&nbsp;</a>
    </div>
</body>

</html>