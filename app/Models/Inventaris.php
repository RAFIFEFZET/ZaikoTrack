<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;
    protected $table = 'inventaris';

    protected $primaryKey = 'id_inventaris';

    protected $fillable = [
        'id_barang',
        'id_ruangan',
        'jumlah_barang',
        'kondisi_barang',
        'ket_barang',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }
    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class, 'id_ruangan', 'id_ruangan');
    }

  


    protected $guarded = ['id_inventaris'];
}