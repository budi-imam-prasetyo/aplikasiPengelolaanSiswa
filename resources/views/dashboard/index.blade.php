<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard Kurikulum</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Dashboard Kurikulum</h2>
        
        <!-- Tautan Logout -->
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Jumlah Siswa</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $jumlahSiswa }}</h5>
                        <p class="card-text">Jumlah total siswa yang terdaftar.</p>
                        <a href="{{ route('siswa.index') }}" class="btn btn-light">Lihat Siswa</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Jumlah Kelas</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $jumlahKelas }}</h5>
                        <p class="card-text">Total kelas yang tersedia.</p>
                        <a href="{{ route('kelas.index') }}" class="btn btn-light">Lihat Kelas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Jumlah Kenaikan</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $jumlahKenaikan }}</h5>
                        <p class="card-text">Total kenaikan siswa.</p>
                        <a href="{{ route('kenaikan.index') }}" class="btn btn-light">Lihat Kenaikan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
