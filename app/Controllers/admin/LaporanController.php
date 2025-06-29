<?php

namespace App\Controllers\Admin;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Model\ProductModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Controllers\BaseController;
use App\Database\Migrations\Product;
use App\Models\ProductModel as ModelsProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
{
       public function penjualanGlobal()
    {
        $db = \Config\Database::connect();

        // Total Transaksi
        $totalTransaksi = $db->table('transaction')->countAll();

        // Total Pendapatan
        $totalPendapatan = $db->table('transaction_detail')
            ->selectSum('subtotal_harga')
            ->get()
            ->getRow()
            ->subtotal_harga ?? 0;

        // Total Produk Terjual
        $totalProduk = $db->table('transaction_detail')
            ->selectSum('jumlah')
            ->get()
            ->getRow()
            ->jumlah ?? 0;

        // Data transaksi (untuk ditampilkan di tabel bawah)
        $builder = $db->table('transaction t');
        $builder->select('t.id, t.total_harga, t.status, t.created_at, u.username');
        $builder->join('user u', 't.username = u.username', 'left');
        $builder->orderBy('t.created_at', 'DESC');
        $transaksi = $builder->get()->getResultArray();

        $data = [
            'totalTransaksi' => $totalTransaksi,
            'totalPendapatan' => $totalPendapatan,
            'totalProduk' => $totalProduk,
            'transaksi' => $transaksi
        ];

        return view('Admin/v_laporan_penjualan', $data);
    }

    public function penjualanPeriodik()
{
    $startDate = $this->request->getGet('start_date');
    $endDate = $this->request->getGet('end_date');

    $db = \Config\Database::connect();
    $builder = $db->table('transaction_detail td');
    $builder->select('p.nama AS nama_produk, SUM(td.jumlah) as total_terjual, SUM(td.subtotal_harga) as total_pendapatan');
    $builder->join('product p', 'td.product_id = p.id');
    $builder->join('transaction t', 't.id = td.transaction_id');
    
    if ($startDate && $endDate) {
        $builder->where('DATE(t.created_at) >=', $startDate);
        $builder->where('DATE(t.created_at) <=', $endDate);
    }

    $builder->groupBy('td.product_id');
    $query = $builder->get();

    $data['penjualan'] = $query->getResult();
    $data['start_date'] = $startDate;
    $data['end_date'] = $endDate;

    return view('Admin/v_penjualan_periodik', $data);
}

    public function pendapatanPeriodik()
    {
        $tanggalMulai = $this->request->getGet('tanggal_mulai');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');

        $transaksiModel = new \App\Models\TransactionModel();

        $builder = $transaksiModel->select('DATE(transaction.created_at) as tanggal, SUM(transaction_detail.subtotal_harga) as total_pendapatan')
            ->join('transaction_detail', 'transaction_detail.transaction_id = transaction.id')
            ->groupBy('DATE(transaction.created_at)');

        if ($tanggalMulai && $tanggalAkhir) {
            $builder->where('transaction.created_at >=', $tanggalMulai)
                    ->where('transaction.created_at <=', $tanggalAkhir);
        }

        $data = [
            'pendapatan' => $builder->findAll(),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_akhir' => $tanggalAkhir,
        ];

        return view('admin/v_pendapatan_periodik', $data);
    }

    public function exportPendapatanPDF()
    {
        try {
            $tanggal_mulai = $this->request->getGet('tanggal_mulai');
            $tanggal_akhir = $this->request->getGet('tanggal_akhir');

            // Validasi input
            if (!$tanggal_mulai || !$tanggal_akhir) {
                return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi.');
            }

            // Menggunakan query yang sama dengan pendapatanPeriodik() untuk konsistensi
            $transaksiModel = new \App\Models\TransactionModel();
            
            $pendapatan = $transaksiModel
                ->select('DATE(transaction.created_at) as tanggal, SUM(transaction_detail.subtotal_harga) as total_pendapatan')
                ->join('transaction_detail', 'transaction_detail.transaction_id = transaction.id')
                ->where('transaction.created_at >=', $tanggal_mulai . ' 00:00:00')
                ->where('transaction.created_at <=', $tanggal_akhir . ' 23:59:59')
                ->groupBy('DATE(transaction.created_at)')
                ->orderBy('tanggal', 'ASC')
                ->findAll();

            $data = [
                'pendapatan' => $pendapatan,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_akhir' => $tanggal_akhir,
            ];

            // Setup DOMPDF dengan options
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $options->set('isRemoteEnabled', true);
            
            $dompdf = new Dompdf($options);
            
            // Generate HTML content
            $html = view('admin/pdf_pendapatan', $data);
            
            // Load HTML ke DOMPDF
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            // Set headers untuk download
            $this->response->setHeader('Content-Type', 'application/pdf');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="laporan_pendapatan_' . date('Y-m-d_H-i-s') . '.pdf"');
            
            // Output PDF
            return $this->response->setBody($dompdf->output());
            
        } catch (\Exception $e) {
            // Log error untuk debugging
            log_message('error', 'Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }

     public function exportPenjualanGlobalPDF()
    {
        try {
            $db = \Config\Database::connect();

            // Total Transaksi
            $totalTransaksi = $db->table('transaction')->countAll();

            // Total Pendapatan
            $totalPendapatan = $db->table('transaction_detail')
                ->selectSum('subtotal_harga')
                ->get()
                ->getRow()
                ->subtotal_harga ?? 0;

            // Total Produk Terjual
            $totalProduk = $db->table('transaction_detail')
                ->selectSum('jumlah')
                ->get()
                ->getRow()
                ->jumlah ?? 0;

            // Data transaksi
            $builder = $db->table('transaction t');
            $builder->select('t.id, t.total_harga, t.status, t.created_at, u.username');
            $builder->join('user u', 't.username = u.username', 'left');
            $builder->orderBy('t.created_at', 'DESC');
            $transaksi = $builder->get()->getResultArray();

            $data = [
                'totalTransaksi' => $totalTransaksi,
                'totalPendapatan' => $totalPendapatan,
                'totalProduk' => $totalProduk,
                'transaksi' => $transaksi
            ];

            // Setup DOMPDF
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $options->set('isRemoteEnabled', true);
            
            $dompdf = new Dompdf($options);
            
            // Generate HTML content
            $html = view('admin/pdf_penjualan_global', $data);
            
            // Load HTML ke DOMPDF
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            // Set headers untuk download
            $this->response->setHeader('Content-Type', 'application/pdf');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="laporan_penjualan_global_' . date('Y-m-d_H-i-s') . '.pdf"');
            
            // Output PDF
            return $this->response->setBody($dompdf->output());
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }

     public function exportPenjualanPeriodikPDF()
    {
        try {
            $startDate = $this->request->getGet('start_date');
            $endDate = $this->request->getGet('end_date');

            // Validasi input
            if (!$startDate || !$endDate) {
                return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi.');
            }

            $db = \Config\Database::connect();
            $builder = $db->table('transaction_detail td');
            $builder->select('p.nama AS nama_produk, SUM(td.jumlah) as total_terjual, SUM(td.subtotal_harga) as total_pendapatan');
            $builder->join('product p', 'td.product_id = p.id');
            $builder->join('transaction t', 't.id = td.transaction_id');
            $builder->where('DATE(t.created_at) >=', $startDate);
            $builder->where('DATE(t.created_at) <=', $endDate);
            $builder->groupBy('td.product_id');
            $builder->orderBy('total_terjual', 'DESC');
            
            $penjualan = $builder->get()->getResult();

            $data = [
                'penjualan' => $penjualan,
                'start_date' => $startDate,
                'end_date' => $endDate
            ];

            // Setup DOMPDF
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $options->set('isRemoteEnabled', true);
            
            $dompdf = new Dompdf($options);
            
            // Generate HTML content
            $html = view('admin/pdf_penjualan_periodik', $data);
            
            // Load HTML ke DOMPDF
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            // Set headers untuk download
            $this->response->setHeader('Content-Type', 'application/pdf');
            $this->response->setHeader('Content-Disposition', 'attachment; filename="laporan_penjualan_periodik_' . $startDate . '_' . $endDate . '.pdf"');
            
            // Output PDF
            return $this->response->setBody($dompdf->output());
            
        } catch (\Exception $e) {
            log_message('error', 'Error generating PDF: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }

}