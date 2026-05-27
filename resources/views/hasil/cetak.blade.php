<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Hasil Skrining</title>

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
    <h3 class="center">HASIL SKRINING</h3>

    <table class="mb-4">
        <tr>
            <td width="150">Nama Lengkap</td>
            <td>{{ $hasil->nama }}</td>
        </tr>
        <tr>
            <td>No HP</td>
            <td>{{ $hasil->no_hp }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>{{ $hasil->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{{ $hasil->alamat }}</td>
        </tr>
        <tr>
            <td>Tanggal Skrining</td>
            <td>{{ $hasil->created_at->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    <table class="mt-1">
        <tr>
            <td width="150">Gejala yang dipilih</td>
            <td>
                @foreach (unserialize($hasil->gejala) as $value)
                    {{ $value }}<br>
                @endforeach
            </td>
        </tr>
        <tr>
            <td width="150">Hasil Skrining </td>
            <td>{{ $hasil->kecanduan->nama_kecanduan ?? 'Tidak diketahui' }}</td>
        </tr>
        <tr>
            <td width="150">Tingkat Keyakinan </td>
            <td>{{ $hasil->cf > 0 ? $hasil->cf . '%' : '0' }}</td>
        </tr>
        <tr>
            <td width="150">Solusi Penanganan </td>
            <td style="white-space: pre-wrap; word-wrap: break-word;">{!! $hasil->kecanduan->solusi ?? '' !!}</td>
        </tr>
    </table>
</body>

</html>
