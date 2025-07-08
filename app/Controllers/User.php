<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }

        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login')->with('error', 'User not found');
        }

        $data = [
            'user' => $user,
            'title' => 'Profile'
        ];

        return view('profile', $data);
    }

    // public function update()
    // {
    //     $userId = session()->get('user_id');

    //     if (!$userId) {
    //         return redirect()->to('/login')->with('error', 'Please login first');
    //     }

    //     $currentUser = $this->userModel->find($userId);

    //     $rules = [
    //         'username' => "required|min_length[3]|max_length[255]|is_unique[user.username,id,{$userId}]",
    //         'email'    => "required|valid_email|is_unique[user.email,id,{$userId}]"
    //     ];

    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->withInput()->with('error', implode(', ', $this->validator->getErrors()));
    //     }

    //     $data = [
    //         'username'   => $this->request->getPost('username'),
    //         'email'      => $this->request->getPost('email'),
    //         'updated_at' => date('Y-m-d H:i:s')
    //     ];

    //     if ($this->userModel->update($userId, $data)) {
    //         session()->set([
    //             'username' => $data['username'],
    //             'email'    => $data['email']
    //         ]);

    //         return redirect()->to('/profile')->with('success', 'Profile updated successfully');
    //     }

    //     return redirect()->back()->withInput()->with('error', 'Failed to update profile');
    // }

    // public function changePassword()
    // {
    //     $userId = session()->get('user_id');

    //     if (!$userId) {
    //         return redirect()->to('/login')->with('error', 'Please login first');
    //     }

    //     $rules = [
    //         'current_password' => 'required',
    //         'new_password'     => 'required|min_length[8]',
    //         'confirm_password' => 'required|matches[new_password]'
    //     ];

    //     if (!$this->validate($rules)) {
    //         return redirect()->back()->with('error', 'Please check your password data: ' . implode(', ', $this->validator->getErrors()));
    //     }

    //     $user = $this->userModel->find($userId);

    //     if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
    //         return redirect()->back()->with('error', 'Current password is incorrect');
    //     }

    //     $data = [
    //         'password'    => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
    //         'updated_at'  => date('Y-m-d H:i:s')
    //     ];

    //     if ($this->userModel->update($userId, $data)) {
    //         return redirect()->to('/profile')->with('success', 'Password changed successfully');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to change password');
    //     }
    // }
}
