<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserModel;

class ProfileController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Profil',
            'list' => ['Home', 'Profile']
        ];

        $page = (object) [
            'title' => 'Data Profil Pengguna'
        ];

        $activeMenu = 'profile'; // Set the active menu

        return view('profile.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Validasi file gambar
        ]);

        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil pengguna berdasarkan ID menggunakan UserModel
        $user = UserModel::find($userId);

        // Jika ada file gambar yang diupload
        if ($request->hasFile('avatar')) {
            // Hapus foto profil lama jika ada
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            // Simpan foto profil baru
            $path = $request->file('avatar')->store('gambar', 'public');
            $user->avatar = $path;
        }

        // Simpan perubahan ke database
        $user->save();

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui');
    }
}