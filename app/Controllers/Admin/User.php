<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    // LIST USER
    public function index()
    {
        $data['users'] = $this->user->findAll();
        return view('admin/user/index', $data);
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin/user/create');
    }

    public function store()
    {
        $this->user->save([
            'nama'     => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => $this->request->getPost('role'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/user')->with('success','User berhasil ditambahkan!');
    }

    // EDIT
    public function edit($id)
    {
        $data['user'] = $this->user->find($id);
        return view('admin/user/edit',$data);
    }

    // UPDATE
    public function update($id)
    {
        $updateData = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
        ];

        if($this->request->getPost('password') != ''){
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->user->update($id,$updateData);
        return redirect()->to('/admin/user')->with('success','Data user berhasil diperbarui!');
    }

    // DELETE
    public function delete($id)
    {
        $this->user->delete($id);
        return redirect()->back()->with('success','User berhasil dihapus!');
    }
}
