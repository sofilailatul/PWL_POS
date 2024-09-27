@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($level)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</H5>
                    The data you are looking for was not found.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover tablesm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $level->user_id }}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>{{ $level->level->level_nama }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $level->username }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $level->nama }}</td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td></td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('user') }}" class="btn btn-sm btn-default mt2">Kembali</a>
        </div>
    </div>
@endsection