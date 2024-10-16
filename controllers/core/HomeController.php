<?php
    // Importes
    require '../../config.php';

    class HomeController 
    {
        public function showTurns() {
            require_once '../../models/Turn.php';
            $turnModel = new Turn();
            $turns = $turnModel->getAllTurns();
            return $turns;
        }

        public function hasAccessTokenInCookies() {
            $cookie = $_COOKIE["accessToken"];
            if (!isset($cookie)) {
                header("Location: ../../views/auth/login.php");
                exit();
            }
            return true;
        }

    }
?>