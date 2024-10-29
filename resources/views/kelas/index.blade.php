<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Kelas</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Data Kelas</h2>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
        <!-- Filter Form -->
        <form method="GET" action="{{ route('kelas.index') }}" class="mb-3">
            <div class="row mb-3">
                <div class="col-md-3 mb-2">
                    <select name="perPage" class="form-control" onchange="this.form.submit()">
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div class="col-md-6 mb-2"></div> <!-- Menyediakan ruang kosong jika dibutuhkan -->
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $k)
                    <tr>
                        <td>{{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}</td> <!-- Hitung nomor urut --></td>
                        <td>{{ $k->nama_kelas }}</td>
                        <td>{{ $k->jurusan }}</td>
                        <td>
                            <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Kustomisasi Pagination -->
        <div class="d-flex justify-content-center">
            {{ $kelas->links('vendor.pagination.default') }} <!-- Menggunakan view kustom -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
