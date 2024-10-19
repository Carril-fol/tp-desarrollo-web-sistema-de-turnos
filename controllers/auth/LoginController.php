<?php
    require '../../models/User.php';

    class LoginController
    {
        private $userModel;
        public $dni;
        public $password;

        function __construct() {
            $this->userModel = new User;
            $this->dni = $_POST['dni'];
            $this->password = $_POST['password'];
        }

        private function sanitizeInput($input) {
            return htmlentities(addslashes($input));
        }

        private function verifyCredentials($dni, $password) {
            $userDataLogin = $this->userModel->getDniAndPasswordFromUserByDni($dni);
            if (!password_verify($password, $userDataLogin['contraseña'])) {
                throw new Exception("DNI o Contraseña incorrectos.");
            }
        }

        private function redirectToHome() {
            header("Location: ../../views/core/home.php");
            exit();
        }

        private function handleError($error) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            header("Location: ../../views/auth/login.php");
            exit();
        }

        public function authenticate() {
            try {
                $dni = $this->sanitizeInput($this->dni);
                $password = $this->sanitizeInput($this->password);
                
                $this->verifyCredentials($dni, $password);
    
                $userDataLogged = $this->userModel->getDataFromUserByDni($dni);
                $this->userModel->createCookieData($userDataLogged);
                
                $this->redirectToHome();
            } catch (Exception $error) {
                $this->handleError($error);
            }
        }
    }
    
    $loginController = new LoginController;
    $loginController->authenticate();
?>