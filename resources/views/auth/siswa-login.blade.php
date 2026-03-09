@extends('layouts.guest')

@section('title', 'Login Siswa - SMK Teknologi Nusantara')

@section('content')
<div class="w-full max-w-md bg-white shadow-xl rounded-xl p-8">

    <!-- Title -->
    <div class="text-center mb-6">
        <div class="mx-auto w-14 h-14 rounded-lg bg-green-600 flex items-center justify-center">
            <i class="fa-solid fa-user-graduate text-white text-xl"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mt-3">Login Siswa</h2>
        <p class="text-gray-500 text-sm">Masuk ke portal siswa</p>
    </div>

    {{-- Blok notifikasi error lama telah dihapus, sekarang ditangani oleh SweetAlert di layout --}}

    <!-- Form Login -->
    <form method="POST" action="{{ route('auth.siswa.login.submit') }}" class="space-y-4">
        @csrf

        <div>
            <label class="text-sm font-semibold text-gray-700">NIS</label>
            <input type="text" name="nis" value="{{ old('nis') }}" required
                   class="w-full mt-1 px-3 py-2 border rounded-lg 
                          focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                   placeholder="Masukkan NIS">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Password</label>
            <div class="relative">
                <input type="password" name="password" id="password" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg 
                              focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                       placeholder="Masukkan password">
                <button type="button" onclick="togglePassword()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                    <i class="fa-solid fa-eye" id="toggleIcon"></i>
                </button>
            </div>
        </div>

        <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
            Masuk
        </button>
    </form>

    <div class="text-center mt-4 flex justify-center space-x-4">
        <a href="{{ route('auth.admin.login') }}" class="text-green-600 text-sm font-semibold hover:underline">
            Login Admin
        </a>
        <a href="{{ route('auth.guru.login') }}" class="text-green-600 text-sm font-semibold hover:underline">
            Login Guru
        </a>
    </div>

</div>

<script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (!input) return;
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endsection
