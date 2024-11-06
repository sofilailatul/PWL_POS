<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    protected $table = 'm_user';        // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'user_id';  //Mendefinisikan primary key dari tabel yang digunakan

    protected $fillable = ['level_id', 'profile_image', 'username', 'nama', 'password'];

    protected $hidden = ['password']; 
    protected $casts = ['password' => 'hashed'];

    public function level():BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function geRoleName(): string {
        return $this->level->level_nama;
    }
    public function hasRole($role): bool {
        return $this->level->level_kode == $role;
    }
    public function getRole() {
        return $this->level->level_kode;
    }

    public function stok(): HasMany {
        return $this->hasMany(StokModel::class, 'user_id', 'user_id');
    }
    public function penjualan(): HasMany {
        return $this->hasMany(PenjualanModel::class, 'user_id', 'user_id');
    }
}