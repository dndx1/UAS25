<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KonsumenModel;
use App\Models\UserModel;

class KonsumenController extends BaseController
{
   protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        // Tampilkan hanya user dengan role 'user' atau 'guest'
        $data['konsumen'] = $this->user
            ->whereIn('role', ['user', 'guest'])
            ->findAll();
        return view('admin/v_konsumen', $data);
    }

    public function create()
    {
        return view('admin/v_konsumen_form');
    }

    public function store()
{
    $this->user->save([
        'username' => $this->request->getPost('username'),
        'email'    => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'     => 'user' // ⬅️ Tambahkan ini!
    ]);

    return redirect()->to(base_url('admin/konsumen'));
}


    public function edit($id)
    {
        $data['konsumen'] = $this->user->find($id);
        return view('admin/v_konsumen_form', $data);
    }

    public function update($id)
    {
        $data = [
            'id'       => $id,
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->user->save($data);

        return redirect()->to(base_url('admin/konsumen'));
    }

    public function delete($id)
    {
        $this->user->delete($id);
        return redirect()->to(base_url('admin/konsumen'));
    }

}
