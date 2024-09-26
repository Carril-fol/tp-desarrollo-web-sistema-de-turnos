<?php
// Imports
require '../../config.php';
require '../../models/UserModel.php';

// Instance PersonModel
$userModel = new UserModel;

// Data from the view.
$dni = $_POST['dni'];
$password = $_POST['password'];

// Functions
function authenticateUser($dni, $password)
{
    global $userModel;
    $userData = $userModel->getUserByDni($dni);
    $userDataFormatedArray = $userModel->formatUserData($userData);
    $cookieUser = $userModel->createCookieData($userDataFormatedArray);
    header('Location: ../../views/home.php');
    exit();
}

// Call function.
authenticateUser($dni, $password);

?>