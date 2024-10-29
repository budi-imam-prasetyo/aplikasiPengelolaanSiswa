<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Kenaikan</title>
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Data Kenaikan</h2>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="GET" action="{{ route('kenaikan.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="search">Cari Siswa</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari Siswa..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kelas_asal">Pilih Kelas Asal</label>
                        <select name="kelas_asal" id="kelas_asal" class="form-control">
                            <option value="">-- Pilih Kelas Asal --</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}"
                                    {{ request('kelas_asal') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Pilih Kelas Asal</label>
                        <select name="status" id="status" class="form-control">
                            <option value="" selected>Pilih Status</option>
                            <option value="naik" {{ request('status') == 'naik' ? 'selected' : '' }}>Naik Kelas
                            </option>
                            <option value="tidak_naik" {{ request('status') == 'tidak_naik' ? 'selected' : '' }}>Tidak
                                Naik Kelas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="submit"></label>
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </div>
        </form>

        <a href="{{ route('kenaikan.create') }}" class="btn btn-primary mb-3">Tambah Kenaikan</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
        <a href="{{ route('kenaikan.export', ['status' => request('status'), 'kelasAsal' => request('kelasAsal'), 'kelasTujuan' => request('kelasTujuan')]) }}"
            class="btn btn-success mb-3">Export Data Kenaikan</a>
        <form action="{{ route('kenaikan.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Upload File Excel</label>
                <input type="file" name="file" class="form-control w-25" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Import Data</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Siswa</th>
                    <th>Tahun Ajaran</th>
                    <th>Kelas Asal</th>
                    <th>Kelas Tujuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kenaikan as $k)
                    <tr>
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->id_siswa }}</td>
                        <td>{{ $k->tahun_ajaran }}</td>
                        <td>{{ $k->kelas_asal }}</td>
                        <td>{{ $k->kelas_tujuan }}</td>
                        <td>{{ $k->status }}</td>
                        <td>
                            <a href="{{ route('kenaikan.edit', $k->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('kenaikan.destroy', $k->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
