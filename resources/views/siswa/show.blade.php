<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Detail Siswa</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Detail Siswa</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Siswa</h5>
                <td><p><strong>ID</strong></td><td>: </td> {{ $siswa->id }}</p>
                <p><strong>Nama:</strong> {{ $siswa->nama }}</p>
                <p><strong>Gender:</strong> {{ $siswa->gender }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') }}</p>
                <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
                <p><strong>No Telepon:</strong> {{ $siswa->no_telepon }}</p>
                <p><strong>Tanggal Masuk:</strong> {{ $siswa->tanggal_masuk }}</p>
                <p><strong>Status:</strong> {{ $siswa->status }}</p>
                <p><strong>Kelas:</strong> {{ $siswa->kelas ? $siswa->kelas->nama_kelas : 'Tidak terdaftar' }}</p>
                
                <a href="{{ route('siswa.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
