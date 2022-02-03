<?php
session_start();
require dirname(__DIR__, 1) . "/vendor/autoload.php";

use Tarearecuperacion1\Users;

//Generamos 49 usuarios aleatorios + el usuario admin (generado de forma manual)
(new Users)->generarUsuarios(49);
//Guardamos los datos de los usuarios en un array
$usuarios = (new Users)->readAll();

//Si se pulsa el boton login
if (isset($_POST['btnLogin'])) {
    //Se guarda el usuario introducido
    $usuariologin = $_POST["usuario"];
    //Se guarda la contraseña introducida
    $passlogin = $_POST["password"];
    //Recorremos el array
    foreach ($usuarios as $item) {
        //Si un usuario del array coincide con el introducido
        if ($item->username == $usuariologin && $item->pass == $passlogin) {
            //Creamos una variable session
            $_SESSION["usuario"] = 1;
            //Redirige al index
            header("Location: index.php");
            //Y se sale del for
            break;
        } else {
            //Usuario incorrecto, error
            $_SESSION['errorLogin'] = true;
            //Redirige a la misma página
            header('Location: ' . $_SERVER['PHP_SELF']);
            die;
        }
    }
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
    <title>Login</title>
</head>

<body class="bg-gray-900">
    <!-- component -->
    <div class="h-screen bg-gray-900 flex justify-center items-center w-full">
        <form name="cautor" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
            <div class="bg-white px-10 py-8 rounded-xl w-screen shadow-md max-w-sm">
                <div class="space-y-4">
                    <div>
                        <?php
                        //Si existe la variable de error, muestra un mensaje de alerta
                        if (isset($_SESSION['errorLogin'])) {
                            echo <<< TXT
                            <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3 my-5" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p>Usuario y/o contraseña incorrectos.</p>
                            </div>
                            TXT;
                            unset($_SESSION["errorLogin"]);
                        }
                        ?>
                        <label for="usuario" class="block mb-1 text-gray-600 font-semibold"><i class="fas fa-user"></i> Usuario:</label>
                        <input type="text" name="usuario" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />
                    </div>
                    <div>
                        <label for="password" class="block mb-1 text-gray-600 font-semibold"><i class="fas fa-lock"></i> Contraseña:</label>
                        <input type="password" name="password" class="bg-indigo-50 px-4 py-2 outline-none rounded-md w-full" />
                    </div>
                </div>
                <button type="submit" name="btnLogin" class="mt-4 w-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-indigo-100 py-2 rounded-md text-lg tracking-wide">Iniciar sesión</button>
            </div>
        </form>
    </div>
</body>

</html>