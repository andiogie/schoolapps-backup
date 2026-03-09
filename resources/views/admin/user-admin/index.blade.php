@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Management User Admin</h1>
        <a href="{{ route('admin.user-admin.create') }}" class="btn btn-primary">Tambah User Admin</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userAdmins as $userAdmin)
                    <tr>
                        <td>{{ $userAdmin->nama }}</td>
                        <td>{{ $userAdmin->email }}</td>
                        <td>{{ $userAdmin->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                        <td>
                            <a href="{{ route('admin.user-admin.edit', $userAdmin->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
