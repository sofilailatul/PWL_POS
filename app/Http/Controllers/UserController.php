<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        // Menambahkan data user dengan Eloquent Model
        // $data = [
        //     'username' => 'customer-1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ];
        // UserModel::insert($data); // Menambahkan data ke tabel m_user

        // $data = [
        //     'nama' => 'Pelanggan Pertama',
        // ];
        // UserModel::where('level_id', '2')->update($data); // Mengupdate data user
        
        // // mencoba mengakses model UserModel
        // $user = UserModel::all(); // Mengambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);

        // $data = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345'),
        // ];
        
        // $user = UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);

        // $user = UserModel::findOr(1, ['username', 'nama'], function () {
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        // $user = UserModel::findOrFail(1);
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // return view('user', ['data' => $user]);

        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);
        // return view('user', ['data' => $user]);

        // $user = UserModel::firstOrNew(
        //     [
        //     'username' => 'manager33',
        //     'nama' => 'Manager Tiga Tiga',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);
        // $user->save();

        // return view('user', ['data' => $user]);

        // $user = UserModel::create([
        //     'username' => 'manager55',
        //     'nama' => 'Managers55',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2,
        // ]);
        // $user->username = 'manager56';

        // $user->isDirty(); // True
        // $user->isDirty('username'); // True
        // $user->isDirty('nama'); // False
        // $user->isDirty(['nama', 'username']); //True

        // $user->isClean(); // False
        // $user->isClean('username'); // False
        // $user->isClean('nama'); // True
        // $user->isClean(['nama', 'username']); //False

        // $user->save();

        // $user->isDirty(); //False
        // $user->isClean(); //True
        // dd($user->isDirty());

        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Managers11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);
        $user->username = 'manager12';

        $user->save();

        $user->wasChanged(); // true
        $user->wasChanged('username'); // true
        $user->wasChanged(['username', 'level_id']); // true
        $user->wasChanged('nama'); // false
        dd($user->wasChanged(['nama', 'username'])); //true
    }
}