<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory;

    public function getJWTIdentifier() {
        return $this -> getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    protected $table        = 'm_user'; //mendefinisikan nama tabel yang akan digunakan. :o
    protected $primaryKey   = 'user_id'; //mendefinisikan primary key dari tabel yang digunakan. x3

    protected $fillable     = [
        'level_id',
        'username', 
        'nama', 
        'password', 
        'created_at', 
        'updated_at', 
        'profile_picture',
        'image' //menambahkan kolom image sebagai fillable
    ];

    protected $hidden       = ['password'];
    protected $casts        = ['password' => 'hashed'];
    
    public function image():Attribute 
    {
        return Attribute::make(
            get: fn ($image) => url('/storage/posts/' . $image),
        );
    }

    public function level():BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function penjualan() 
    {
        return $this->hasMany(PenjualanModel::class, 'user_id', 'user_id');
    }

    public function getRoleName(): string {
        return $this->level->level_nama;
    }

    public function hasRole($role): bool {
        return $this->level->level_kode == $role;
    }
    public function getRole(): string {
        return $this->level->level_kode;
    }
}