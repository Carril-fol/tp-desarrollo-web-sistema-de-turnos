<?php

session_start();

require_once __DIR__ . '/../core/Controller.php';
require __DIR__ . '/../models/User.php';

class Auth extends Controller
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    private function createCookieData($userData)
    {
        $timeExp = time() + 12345;
        $cookieData = array('data'=>$userData, 'exp'=>$timeExp);
        $cookie = setcookie('accessToken', json_encode($cookieData), $timeExp);
        return $cookie;
    }

    private function setCookieAndSession($dni)
    {
        $userData = $this->userModel->getDataFromUserByDni($dni);
        $this->createCookieData($userData);
        $_SESSION['userData'] = $userData;
    }

    private function authenticateUser($dni, $password)
    {
        $userData = $this->userModel->getDniAndPasswordFromUserByDni($dni);
        if (!$userData) {
            return false;
        }

        $userDataFormatedArray = $this->userModel->formatUserData($userData);
        if (!password_verify($password, $userDataFormatedArray[1])) {
            return false;
        }

        return true;
    }

    public function login()
    {
        require_once __DIR__ . '/../views/auth/login.php';
        if (isset($_POST['dni']) && isset($_POST['password'])) {
            $dni =  htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
            $password =  htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
            if ($this->authenticateUser($dni, $password)) {
                # TODO: No se guardan las cookies y la session.
                $this->setCookieAndSession($dni);
                header('Location: ../home/index');
                exit();
            } else {
                $_SESSION['error_message'] = 'DNI o contraseña incorrectos.';
            }
        }
    }
}

?>