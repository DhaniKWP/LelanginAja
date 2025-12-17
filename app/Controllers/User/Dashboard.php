<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $id_user = session()->get('id_user');

        // Ambil data user dari database
        $data['users'] = $this->userModel
            ->where('id_user', $id_user)
            ->first();

        return view('user/dashboard', $data);
    }
}
