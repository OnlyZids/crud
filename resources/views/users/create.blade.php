<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Tambah User Admin | Platform VIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-glow {
            box-shadow: 0 0 25px rgba(255, 193, 7, 0.5); 
        }
        .btn-warning {
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.4);
        }
        
        /* Style untuk pesan error validasi */
        .invalid-feedback {
            display: block;
            color: #ff8a8a;
            font-size: 0.9rem;
        }
        .form-control.is-invalid {
            border-color: #ff8a8a;
        }
    </style>
</head>
<body class="bg-black">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-warning border-2 shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-warning" href="{{ route('dashboard') }}">PLATFORM VIP</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Home</a></li>
                    
                    <!-- Ini link ke CRUD Member (Biodata) -->
                    <li class="nav-item"><a class="nav-link" href="{{ route('crud.index') }}">Data Member</a></li>
                    
                    <!-- Ini link ke CRUD User (Tabel Users) -->
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
                        <h4 class="mb-4 text-warning fw-bold text-uppercase">Registrasi User Admin Baru</h4>
                        
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Username</label>
                                <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" required>
                                @if($errors->has('username'))
                                    <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Password</label>
                                    <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                    @if($errors->has('password'))
                                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-warning fw-bold text-dark">SIMPAN DATA</button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>