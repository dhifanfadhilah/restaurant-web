<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new MenuModel();
        $data['products'] = $model->getProducts();
        return view('lib/header', $data)
            . view('index')
            . view('lib/menu')
            . view('lib/footer');
    }
}
