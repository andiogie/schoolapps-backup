      <!DOCTYPE html>
      <html lang="id">
      <head>
          <meta charset="UTF-8">
          <title>Dashboard Siswa</title>
      </head>
      <body>
      
      <h1>Selamat Datang, {{ session('siswa_nama') }}</h1>
      
      <p>Ini halaman dashboard siswa.</p>
      
      <form action="{{ route('auth.siswa.logout') }}" method="POST">
          @csrf
          <button type="submit">Logout</button>
      </form>
      
      </body>
      </html>