@php
    $gejala = unserialize($gejala);
    $hasil = unserialize($hasil);
    $data_diri = unserialize($data_diri);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Hasil Diagnosa</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 14px;
        }

        th {
            height: 20px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
            vertical-align: top;
        }

        th,
        td {
            padding: 3px;
        }

        thead {
            background: lightgray;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .table-no-border {
            table-layout: fixed;
        }

        .table-no-border,
        .table-no-border th,
        .table-no-border td {
            border: none;
        }

        .mt-1 {
            margin-top: 20px;
        }

        .mt-2 {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <h3 class="center">HASIL DIAGNOSA</h3>
    <table>
        <tr>
            <td width="120">Nama Lengkap</td>
            <td>{{ $data_diri['nama'] }}</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>{{ $data_diri['no_hp'] }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>{{ $data_diri['jenis_kelamin'] }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{{ $data_diri['alamat'] }}</td>
        </tr>
    </table>
    <table class="mt-1">
        <tr>
            <td width="120">Gejala yang dipilih</td>
            <td>
                @foreach ($gejala as $value)
                    {{ $value }}<br>
                @endforeach
            </td>
        </tr>
    </table>
    <table class="mt-1">
        <thead>
            <tr>
                <th>No</th>
                <th>Penyakit</th>
                <th>Nilai</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil as $key => $value)
                <tr>
                    <td class="center">{{ $key + 1 }}</td>
                    <td>{{ $value['nama_penyakit'] }}</td>
                    <td class="center">{{ $value['cf'] > 0 ? $value['cf'] : '' }}</td>
                    <td class="center">{{ $value['persentase'] > 0 ? $value['persentase'] . '%' : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <table class="mt-1">
        <tr>
            <td width="120">Hasil Diagnosa </td>
            <td>{{ $nama_penyakit }}</td>
        </tr>
        <tr>
            <td width="120">Tingkat Keyakinan </td>
            <td>{{ $nilai_cf > 0 ? $nilai_cf . '%' : '' }}</td>
        </tr>
        <tr>
            <td width="120">Solusi Penanganan </td>
            <td>{!! $solusi !!}</td>
        </tr>
    </table>
</body>

</html>
