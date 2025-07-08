<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Controller;
use Google\Client as GoogleClient;
use Google\Service\Oauth2;
use Config\Google;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->user = new UserModel();
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $rules = [
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[7]|numeric',
            ];

            if ($this->validate($rules)) {
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');

                $dataUser = $this->user->where(['username' => $username])->first();

                if ($dataUser) {
                    if (password_verify($password, $dataUser['password'])) {
                        session()->set([
                            'username'   => $dataUser['username'],
                            'role'       => $dataUser['role'],
                            'user_id'    => $dataUser['id'],
                            'email'      => $dataUser['email'],
                            'isLoggedIn' => true
                        ]);

                        if ($dataUser['role'] === 'admin') {
                            return redirect()->to(base_url('admin/laporan/global'));
                        } else {
                            return redirect()->to(base_url('/'));
                        }
                    } else {
                        session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                        return redirect()->back();
                    }
                } else {
                    session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', $this->validator->listErrors());
                return redirect()->back();
            }
        }

        return view('v_login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function googleLogin()
    {
        $google = new Google();
        $client = new GoogleClient();
        $client->setClientId($google->clientID);
        $client->setClientSecret($google->clientSecret);
        $client->setRedirectUri($google->redirectUri);
        $client->addScope("email");
        $client->addScope("profile");

        return redirect()->to($client->createAuthUrl());
    }

    public function googleCallback()
    {
        $google = new Google();
        $client = new GoogleClient();
        $client->setClientId($google->clientID);
        $client->setClientSecret($google->clientSecret);
        $client->setRedirectUri($google->redirectUri);

        if ($this->request->getGet('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($this->request->getGet('code'));

            if (isset($token['error'])) {
                return redirect()->to('/')->with('error', 'Gagal login dengan Google');
            }

            $client->setAccessToken($token['access_token']);
            $oauth = new Oauth2($client);
            $userData = $oauth->userinfo->get();

            // Cek apakah user sudah ada di database berdasarkan email
            $dataUser = $this->user->where('email', $userData->email)->first();

            if (!$dataUser) {
                // Jika user belum ada, tambahkan ke database
                $this->user->insert([
                    'username' => $userData->name ?? $userData->email,
                    'email'    => $userData->email,
                    'password' => password_hash('google_default_password', PASSWORD_DEFAULT),
                    'role'     => 'guest'
                ]);

                // Ambil ulang data user yang baru ditambahkan
                $dataUser = $this->user->where('email', $userData->email)->first();
            }

            // Simpan data user ke session
            session()->set([
                'username'   => $dataUser['username'],
                'role'       => $dataUser['role'],
                'user_id'    => $dataUser['id'],
                'email'      => $dataUser['email'],
                'picture'    => $userData->picture,
                'isLoggedIn' => true
            ]);

            return redirect()->to('/');
        }

        return redirect()->to('/');
    }
}