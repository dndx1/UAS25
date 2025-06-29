<?php

namespace App\Controllers\Admin;
use App\Models\OrderModel;

use App\Controllers\BaseController;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
    protected $transaction;

    public function __construct()
    {
        $this->transaction = new TransactionModel();
    }

    public function index()
{
    $data['orders'] = $this->transaction->findAll();
    $data['statusLabel'] = ['Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
    
    return view('admin/v_order', $data); // <--- PENTING!
}
    public function update_status($id)
    {
        $newStatus = $this->request->getPost('status');

        if ($newStatus !== null) {
            $this->transaction->update($id, [
                'status' => $newStatus,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

            return redirect()->back()->with('message', 'Status berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui status.');
    }

     public function diterima($id)
    {
        // Update status ke "1" = Sudah Diterima
        $this->transaction->update($id, [
            'status' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('message', 'Status pesanan berhasil diperbarui.');
    }

}
