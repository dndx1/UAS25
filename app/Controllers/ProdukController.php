<?php

namespace App\Controllers;

use App\Models\ProductModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProdukController extends BaseController
{
    protected $product;

    function __construct()
    {
        $this->product = new ProductModel();
    }

    public function index()
    {
        // Ambil data kategori dari query string
        $kategori = $this->request->getGet('kategori');

        // Jika kategori dipilih, filter dari database
        if ($kategori) {
            $product = $this->product->where('kategori', $kategori)->findAll();
        } else {
            $product = $this->product->findAll();
        }

        $data['product'] = $product;

        return view('v_produk', $data);
    }

    public function create()
    {
        $dataFoto = $this->request->getFile('foto');

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'harga' => $this->request->getPost('harga'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'jumlah' => $this->request->getPost('jumlah'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataForm['foto'] = $fileName;
            $dataFoto->move('img/', $fileName);
        }

        $this->product->insert($dataForm);

        return redirect('produk')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataProduk = $this->product->find($id);

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'harga' => $this->request->getPost('harga'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'jumlah' => $this->request->getPost('jumlah'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if ($this->request->getPost('check') == 1) {
            if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'])) {
                unlink("img/" . $dataProduk['foto']);
            }

            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->product->update($id, $dataForm);

        return redirect('produk')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->product->find($id);

        if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'])) {
            unlink("img/" . $dataProduk['foto']);
        }

        $this->product->delete($id);

        return redirect('produk')->with('success', 'Data Berhasil Dihapus');
    }

    public function download()
    {
        try {
            $product = $this->product->findAll();

            // Set options untuk Dompdf
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);
            $options->set('chroot', FCPATH); // Set root path

            $dompdf = new Dompdf($options);
            
            // Generate HTML dengan data produk
            $html = view('v_produkPDF', ['product' => $product]);
            
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            $filename = date('Y-m-d-H-i-s') . '-produk.pdf';
            
            // Set headers untuk download
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Cache-Control: private, max-age=0, must-revalidate');
            header('Pragma: public');
            
            echo $dompdf->output();
            exit;
            
        } catch (\Exception $e) {
            // Log error untuk debugging
            log_message('error', 'PDF Download Error: ' . $e->getMessage());
            
            // Redirect dengan pesan error
            return redirect()->back()->with('failed', 'Gagal mengunduh PDF: ' . $e->getMessage());
        }
    }

    public function search()
    {
        $keyword = $this->request->getGet('q');

        $produkModel = new ProductModel();
        $data['produk'] = $produkModel->like('nama', $keyword)->findAll();
        $data['keyword'] = $keyword;

        return view('search_result', $data);
    }
}