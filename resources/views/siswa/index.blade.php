<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Data Siswa</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <style>
        .modal-body label {
            font-weight: bold; /* Menebalkan label untuk terlihat lebih baik */
        }
        .modal-body p {
            margin: 0; /* Menghapus margin paragraf */
        }
        .filter-btn {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Data Siswa</h2>
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa</a>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Kembali</a>
            <a href="{{ route('siswa.export', ['status' => request('status'), 'id_kelas' => request('id_kelas')]) }}" class="btn btn-success mb-3">Export Data Siswa</a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('siswa.index') }}" class="mb-3">
            <div class="row align-items-end mb-3">
                <div class="col-md-3 mb-2">
                    <select name="perPage" class="form-control" onchange="this.form.submit()">
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="status" class="form-control" onchange="this.form.submit()">
                        <option value="">Pilih Status</option>
                        <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Keluar" {{ request('status') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                        <option value="Mutasi" {{ request('status') == 'Mutasi' ? 'selected' : '' }}>Mutasi</option>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="id_kelas" class="form-control" onchange="this.form.submit()">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ request('id_kelas') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>    
            </div>
        </form>

        <!-- Pencarian Siswa -->
        <form method="GET" action="{{ route('siswa.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari Siswa..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>No Telepon</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $s)
                    <tr>
                        <td>{{ $loop->iteration + ($siswa->currentPage() - 1) * $siswa->perPage() }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{ $s->no_telepon }}</td>
                        <td>{{ \Carbon\Carbon::parse($s->tanggal_masuk)->format('d-m-Y') }}</td>
                        <td>{{ $s->status }}</td>
                        <td>{{ $s->kelas ? $s->kelas->nama_kelas : 'Tidak terdaftar' }}</td>
                        <td>
                            <a href="{{ route('siswa.show', $s->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('siswa.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('siswa.destroy', $s->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                            </form>
                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#siswaModal"
                                data-id="{{ $s->id }}" data-nama="{{ $s->nama }}" data-gender="{{ $s->gender }}"
                                data-tanggal_lahir="{{ $s->tanggal_lahir }}" data-alamat="{{ $s->alamat }}"
                                data-no_telepon="{{ $s->no_telepon }}" data-status="{{ $s->status }}"
                                data-kelas="{{ $s->kelas ? $s->kelas->nama_kelas : 'Tidak terdaftar' }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Kustomisasi Pagination -->
        <div class="d-flex justify-content-center">
            {{ $siswa->links('vendor.pagination.default') }}
        </div>
    </div>
    
    <!-- Modal untuk Detail Siswa -->
    <div class="modal fade" id="siswaModal" tabindex="-1" role="dialog" aria-labelledby="siswaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="siswaModalLabel">Detail Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>ID:</label>
                            <p id="detail-id"></p>
                        </div>
                        <div class="col-md-6">
                            <label>Nama:</label>
                            <p id="detail-nama"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Gender:</label>
                            <p id="detail-gender"></p>
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Lahir:</label>
                            <p id="detail-tanggal_lahir"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Alamat:</label>
                            <p id="detail-alamat"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>No Telepon:</label>
                            <p id="detail-no_telepon"></p>
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Masuk:</label>
                            <p id="detail-tanggal_masuk"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Status:</label>
                            <p id="detail-status"></p>
                        </div>
                        <div class="col-md-6">
                            <label>Kelas:</label>
                            <p id="detail-kelas"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Script untuk mengisi modal detail siswa
        $('#siswaModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var id = button.data('id'); // Data ID siswa
            var nama = button.data('nama'); // Data nama siswa
            var gender = button.data('gender'); // Data gender
            var tanggalLahir = button.data('tanggal_lahir');
            var alamat = button.data('alamat');
            var noTelepon = button.data('no_telepon');
            var tanggalMasuk = button.data('tanggal_masuk'); // Pastikan Anda menggunakan data ini
            var status = button.data('status');
            var kelas = button.data('kelas');

            // Mengupdate isi modal dengan data yang relevan
            var modal = $(this);
            modal.find('#detail-id').text(id);
            modal.find('#detail-nama').text(nama);
            modal.find('#detail-gender').text(gender);
            modal.find('#detail-tanggal_lahir').text(tanggalLahir);
            modal.find('#detail-alamat').text(alamat);
            modal.find('#detail-no_telepon').text(noTelepon);
            modal.find('#detail-tanggal_masuk').text(tanggalMasuk); // Mengatur detail tanggal masuk
            modal.find('#detail-status').text(status);
            modal.find('#detail-kelas').text(kelas);
        });
    </script>
</body>
</html>
