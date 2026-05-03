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

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Gejala Yang diderita Pasien</th>
                                    <th>Kode Gejala</th>
                                    <th width="300">Bobot Nilai Tingkat keparahan Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejala as $row)
                                    <tr>
                                        
                                        <td>{{ $row->nama_gejala }}</td>
                                        <td>{{ $row->kode_gejala }}</td>
                                        <td>
                                            <select class="form-control" name="gejala[{{ $row->id }}]" id="gejala_{{ $row->id }}">
                                                <option value="0" {{ old('gejala.' . $row->id) == '0' ? 'selected' : '' }}></option>
                                                <option value="1" {{ old('gejala.' . $row->id) == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ old('gejala.' . $row->id) == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ old('gejala.' . $row->id) == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ old('gejala.' . $row->id) == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ old('gejala.' . $row->id) == '5' ? 'selected' : '' }}>5</option>
                                                <option value="6" {{ old('gejala.' . $row->id) == '6' ? 'selected' : '' }}>6</option>
                                                <option value="7" {{ old('gejala.' . $row->id) == '7' ? 'selected' : '' }}>7</option>
                                                <option value="8" {{ old('gejala.' . $row->id) == '8' ? 'selected' : '' }}>8</option>
                                                <option value="9" {{ old('gejala.' . $row->id) == '9' ? 'selected' : '' }}>9</option>
                                                <option value="10" {{ old('gejala.' . $row->id) == '10' ? 'selected' : '' }}>10</option>
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
