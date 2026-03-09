<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $code ?? 500 }} - {{ $title ?? 'Terjadi Kesalahan' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white shadow-2xl rounded-2xl p-8 md:p-12 max-w-lg w-full text-center border-t-8 border-red-500">

        <!-- Icon -->
        <div class="text-red-500 text-6xl mb-4">
            @if(isset($code) && $code == 404)
                <i class="fas fa-search"></i>
            @else
                <i class="fas fa-exclamation-triangle"></i>
            @endif
        </div>

        <!-- Error Code -->
        <h1 class="text-6xl font-extrabold text-gray-800 mb-2">
            {{ $code ?? 'Error' }}
        </h1>

        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-700 mb-4">
            {{ $title ?? 'Oops! Terjadi Kesalahan.' }}
        </h2>

        <!-- Message -->
        <p class="text-lg text-gray-600 mb-6">
            {{ $message ?? 'Kami sedang mengalami masalah teknis. Silakan coba lagi nanti.' }}
        </p>

        <!-- Contact Admin Message -->
        <p class="text-sm text-gray-500 mb-8">
            Jika kendala masih berlanjut, silakan hubungi administrator.
        </p>

        <!-- Action Buttons -->
        <div class="flex justify-center gap-4">
            <button onclick="window.history.back()"
                    class="bg-gray-600 text-white py-3 px-6 rounded-lg hover:bg-gray-700 transition font-bold">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </button>
            <a href="{{ url('/') }}"
               class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition font-bold">
                <i class="fas fa-home mr-2"></i> Ke Beranda
            </a>
        </div>

        <!-- Copyright -->
        <p class="text-xs text-gray-400 mt-8">
            © {{ date('Y') }} {{ config('app.name') }}
        </p>

    </div>

</body>
</html>
