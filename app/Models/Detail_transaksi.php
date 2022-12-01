<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_transaksi extends Model
{

    use HasFactory;
    protected $table = "tb_detailtransaksi";
    protected $guarded = [];

    static function tambah_detail_transaksi($name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $grandtotal, $tempat_id, $kategori, $type_bayar, $status, $count)
    {
        Detail_transaksi::create([
            "name" => $name,
            "user_id" => $user_id,
            "durasi" => $durasi,
            "tanggal_a" => $tanggal_a,
            "tanggal_b" => $tanggal_b,
            "kode_tiket" => $kode_tiket,
            "id_produk" => $id_produk,
            "jumlah" => $jumlah,
            "count" => $count,
            "harga" => $grandtotal,
            "type_bayar" => $type_bayar,
            "type_bayar" => $type_bayar,
            "tempat_id" => $tempat_id,
            "status" => $status,
            "kategori" => $kategori,
        ]);
    }
    static function tambah_detail_transaksi_kuliner($catatan, $name, $durasi, $user_id, $tanggal_a, $tanggal_b, $kode_tiket, $id_produk, $jumlah, $grandtotal, $tempat_id, $kategori, $type_bayar)
    {
        Detail_transaksi::create([
            "name" => $name,
            "user_id" => $user_id,
            "durasi" => $durasi,
            "tanggal_a" => $tanggal_a,
            "tanggal_b" => $tanggal_b,
            "kode_tiket" => $kode_tiket,
            "id_produk" => $id_produk,
            "jumlah" => $jumlah,
            // "count" => $count,
            "catatan" => $catatan,
            "harga" => $grandtotal,
            "type_bayar" => $type_bayar,
            "tempat_id" => $tempat_id,
            // "status" => $status,
            "kategori" => $kategori,
        ]);
    }
    public function usera()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function customer()
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }
    public function desa()
    {
        return $this->belongsTo(Tempat::class, 'tempat_id');
    }
    public function ruang()
    {
        return $this->belongsTo(Ruang::class, 'id_produk');
    }
    public function reviewkuliner()
    {
        return $this->hasOne(ReviewKuliner::class, 'rating_id');
    }
}
