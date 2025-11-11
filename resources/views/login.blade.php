<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login | VEGAS777</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        /* Background Gradient Mewah */
        body {
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            font-family: 'Poppins', sans-serif;
            color: #fff;
            overflow: hidden;
        }

        /* Efek Partikel/Glow Background (Opsional untuk nuansa modern) */
        body::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.15), transparent 70%);
            border-radius: 50%;
            filter: blur(60px);
            z-index: -1;
        }

        /* Kartu Login Glassmorphism */
        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 215, 0, 0.2); /* Border Emas Tipis */
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
        }

        /* Judul */
        .login-title {
            font-family: 'Orbitron', sans-serif; /* Font Futuristik */
            font-weight: 700;
            color: #FFD700; /* Warna Emas */
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
            letter-spacing: 2px;
        }

        /* Input Fields */
        .form-control {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid #444;
            color: #fff;
            border-radius: 8px;
            padding: 12px;
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            border-color: #FFD700;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        .form-label {
            color: #ccc;
            font-size: 0.9rem;
        }

        /* Tombol Login Emas */
        .btn-gold {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            border: none;
            color: #000;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(255, 165, 0, 0.4);
            transition: all 0.3s ease;
        }

        .btn-gold:hover {
            background: linear-gradient(45deg, #FFA500, #FFD700);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 165, 0, 0.6);
            color: #000;
        }

        /* Copyright */
        .copyright-text {
            color: rgba(255, 255, 255, 0.3);
            font-size: 0.8rem;
        }

        .logo-placeholder {
            font-size: 3rem;
            margin-bottom: 10px;
            filter: drop-shadow(0 0 5px #FFD700);
        }
    </style>
</head>
<body class="d-flex align-items-center" style="height:100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-lg-3">
            
            <div class="text-center mb-4">
                <div class="logo-placeholder">🎰</div> 
                <h2 class="login-title">VEGAS<span style="color: #fff;">WIN</span></h2>
            </div>

            <div class="card rounded-4">
                <div class="card-body p-4">
                    <h5 class="text-center mb-4 text-white-50">MEMBER ACCESS</h5>

                    @if(session('error'))
                        <div class="alert alert-danger border-0 bg-danger bg-opacity-25 text-danger text-center py-2 small">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Username / ID</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan ID Anda" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 py-2">LOGIN SEKARANG</button>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="copyright-text">© {{ date('Y') }} Official Gaming Platform. Aman & Terpercaya.</p>
            </div>

        </div>
    </div>
</div>

</body>
</html>