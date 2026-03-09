@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tambah Peminjaman</h1>

    {{-- Menangani Error Validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{-- route('admin.peminjaman.store') --}}" method="POST">
                @csrf
                {{-- Add form fields here --}}
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
