<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // Mendefinisikan nama tabel yg digunakan oleh model ini
    protected $primaryKey = 'user_id'; // Mendefinisikan pk dari tabel yg digunakan
}