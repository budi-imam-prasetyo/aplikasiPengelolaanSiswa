<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Siswa</th>
            <th>Tahun Ajaran</th>
            <th>Kelas Asal</th>
            <th>Kelas Tujuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kenaikan as $k)
            <tr>
                <td>{{ $k->id }}</td>
                <td>{{ $k->siswa->nama }}</td>
                <td>{{ $k->tahun_ajaran }}</td>
                <td>{{ $k->kelas_asal }}</td>
                <td>{{ $k->kelas_tujuan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
