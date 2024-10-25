@extends('layouts.template')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="card shadow-lg border-0 rounded-lg mb-4" style="background: linear-gradient(135deg, #f5f7fa, #c3cfe2);">
                    <div class="card-body text-center">
                        @if ($user->profile_image)
                            <img src="{{ asset('storage/photos/' . $user->profile_image) }}"
                                class="img-fluid rounded-circle shadow-lg mb-3"
                                style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #000000;">
                        @else
                            <img src="{{ asset('/public/img/polinema-bw.png') }}"
                                class="img-fluid rounded-circle shadow-lg mb-3"
                                style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #000000;">
                        @endif
                        <h5>{{ $user->nama }}</h5>
                        <p class="text-muted">{{ $user->username }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-gradient-primary text-white text-center py-3"
                        style="background: linear-gradient(to right, #6a11cb, #2575fc);">
                        <h4 class="mb-0"><b>Edit Profil<b></h4>
                    </div>
                    <div class="card-body p-5">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between rounded shadow-sm" 
                                role="alert" style="background: linear-gradient(135deg, #28a745, #34d058); padding: 15px;">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill" style="font-size: 20px; color: white; margin-right: 10px;"></i>
                                    <span class="text-white" style="font-size: 16px;">{{ session('status') }}</span>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update', $user->user_id) }}"
                            enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="username" class="form-label">{{ __('Username') }}</label>
                                    <input id="username" type="text"
                                        class="form-control shadow-sm @error('username') is-invalid @enderror"
                                        name="username" value="{{ $user->username }}" required autocomplete="username"
                                        placeholder="Enter your username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">{{ __('Nama') }}</label>
                                    <input id="nama" type="text"
                                        class="form-control shadow-sm @error('nama') is-invalid @enderror"
                                        name="nama" value="{{ old('nama', $user->nama) }}" required
                                        autocomplete="nama" placeholder="Enter your full name">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="old_password" class="form-label">{{ __('Password Lama') }}</label>
                                    <input id="old_password" type="password"
                                        class="form-control shadow-sm @error('old_password') is-invalid @enderror"
                                        name="old_password" autocomplete="old-password"
                                        placeholder="Masukkan password lama">
                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">{{ __('Password Baru') }}</label>
                                    <input id="password" type="password"
                                        class="form-control shadow-sm @error('password') is-invalid @enderror"
                                        name="password" autocomplete="new-password" placeholder="Masukkan password baru">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control shadow-sm"
                                    name="password_confirmation" autocomplete="new-password"
                                    placeholder="Konfirmasi password baru">
                            </div>
                            <div class="mb-3">
                                <label for="profile_image" class="form-label">{{ __('Ganti Foto Profil') }}</label>
                                <input id="profile_image" type="file" class="form-control shadow-sm"
                                    name="profile_image" onchange="previewImage(event)">
                                <img id="image-preview" src="#" alt="Preview Image" class="img-fluid mt-3" style="max-width: 150px; display: none;">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success shadow-sm px-3"
                                    style="background: linear-gradient(45deg, #28a745, #218838);">
                                    {{ __('Simpan Profil') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('image-preview');

            reader.onload = function() {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            };

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
