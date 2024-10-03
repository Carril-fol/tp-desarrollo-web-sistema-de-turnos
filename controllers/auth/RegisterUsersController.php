<?php
    // Importes
    require '../../config.php';
    require '../../models/User.php';

    // Instancia de modelo de usuario
    $userModel = new User;

    try {
        $firstName = htmlentities(addslashes(strtoupper($_POST['firstName'])));
        $lastName = htmlentities(addslashes(strtoupper($_POST['lastName'])));
        $occupation = strtoupper($_POST['occupation']);
        $dni = htmlentities(addslashes($_POST['dni']));
        $email = strtolower($_POST['email']);
        $password = htmlentities(addslashes($_POST['password']));
        $confirmPassword = htmlentities(addslashes($_POST['confirmPassword']));
        
        if ($password != $confirmPassword) {
            throw new Exception('Las contraseñas no son iguales.');
        }
        $passwordHashed = password_hash($confirmPassword, PASSWORD_DEFAULT);

        $userCreated = $userModel->createUser($dni, $firstName, $lastName, $email, $passwordHashed);
        if (!$userCreated) {
            throw new Exception('Error al crear el usuario.');
        }

        $getUserCreated = $userModel->getDataFromUserByDni($dni);

        // Diferentes creaciónes de registros segun la ocupación de los usuarios
        switch ($occupation) {
            case 'ADMINISTRATIVO':
                require_once '../../models/Administrative.php';
                $administrativeModel = new Administrative;
                $administrativeModel->createAdministrative($getUserCreated['id']);
                break;
            case 'MEDICO':
                require_once '../../models/Medic.php';
                $medicModel = new Medic;
                $medicLicense = htmlentities(addslashes(strtoupper($_POST['medicLicense'])));
                $medicSpeciality = htmlentities(addslashes(strtoupper($_POST['specialty'])));
                $medicModel->createMedic(
                    $getUserCreated['id'], 
                    $medicLicense, 
                    $medicSpeciality
                );
                break;
            case 'PACIENTE':
                require_once '../../models/Patient.php';
                $patientModel = new Patient;
                $patientNumberHealthInsurance = $_POST['numberHealthInsurance'];
                $patientIsPartner = $_POST['isPartner'];
                $patientModel->createPatient(
                    $getUserCreated['id'], 
                    $patientNumberHealthInsurance, 
                    $patientIsPartner
                );
                break;
        }
    
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../../views/auth/register.php");
        exit();
    }
    
?>