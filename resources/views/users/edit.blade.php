<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Edit User Admin | Platform VIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-glow { box-shadow: 0 0 25px rgba(255, 193, 7, 0.5); }
        .btn-warning { box-shadow: 0 0 10px rgba(255, 193, 7, 0.4); }
        .invalid-feedback { display: block; color: #ff8a8a; font-size: 0.9rem; }
        .form-control.is-invalid { border-color: #ff8a8a; }
    </style>
</head>
<body class="bg-black">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-warning border-2 shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-warning" href="{{ route('dashboard') }}">PLATFORM VIP</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('crud.index') }}">Data Member</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('users.index') }}">Manajemen User</a></li>
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="{{ route('logout') }}">LOGOUT</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-warning rounded-4 card-glow">
                    <div class="card-body p-4">
                        <h4 class="mb-4 text-warning fw-bold text-uppercase">Edit User Admin: {{ $user->name }}</h4>
                        
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <!-- Value-nya pakai data $user -->
                                <input type="text" name="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text" name="username" 
                                       class="form-control @error('username') is-invalid @enderror" 
                                       value="{{ old('username', $user->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="border-warning">
                            <p class="text-white-50 small">Kosongkan password jika tidak ingin menggantinya.</p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Password Baru</label>
                                    <input type="password" name="password" 
                                           class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-warning fw-bold text-dark">UPDATE DATA</button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>