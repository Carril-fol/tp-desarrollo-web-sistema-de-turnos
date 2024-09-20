<?php
// Imports
require '../../config.php';
require '../../models/UserModel.php';

// Instance UserModel
$userModel = new UserModel;

// Data from the view.
$firstName = strtoupper($_POST['firstName']);
$lastName = strtoupper($_POST['lastName']);
$occupation = strtoupper($_POST['occupation']);
$dni = $_POST['dni'];
$email = strtolower($_POST['email']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$status = 'ALTA';

// Functions 
function createUser($dni, $firstName, $lastName, $email, $password, $status)
{
    global $userModel;
    $createUser = $userModel->createUser($dni, $firstName, $lastName, $email, $password, $status);
    $getUserCreated = $userModel->getUserByDni($dni);
    $formatUserDataCreated = $userModel->formatUserData($getUserCreated);
    return $formatUserDataCreated;
}

function createAdministrative($formatUserDataCreated)
{
    require_once '../../models/AdministrativeModel.php';
    $administrativeModel = new AdministrativeModel;
    $userId = $formatUserDataCreated[0];
    $createAdministrative = $administrativeModel->createAdministrative($userId);
}

switch ($occupation) {
    case 'Administrativo':
        $userCreated = createUser($dni, $firstName, $lastName, $email, $password, $status);
        $administrativeCreated = createAdministrative($userCreated);
        break;
    case 'Medico':
        break;
    case 'Paciente':
        break;

    header();
    exit();
}

?>