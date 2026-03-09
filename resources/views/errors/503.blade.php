<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Sedang Dalam Perbaikan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center font-sans">

    <div class="bg-white shadow-2xl rounded-2xl p-8 md:p-12 max-w-lg w-full text-center border-t-8 border-yellow-500">

        <!-- Maintenance Icon -->
        <div class="text-yellow-500 text-6xl mb-4">
            <i class="fas fa-tools"></i>
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-extrabold text-gray-800 mb-2">
            Sistem Sedang Dalam Perbaikan
        </h1>

        <!-- Message -->
        <p class="text-lg text-gray-600 mb-6">
            Kami sedang melakukan beberapa pembaruan. Mohon maaf atas ketidaknyamanannya, kami akan segera kembali online.
        </p>

        <!-- Retry Message -->
        <div class="mt-8">
            <button onclick="location.reload()"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-bold">
                <i class="fas fa-redo-alt mr-2"></i> Coba Lagi Nanti
            </button>
        </div>

        <!-- Admin Notice -->
        @if(isset($exception) && property_exists($exception, 'retryAfter') && $exception->retryAfter)
            <div class="mt-6 text-sm text-gray-500">
                Situs diperkirakan akan kembali aktif dalam {{ $exception->retryAfter }} detik.
            </div>
        @endif

        <p class="text-xs text-gray-400 mt-8">
            © {{ date('Y') }} {{ config('app.name') }}
        </p>

    </div>

</body>
</html>
