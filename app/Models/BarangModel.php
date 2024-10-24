<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = ['kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual'];

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    public function getHargaBarang($id)
{
    $barang = BarangModel::find($id); // Ganti Barang menjadi BarangModel
    if ($barang) {
        return response()->json([
            'status' => true,
            'harga_jual' => $barang->harga_jual,
        ]);
    }
    return response()->json([
        'status' => false,
        'message' => 'Barang tidak ditemukan.',
    ]);
}

}