@extends('template_backend.app')

@section('content')
    <style>
        /* --- CUSTOM MODERN STYLE UNTUK HALAMAN HASIL SKRINING --- */
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
            border-top: 4px solid #36b9cc; /* Aksen Cyan/Info untuk hasil skrining */
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
            margin: 0 2px;
        }
        .action-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-action {
            display: inline-block;
            margin: 0;
        }

        /* Styling Badge Khusus Hasil */
        .badge-hasil {
            background-color: #e3f2fd;
            color: #0288d1;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
        }
        .badge-nilai {
            background-color: #ffebee;
            color: #d32f2f;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-block;
            box-shadow: 0 2px 5px rgba(211, 47, 47, 0.1);
        }
        .badge-tanggal {
            background-color: #f8f9fc;
            color: #5a5c69;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.85rem;
            border: 1px solid #e3e6f0;
            display: inline-block;
        }
    </style>

    <section class="content-header mx-3 mt-3">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="page-header"><i class="fas fa-clipboard-check mr-2" style="color: #36b9cc;"></i> Data Hasil Skrining</h1>
                    <p class="text-muted mb-0">Riwayat dan detail hasil diagnosa kecanduan game online pengguna.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content mx-3 mb-5">
        <div class="card modern-card">
            <div class="card-body p-4">
                
                <div class="table-responsive mt-2">
                    <table class="table table-custom" id="datatable" data-ordering="false">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="20%">Nama Pasien</th>
                                <th width="25%">Hasil Skrining</th>
                                <th class="text-center" width="15%">Nilai Kepastian</th>
                                <th>Tanggal Skrining</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-weight-bold" style="color: #2c3e50;">
                                            <i class="fas fa-user-circle text-gray-400 mr-1"></i> {{ $row->nama }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-hasil">
                                            <i class="fas fa-notes-medical mr-1"></i> {{ $row->penyakit->nama_penyakit ?? 'Penyakit tidak diketahui' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-nilai">
                                            {{ $row->cf > 0 ? $row->cf . '%' : '0%' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-tanggal">
                                            <i class="far fa-clock mr-1"></i> {{ $row->created_at->format('d-m-Y H:i') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('hasil.destroy', $row->id) }}" method="POST" class="form-action">
                                            @csrf
                                            @method('DELETE')
                                            <!-- Tombol Detail -->
                                            <a href="{{ route('hasil.show', $row->id) }}" class="btn btn-info action-btn text-white" title="Lihat Detail">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                            <!-- Tombol Hapus -->
                                            <button class="btn btn-danger action-btn delete-confirm" type="submit" title="Hapus Data">
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
                event.preventDefault();
                swal({
                        title: "Konfirmasi Hapus",
                        text: "Apakah Anda yakin ingin menghapus riwayat hasil skrining ini? Data tidak dapat dikembalikan.",
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