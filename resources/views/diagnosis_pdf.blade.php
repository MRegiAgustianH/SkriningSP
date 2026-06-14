@php
    $gejala = unserialize($gejala);
    $hasil_cf = unserialize($hasil);
    $data_diri = unserialize($data_diri);
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Hasil Skrining</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            line-height: 1.5;
            color: #000;
            margin: 0;
            padding: 10px 20px;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat h2 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }
        .kop-surat p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .judul-surat {
            text-align: center;
            margin-bottom: 30px;
        }
        .judul-surat h3 {
            margin: 0;
            font-size: 16px;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-info td {
            padding: 4px 0;
            vertical-align: top;
        }
        .table-info td:first-child {
            width: 180px;
        }
        .table-info td:nth-child(2) {
            width: 10px;
        }
        
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table-data th, .table-data td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        .table-data th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .text-center { text-align: center; }
        
        .signature {
            margin-top: 40px;
            width: 300px;
            float: right;
            text-align: center;
        }
        .signature .name {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .hasil-box {
            border: 2px solid #000;
            padding: 15px;
            margin-top: 20px;
            background-color: #fcfcfc;
        }
        .hasil-box h4 {
            margin-top: 0;
            text-align: center;
            font-size: 16px;
        }
        ul {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <h2>SISTEM PAKAR SKRINING KECANDUAN GAME ONLINE</h2>
        <p>Pusat Layanan Psikologi & Konseling<br>
        Email: info@skrining-game.com | Telp: (021) 1234567</p>
    </div>

    <div class="judul-surat">
        <h3>SURAT KETERANGAN HASIL SKRINING</h3>
    </div>

    <p>Berdasarkan hasil skrining yang telah dilakukan, berikut adalah rincian data pengguna:</p>

    <table class="table-info">
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $data_diri['nama'] }}</td>
        </tr>
        <tr>
            <td>No. HP / WhatsApp</td>
            <td>:</td>
            <td>{{ $data_diri['no_hp'] }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $data_diri['jenis_kelamin'] }}</td>
        </tr>
        <tr>
            <td>Alamat Lengkap</td>
            <td>:</td>
            <td>{{ $data_diri['alamat'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Skrining</td>
            <td>:</td>
            <td>{{ date('d-m-Y H:i') }}</td>
        </tr>
    </table>

    <div class="section-title">A. Gejala Yang Dialami</div>
    <ul>
        @foreach ($gejala as $value)
            <li>{{ $value }}</li>
        @endforeach
    </ul>

    <div class="section-title">B. Rincian Perhitungan Certainty Factor</div>
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="45%">Tingkat Kecanduan</th>
                <th width="25%">Nilai Kepastian (CF)</th>
                <th width="25%">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasil_cf as $key => $value)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $value['nama_kecanduan'] }}</td>
                    <td class="text-center">{{ $value['cf'] > 0 ? round($value['cf'], 4) : '0' }}</td>
                    <td class="text-center">{{ $value['persentase'] > 0 ? $value['persentase'] . '%' : '0%' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="hasil-box">
        <h4>KESIMPULAN DIAGNOSA</h4>
        <table class="table-info">
            <tr>
                <td><strong>Tingkat Kecanduan</strong></td>
                <td>:</td>
                <td><strong>{{ strtoupper($nama_kecanduan) }}</strong></td>
            </tr>
            <tr>
                <td><strong>Tingkat Keyakinan (CF)</strong></td>
                <td>:</td>
                <td><strong>{{ $nilai_cf > 0 ? $nilai_cf . '%' : '0%' }}</strong></td>
            </tr>
        </table>
    </div>

    <br>

    <div class="section-title">C. Solusi dan Penanganan</div>
    <div style="text-align: justify; margin-top: 5px;">
        {!! $solusi !!}
    </div>

    <div class="clearfix">
        <div class="signature">
            <p>Dikeluarkan pada tanggal: {{ date('d F Y') }}<br>
            Sistem Pakar Skrining</p>
            
            <div class="name">Administrator</div>
        </div>
    </div>
</body>
</html>
