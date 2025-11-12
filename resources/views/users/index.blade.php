<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User | Platform VIP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-glow {
            box-shadow: 0 0 25px rgba(255, 193, 7, 0.5); 
        }
        .btn-warning {
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.4);
        }
    </style>
</head>
<body class="bg-black">

    <!-- Navbar kamu -->
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-warning text-uppercase fw-bold">Manajemen Data User Admin</h3>
            <a href="{{ route('users.create') }}" class="btn btn-warning fw-bold text-dark">+ Tambah User</a>
        </div>
        
        <!-- Notifikasi -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow-lg border-warning rounded-4 card-glow">
            <div class="card-body">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-dark text-uppercase">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 
                          FIX 1: Ganti $user jadi $users 
                          FIX 3: Ganti $item['...'] jadi $item->...
                        -->
                        @forelse ($users as $item) 
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $item->id) }}" class="btn btn-warning btn-sm fw-bold text-dark">Edit</a>
                                    
                                    <!-- 
                                      FIX 2: Tombol Hapus WAJIB pakai form 
                                    -->
                                    <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-muted">Belum ada data user.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>