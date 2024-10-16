<?php
    // Importes
    require '../../models/User.php';
    require '../../models/Administrative.php';
    require '../../models/Medic.php';
    require '../../models/Patient.php';

    class RegisterUsersController {

        private $userModel;
        private $administrativeModel;
        private $medicModel;
        private $patientModel;

        function __construct() {
            $this->userModel = new User;
            $this->administrativeModel = new Administrative;
            $this->medicModel = new Medic;
            $this->patientModel = new Patient;
        }

        private function sanitizeInput($input) {
            return htmlentities(addslashes($input));
        }

        private function verifyPasswordsAreEqual() {
            $password = $this->sanitizeInput($_POST['password']);
            $confirmPassword = $this->sanitizeInput($_POST['confirmPassword']);
            if ($password !== $confirmPassword) {
                throw new Exception("Las contraseñas ingresadas no son iguales.");
            }
        }

        private function createUserBasedOnOccupation($dni) {
            $occupation = $this->sanitizeInput($_POST['occupation']);
            switch ($occupation) {
                case 'ADMINISTRATIVO':
                    $this->administrativeModel->createAdministrative($dni);
                    break;
                case 'MEDICO':
                    $medicLicense = $this->sanitizeInput($_POST['medicLicense']);
                    $medicSpeciality = $this->$_POST['specialty'];
                    $this->medicModel->createMedic(
                        $$dni, 
                        $medicLicense, 
                        $medicSpeciality
                    );
                    break;
                case 'PACIENTE':
                    $patientNumberHealthInsurance = $this->sanitizeInput($_POST['numberHealthInsurance']);
                    $patientIsPartner = $_POST['isPartner'];
                    $this->patientModel->createPatient(
                        $$dni, 
                        $patientNumberHealthInsurance, 
                        $patientIsPartner
                    );
                    break;
            }
        }

        private function createUser() {
            $firstName = $this->sanitizeInput($_POST['firstName']);
            $lastName = $this->sanitizeInput($_POST['lastName']);
            $dni = $this->sanitizeInput($_POST['dni']);
            $email = $this->sanitizeInput($_POST['email']);
            $confirmPassword = $this->sanitizeInput($_POST['confirmPassword']);
            $passwordHashed = password_hash($confirmPassword, PASSWORD_DEFAULT);
            
            $userCreated = $this->userModel->createUser(
                $dni, 
                $firstName, 
                $lastName, 
                $email, 
                $passwordHashed, 
                false, 
                false
            );
            if (!$userCreated) {
                throw new Exception("Error al crear el usuario");
            }
            return $dni;
        }

        private function handleError($error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            header("Location: ../../views/auth/register.php");
            exit();
        }

        public function register() {
            try {
                $this->verifyPasswordsAreEqual();

                $userCreatedDni = $this->createUser();
                
                $this->createUserBasedOnOccupation($userCreatedDni);
            } catch (Exception $error) {
                $this->handleError($error);
            }
        }
    }

    $registerUsersController = new RegisterUsersController;
    $registerUsersController->register();
?>