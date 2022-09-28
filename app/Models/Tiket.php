<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = "tb_tiket";
    protected $guarded = [];

    public function cust()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function pay()
    {
        return $this->hasOne(Pay::class, 'order_id', 'kode');
    }

    public function tempat()
    {
        return $this->hasOne(Tempat::class, 'id', 'tempat_id');
    }
    public function customer()
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

    static function list_produk()
    {
        $data = Produk::all();
        return $data;
    }
    static function tambah_produk($nama_produk, $harga_satuan)
    {
        Produk::create([
            "nama_produk" => $nama_produk,
            "hharga_satuan" => $harga_satuan,
        ]);
    }
    static function detail_produk($id_produk)
    {
        $data = Produk::where("id_produk", $id_produk)->first();
        return $data;
    }
}
