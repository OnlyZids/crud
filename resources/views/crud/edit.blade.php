<!DOCTYPE html> 
<html lang="id" data-bs-theme="dark"> <head> 
    <meta charset="UTF-8"> 
    <title>Edit Member | Platform VIP</title> <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
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
        <div class="row justify-content-center"> <div class="col-md-8">
                <div class="card shadow-lg border-warning rounded-4 card-glow"> 
                    <div class="card-body p-4"> 
                        <h4 class="mb-4 text-warning fw-bold text-uppercase">Edit Data Member</h4> 
                        
                        <form action="{{ route('crud.update', $item['id']) }}" method="POST" enctype="multipart/form-data"> 
                            @csrf 
                            <div class="mb-3"> 
                                <label class="form-label fw-semibold">Username</label> 
                                <input type="text" name="nama" class="form-control" value="{{ $item['nama'] }}" required> 
                            </div> 
                            <div class="mb-3"> 
                                <label class="form-label fw-semibold">Status Member</label> 
                                <input type="text" name="keahlian" class="form-control" value="{{ $item['keahlian'] }}" required> 
                            </div> 
                            <div class="mb-3"> 
                                <label class="form-label fw-semibold">Upload Avatar Baru (Opsional)</label> 
                                <input type="file" name="foto" class="form-control"> 
                                
                                @if($item['foto']) 
                                <div class="mt-3"> 
                                    <label class="form-label d-block small text-muted">Avatar Saat Ini:</label>
                                    <img src="{{ asset('uploads/'.$item['foto']) }}" width="100" class="rounded-3 shadow-sm border border-secondary"> 
                                </div> 
                                @endif 
                            </div> 
                            
                            <button type="submit" class="btn btn-warning fw-bold text-dark">UPDATE DATA</button> 
                            <a href="{{ route('crud.index') }}" class="btn btn-outline-secondary">Kembali</a> 
                        </form> 
                    </div> 
                </div> 
            </div>
        </div>
    </div> 
</body> 
</html>