<?php

namespace App\Controllers;

use App\Controller;

class Index extends Controller
{
    protected function handle()
    {
        $this->view->articles = \App\Models\Article::findAllEach();
        $this->view->display(__DIR__ . '/../../templates/index.php');
    }
}