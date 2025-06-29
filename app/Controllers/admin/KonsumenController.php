<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KonsumenModel;

class KonsumenController extends BaseController
{
    protected $konsumenModel;

    public function __construct()
    {
        $this->konsumenModel = new KonsumenModel();
    }

    public function index()
    {
   
    $db = \Config\Database::connect();
$builder = $db->table('user u');
$builder->select('u.id, u.username, u.email, u.created_at');
$builder->select('COUNT(t.id) AS total_transaksi, COALESCE(SUM(t.total_harga), 0) AS total_belanja');
$builder->join('transaction t', 'u.username = t.username', 'left');
$builder->where('u.role', 'guest');
$builder->groupBy('u.id, u.username, u.email, u.created_at');



    $query = $builder->get();
    $data['konsumen'] = $query->getResultArray();

     return view('Admin/v_konsumen', $data);
    }

    public function store()
    {
        $this->konsumenModel->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat' => $this->request->getPost('alamat'),
        ]);

        return redirect()->to(base_url('admin/konsumen'))->with('success', 'Konsumen ditambahkan.');
    }

    public function delete($id)
    {
        $this->konsumenModel->delete($id);
        return redirect()->to(base_url('admin/konsumen'))->with('success', 'Konsumen dihapus.');
    }

}
