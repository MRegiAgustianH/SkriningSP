@extends('template.app2')

@section('content')
    <section class="department_section mb-4 layout_margin-top">
        <div class="department_container">
            <div class="container ">
                <div class="heading_container heading_center">
                    <!-- <h2>
                        Diagnosa
                    </h2>
                    <p class="text-muted"> Berikan bobot nilai pada gejala berikut ini dengan benar dan sungguh-sungguh</p> -->
                </div>
            </div>
        </div>
    </section>

    <section class="about_section layout_margin-bottom">
    <div class="card">
                    <h1 align="center">
                        Mulai Diagnosa
                    </h1>
                    <p class="text-muted" align="center"> Berikan bobot nilai pada gejala berikut ini :</p>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 m-auto">
                    <form action="{{ route('diagnosis.hasil') }}" method="post">
                        @csrf

                        <table class="table table-bordered table-striped" style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="10%">Kode</th>
                                    <th width="40%">Gejala Yang Dialami</th>
                                    <th class="text-center" width="20%">Animasi Pendukung</th>
                                    <th width="25%">Tingkat Keyakinan Anda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejala as $row)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold"><span class="badge badge-secondary p-2">{{ $row->kode_gejala }}</span></td>
                                        <td class="font-weight-600" style="vertical-align: middle;">{{ $row->nama_gejala }}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            @if ($row->animasi)
                                                <img src="{{ Storage::url($row->animasi) }}" alt="Animasi {{ $row->kode_gejala }}" style="max-height: 80px; max-width: 140px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                                            @else
                                                <div class="text-muted"><i class="fas fa-gamepad fa-2x text-gray-300"></i></div>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <select class="form-control" name="gejala[{{ $row->id }}]" id="gejala_{{ $row->id }}" style="border-radius: 8px; border: 1.5px solid #d1d3e2;">
                                                <option value="0" {{ old('gejala.' . $row->id) == '0' ? 'selected' : '' }}>-- Pilih Keyakinan --</option>
                                                <option value="0.2" {{ old('gejala.' . $row->id) == '0.2' ? 'selected' : '' }}>Kurang Yakin</option>
                                                <option value="0.4" {{ old('gejala.' . $row->id) == '0.4' ? 'selected' : '' }}>Cukup Yakin</option>
                                                <option value="0.6" {{ old('gejala.' . $row->id) == '0.6' ? 'selected' : '' }}>Yakin</option>
                                                <option value="0.8" {{ old('gejala.' . $row->id) == '0.8' ? 'selected' : '' }}>Sangat Yakin</option>
                                                <option value="1.0" {{ old('gejala.' . $row->id) == '1.0' ? 'selected' : '' }}>Sangat Yakin Sekali / Pasti</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <div class="row justify-content-center mb-5">
                            <div class="col-md-4">
                                <button type="submit" name="btn_proses" class="btn btn-lg btn-block btn-primary"><i class="fa fa-arrow>"></i> Proses Gejala</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalinformasi" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Gejala harus dipilih minimal 2</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('form').submit(function() {
                var count = 0;
                $('select').each(function() {
                    if ($(this).val() != 0) {
                        count++;
                    }
                });

                if (count < 2) {
                    $('#modalinformasi').modal('show');
                    return false;
                }
            });
        });
    </script>
@endsection
