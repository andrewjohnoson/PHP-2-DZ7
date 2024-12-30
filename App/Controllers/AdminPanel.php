<?php

namespace App\Controllers;

use App\AdminController;

class AdminPanel extends AdminController
{
    public function handle() : void
    {
        $funcs = include __DIR__ . '/../functions.php';
        $this->view->articles = \App\Models\Article::findAll();
        $this->view->cols = \App\Models\Article::getColumns();
        $this->view->ADT = new \App\AdminDataTable($this->view->articles, $funcs);

        $this->view->display(__DIR__ . '/../../templates/admin/index.php');
    }
}