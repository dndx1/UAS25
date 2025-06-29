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

    /**
     * Get order detail via AJAX
     */
    public function getDetail($id)
    {
        // Set response header untuk JSON
        $this->response->setContentType('application/json');
        
        try {
            // Validasi ID
            if (!$id || !is_numeric($id)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'ID transaksi tidak valid'
                ]);
            }

            // Menggunakan database connection seperti method detail yang sudah ada
            $db = \Config\Database::connect();

            // Get transaksi data (sesuai dengan struktur tabel transaction)
            $transaksi = $db->table('transaction')->where('id', $id)->get()->getRowArray();
            
            if (!$transaksi) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ]);
            }

            // Get detail transaksi dengan join product (sesuai dengan method detail)
            $detail = $db->table('transaction_detail td')
                ->select('td.*, p.nama, p.harga, (td.jumlah * p.harga) as subtotal_harga')
                ->join('product p', 'p.id = td.product_id')
                ->where('td.transaction_id', $id)
                ->get()->getResult();

            // Format data untuk response
            $detailArray = [];
            foreach ($detail as $item) {
                $detailArray[] = [
                    'nama_produk' => $item->nama,
                    'jumlah' => $item->quantity,
                    'harga' => $item->harga,
                    'subtotal_harga' => $item->subtotal_harga
                ];
            }

            // Format transaksi data
            $transaksiFormatted = [
                'id' => $transaksi['id'],
                'username' => $transaksi['customer_name'] ?? 'Customer', // sesuaikan field name
                'total_harga' => $transaksi['total_harga'],
                'status' => $transaksi['status'],
                'created_at' => $transaksi['created_at']
            ];

            return $this->response->setJSON([
                'success' => true,
                'transaksi' => $transaksiFormatted,
                'detail' => $detailArray
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error in getDetail: ' . $e->getMessage());
            
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ]);
        }
    }}
