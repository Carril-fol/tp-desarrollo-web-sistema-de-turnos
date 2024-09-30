<?php

require_once __DIR__ . '/../core/Controller.php';

class Home extends Controller
{
    public function index()
    {
        require_once __DIR__ . '/../views/core/home.php';
    }

    public function landingPage()
    {
        require_once __DIR__ . '/../views/core/landingPage.php';
    }
}

