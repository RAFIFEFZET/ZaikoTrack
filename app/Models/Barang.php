<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable =[
        'nama_barang',
        'merek',
        'stok_barang',
        'id_jenis_barang',
    ];

    // Penambahan Eager Load Untuk API Untuk Menghindari N+1
    protected $with = ['jenisbarang'];

    public function jenisbarang(){
        return $this->belongsTo(JenisBarang::class, 'id_jenis_barang', 'id_jenis_barang' );
    }

    public function detailPembelian() {
        return $this->belongsTo(DetailPembelian::class, 'id_detail_pembelian', 'id_detail_pembelian');
    }
    

    public function inventaris(){
        return $this->hasMany(Inventaris::class, 'id_barang', 'id_barang' );
    }
}