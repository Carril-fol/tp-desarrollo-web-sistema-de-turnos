<?php
    // Importes
    require '../../config.php';
    require '../../models/Turn.php';

    class HomeController 
    {
        public function showTurns() {
            $turnModel = new Turn();
            $turns = $turnModel->getAllTurns();
            return $turns;
        }

        public function hasAccessTokenInCookies() {
            $cookie = $_COOKIE["accessToken"];
            if (!isset($cookie)) {
                return false;
            }
            return true;
        }

    }
?>