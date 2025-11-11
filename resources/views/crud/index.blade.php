<!DOCTYPE html> 
<html lang="id" data-bs-theme="dark"> <head> 
    <meta charset="UTF-8"> 
    <title>Data Member | Platform VIP</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <style>
        /* [3] Menambahkan style glow yang sama */
        .card-glow {
            box-shadow: 0 0 25px rgba(255, 193, 7, 0.5); 
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Home</a></li> 
                    <li class="nav-item"><a class="nav-link active" href="{{ route('crud.index') }}">Data Member</a></li> 
                    <li class="nav-item"><a class="nav-link text-danger fw-bold" href="{{ route('logout') }}">LOGOUT</a></li> 
                </ul> 
            </div> 
        </div> 
    </nav> 
 
    <div class="container py-5"> 
        <div class="d-flex justify-content-between align-items-center mb-3"> 
            <h3 class="text-warning text-uppercase fw-bold">Manajemen Data Member</h3> 
            <a href="{{ route('crud.create') }}" class="btn btn-warning fw-bold text-dark">+ Tambah Member</a> 
        </div> 
     
        <div class="card shadow-lg border-warning rounded-4 card-glow"> 
            <div class="card-body"> 
                <table class="table table-bordered align-middle text-center"> 
                    <thead class="table-dark text-uppercase"> 
                        <tr> 
                            <th>ID</th>
                            <th>Username</th> <th>Status Member</th> <th>Avatar</th> <th>Tindakan</th> </tr> 
                    </thead> 
                    <tbody> 
                    @forelse ($data as $item) 
                        <tr> 
                            <td>{{ $item['id'] }}</td> 
                            <td>{{ $item['nama'] }}</td> 
                            <td>{{ $item['keahlian'] }}</td> 
                            <td> 
                                @if($item['foto']) 
                                    <img src="{{ asset('uploads/'.$item['foto']) }}" width="60" class="rounded-3 border border-secondary"> 
                                @endif 
                            </td> 
                            <td> 
                                <a href="{{ route('crud.edit', $item['id']) }}" class="btn btn-warning btn-sm fw-bold text-dark">Edit</a> 
                                <a href="{{ route('crud.delete', $item['id']) }}" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a> 
                            </td> 
                        </tr> 
                    @empty 
                        <tr><td colspan="5" class="text-muted">Belum ada data member.</td></tr> 
                    @endforelse 
                    </tbody> 
                </table> 
            </div> 
        </div> 
    </div> 
 
</body> 
</html>