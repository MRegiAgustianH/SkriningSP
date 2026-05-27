@extends('template.app2')

@section('content')
    <section class="department_section layout_margin-top">
        <div class="department_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <!-- <h2>
                        Hasil Diagnosa
                    </h2> -->
                </div>
            </div>
        </div>
    </section>

    <section class="about_section layout_margin-bottom layout_margin-top">
    <div class="card">
                    <h1 align="center">
                        Hasil Skrining Pengguna
                    </h1>
                    <hr>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <table class="table table-bordered mb-4">
                        <tr>
                            <td width="200">Nama Lengkap</td>
                            <td>{{ $data_diri['nama'] }}</td>
                        </tr>
                        <tr>
                            <td width="200">No HP / WhatsApp</td>
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
                    <table class="table table-bordered">
                        <tr>
                            <td width="200">Gejala yang dipilih</td>
                            <td>
                                @foreach ($gejala as $value)
                                    {{ $value }}<br>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tingkat Kecanduan</th>
                                <th>Nilai CF</th>
                                <th>Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value['nama_kecanduan'] }}</td>
                                    <td>{{ $value['cf'] > 0 ? round($value['cf'], 4) : '0' }}</td>
                                    <td>{{ $value['persentase'] > 0 ? $value['persentase'] . '%' : '0%' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <hr>

                    <table class="table table-bordered mt-4">
                        <tr>
                            <td width="200">Hasil Skrining </td>
                            <td><strong>{{ $nama_kecanduan }}</strong></td>
                        </tr>
                        <tr>
                            <td width="200">Tingkat Keyakinan </td>
                            <td><span class="badge badge-danger p-2 font-weight-bold" style="font-size: 1rem;">{{ $nilai_cf > 0 ? $nilai_cf . '%' : '0%' }}</span></td>
                        </tr>
                        <tr>
                            <td width="200">Solusi Penanganan </td>
                            <td style="white-space: pre-wrap; word-wrap: break-word;">{!! $solusi !!}</td>
                        </tr>
                    </table>

                    <div class="row mt-4">
                        <div class="col-md-8 m-auto text-center">
                            <form method="post" action="{{ route('diagnosis.pdf') }}" target="_blank">
                                @csrf
                                {!! Form::hidden('hasil', serialize($hasil)) !!}
                                {!! Form::hidden('gejala', serialize($gejala)) !!}
                                {!! Form::hidden('nama_kecanduan', $nama_kecanduan) !!}
                                {!! Form::hidden('solusi', $solusi) !!}
                                {!! Form::hidden('nilai_cf', $nilai_cf) !!}
                                {!! Form::hidden('data_diri', serialize($data_diri)) !!}

                                <a href="{{ route('diagnosis') }}" class="btn btn-success mr-2"><i class="fas fa-check"></i> Selesai</a>
                                {!! Form::button('<i class="fa fa-print"></i> Cetak Hasil Skrining', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
