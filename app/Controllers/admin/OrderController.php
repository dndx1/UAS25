<?php

namespace App\Controllers\Admin;


use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
  public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('transaction t');
        $builder->select('t.id, t.total_harga, t.status, t.created_at, u.username, u.email');
        $builder->join('user u', 't.username = u.username', 'left');
        $builder->orderBy('t.created_at', 'DESC');

        $query = $builder->get();
        $data['orders'] = $query->getResultArray();

        return view('Admin/v_order', $data);
    
        echo '<pre>';
print_r($data['konsumen']);
die;


    }

}
