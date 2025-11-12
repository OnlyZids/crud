<!DOCTYPE html> 
<html lang="id" data-bs-theme="dark"> <head> 
    <meta charset="UTF-8"> 
    <title>Dashboard VIP | Platform Gaming</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <style>
        /* [3] Menambahkan style glow yang sama dari halaman login */
        .card-glow {
            box-shadow: 0 0 25px rgba(255, 193, 7, 0.5); /* Efek glow warna emas */
        }
        .btn-warning {
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.4);
        }
    </style>
</head> 
<body class="bg-black"> <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-warning border-2 shadow-lg"> 
        <div class="container-fluid"> 
            <a class="navbar-brand fw-bold text-warning" href="{{ route('dashboard') }}">PLATFORM VIP</a> 
            <div class="collapse navbar-collapse"> 
                <ul class="navbar-nav ms-auto"> 
                    <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}">Home</a></li> 
                    <li class="nav-item"><a class="nav-link" href="{{ route('crud.index') }}">Data Member</a></li> 
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="{{ route('logout') }}">LOGOUT</a></li> 
                </ul> 
            </div> 
        </div> 
    </nav> 
        @auth
            <div class="container py-5 text-center"> 
                <div class="card shadow-lg border-warning rounded-4 p-4 card-glow"> 
                    <h2 class="mb-3 text-uppercase">Selamat Datang,{{ auth()->user()->name }}! 🎉</h2> 
                    <p class="text-muted">Anda berhasil login ke panel kontrol VIP.</p> 
                    
                    <a href="{{ route('users.index') }}" class="btn btn-warning mt-3 fw-bold text-dark w-50 mx-auto">
                        MASUK KE DATA USER ADMIN
                    </a> 
                    <a href="{{ route('crud.index') }}" class="btn btn-warning mt-3 fw-bold text-dark w-50 mx-auto">
                        MASUK KE DATA MEMBER  VIP
                    </a> 
                </div> 
            </div> 
        @endauth
</body> 
</html>