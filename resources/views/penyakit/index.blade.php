@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK HALAMAN DATA --- */
        .page-header {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 0;
        }
        .modern-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .btn-add-modern {
            background: linear-gradient(135deg, #1cc88a 0%, #13a673 100%); /* Warna hijau untuk variasi dari gejala */
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(28, 200, 138, 0.3);
            transition: all 0.3s ease;
        }
        .btn-add-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(28, 200, 138, 0.4);
            color: white;
        }
        
        /* Styling Tabel */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }
        .table-custom thead th {
            background-color: #f8f9fc;
            color: #5a5c69;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            border-bottom: 2px solid #e3e6f0;
            padding: 15px;
        }
        .table-custom tbody td {
            vertical-align: middle;
            color: #3a3b45;
            padding: 12px 15px;
            border-bottom: 1px solid #eaecf4;
        }
        .table-custom tbody tr:hover {
            background-color: #f8f9fc;
        }
        
        /* Styling Tombol Aksi */
        .action-btn {
            border-radius: 6px;
            padding: 6px 12px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .action-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-action {
            display: inline-block;
            margin: 0;
        }
        .badge-kode {
            background-color: #e6fffa; /* Hijau mint muda */
            color: #1cc88a;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .deskripsi-teks {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-6">
                    <h1 class="page-header"><i class="fas fa-book-medical text-success mr-2"></i> Data Jenis Kecanduan</h1>
                    <p class="text-muted mb-0">Kelola master data tingkat/jenis kecanduan game online.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="card modern-card">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('penyakit.create') }}" class="btn btn-add-modern">
                        <i class="fas fa-plus-circle mr-1"></i> Tambah Jenis Kecanduan
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-custom" id="datatable" data-ordering="false">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="20%">Kode Kecanduan</th>
                                <th width="25%">Jenis Kecanduan</th>
                                <th>Deskripsi</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penyakit as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><span class="badge-kode">{{ $row->kode_penyakit }}</span></td>
                                    <td class="font-weight-bold">{{ $row->nama_penyakit }}</td>
                                    <td class="deskripsi-teks">{!! Str::words(strip_tags($row->deskripsi), 8, '...') !!}</td>
                                    <td class="text-center">
                                        <form action="{{ route('penyakit.destroy', $row->id) }}" method="POST" class="form-action">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('penyakit.edit', $row->id) }}" class="btn btn-warning action-btn text-white" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger action-btn delete-confirm" type="submit" title="Hapus Data" data-name="{{ $row->nama_penyakit }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').on('click', '.delete-confirm', function(event) {
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: "Konfirmasi Hapus",
                        text: "Apakah Anda yakin ingin menghapus data tingkat kecanduan ini?",
                        icon: "warning",
                        buttons: ["Batal", "Ya, Hapus!"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            });
        });

        @if (session()->has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }
            toastr.success('{{ session('success') }}');
        @elseif (session()->has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
            }
            toastr.error('{{ session('error') }}');
        @endif
    </script>
@endsection