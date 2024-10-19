<?php

    class Controller
    {

        public  function sanitizeInput($input) {
            return htmlentities(addslashes($input));
        }

        public function handleError($error, $folder, $file) {
            session_start();
            $_SESSION['error'] = $error->getMessage();
            header("Location: ../../views/" . $folder . "/" . $file . ".php");
            exit();
        }

        private function sanitizeUrl($url) {
            $urlParsed = parse_url($url);
            return $urlParsed;
        } 

        public function getParamsUrl($url) {
            $urlParsed = $this->sanitizeURL($url);
            $queryParams = [];
            parse_str($urlParsed['query'], $queryParams);
            return $queryParams;
        }

        public function getActionInUrl() {
            $url = $_SERVER['REQUEST_URI'];
            $queryParams = $this->getParamsUrl($url);
            $action = $queryParams['action'];
            return $action;
        }

        public function getIdUrl() {
            $url = $_SERVER['REQUEST_URI'];
            $id = $this->getParamsUrl($url)['id'];
            return $id;
        }
    }

?>