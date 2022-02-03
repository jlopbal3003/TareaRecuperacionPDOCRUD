<?php
session_start();
//Elimina las variables session y redirige al login
session_destroy();
header("Location: login.php");
