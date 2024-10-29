<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Data Siswa</title>

    <style>
    table {
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 5px;
    }
    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>

</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Status</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->gender }}</td>
                <td>{{ \Carbon\Carbon::parse($s->tanggal_lahir)->format('d-m-Y') }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->no_telepon }}</td>
                <td>{{ $s->status }}</td>
                <td>{{ $s->kelas ? $s->kelas->nama_kelas : 'Tidak terdaftar' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
