<?php 
namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders'; // Ganti sesuai nama tabel
    protected $primaryKey = 'id';
   protected $allowedFields = ['username', 'email', 'total_harga', 'alamat', 'ongkir', 'status', 'bukti_bayar', 'created_at', 'updated_at'];
 // Tambahkan kolom lain jika perlu
}