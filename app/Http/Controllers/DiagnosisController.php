<?php

namespace App\Http\Controllers;

use App;
use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Hasil;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index()
    {
        session()->forget(['data_diri']);

        return view('diagnosis_awal');
    }

    public function proses(Request $request)
    {
        $gejala = Gejala::all();

        $message = [
            'required' => ':attribute harus diisi',
        ];

        $validated = $request->validate([
            'nama' => 'required',
            'no_hp' => 'nullable',
            'jenis_kelamin' => 'nullable',
            'alamat' => 'nullable',
        ], $message);

        session(['data_diri' => $validated]);

        return view('diagnosis', compact('gejala'));
    }

    // hasil diagnosis
    public function hasil(Request $request)
    {
        $gejala_dipilih = $request->gejala;
        // panggil fungsi metode CF
        $hasil = $this->certainty_factor($gejala_dipilih);

        $gejala = [];
        $gejala2 = [];
        foreach ($gejala_dipilih as $id_gejala => $g) {
            $nilai = $this->fuzzy($g);
            if ($g > 0) {
                $gej = Gejala::find($id_gejala);
                $gejala[] = $gej->kode_gejala . ' - ' . $gej->nama_gejala . ' (' . $g . ')';
                $gejala2[] = $id_gejala;
            }
        }

        // nilai default penyakit tidak terdiagnosa
        $nama_penyakit = 'Penyakit tidak diketahui';
        $solusi = '';
        $nilai_cf = 0;
        $penyakit_id = null;

        // jika penyakit terdiagnosa
        if (!empty($hasil)) {
            $penyakit_id = $hasil[0]['penyakit_id'];

            $penyakit = Penyakit::find($penyakit_id);
            $nama_penyakit = $penyakit->nama_penyakit;
            $solusi = $penyakit->solusi;
            $nilai_cf = $hasil[0]['persentase'];
        }

        $data_diri = session('data_diri');
        $data_diri['gejala'] = serialize($gejala);
        $data_diri['penyakit_id'] = $penyakit_id;
        $data_diri['cf'] = $nilai_cf;

        Hasil::create($data_diri);

        return view('diagnosis_hasil', compact('hasil', 'nama_penyakit', 'solusi', 'gejala', 'nilai_cf', 'data_diri'));
    }

    // -------- metode Certainty Factor --------- START
    public function certainty_factor($gejala)
    {
        $hasil = [];
        $penyakit = Penyakit::all();

        foreach ($penyakit as $p) {
            $cf_kombinasi = 0;

            // ambil data aturan berdasarkan penyakit
            $aturan = Aturan::where('penyakit_id', $p->id)->get();
            foreach ($aturan as $a) {
                $cf_user = 0;

                foreach ($gejala as $id_gejala => $g) {
                    if ($id_gejala == $a->gejala_id) {
                        $nilai_g = $this->fuzzy($g);
                        if ($g > 0) {
                            $cf_user = $nilai_g;
                        }
                    }
                }

                if ($cf_user > 0) {
                    $cf = $cf_user * $a->cf_pakar;

                    if ($cf_kombinasi == 0) {
                        $cf_kombinasi = $cf;
                    } else {
                        $cf_kombinasi = $cf_kombinasi + ($cf * (1 - $cf_kombinasi));
                    }
                }
            }

            if ($cf_kombinasi > 0) {
                $hasil[] = [
                    'penyakit_id' => $p->id,
                    'nama_penyakit' => $p->nama_penyakit,
                    'cf' => $cf_kombinasi,
                    'persentase' => round($cf_kombinasi * 100, 2),
                ];
            }
        }

        if (!empty($hasil)) {
            $this->array_sort_by_column($hasil, 'cf');
        }

        return $hasil;
    }
    // -------- metode Certainty Factor --------- END

    // fungsi untuk menghitung nilai cf user menggunakan fuzzy
    public function fuzzy($nilai)
    {
        $ringan = $this->fungsi_keanggotaan_ringan($nilai);
        $sedang = $this->fungsi_keanggotaan_sedang($nilai);
        $berat = $this->fungsi_keanggotaan_berat($nilai);

        $cf_fuzzy = (($ringan * 0.4) + ($sedang * 0.7) + ($berat * 1.0)) / ($ringan + $sedang + $berat);

        return $cf_fuzzy;
    }

    // fungsi untuk menentukan fungsi keanggotaan fuzzy ringan
    public function fungsi_keanggotaan_ringan($x)
    {
        if ($x <= 1) {
            $m = 1;
        } elseif ($x > 1 && $x < 5) {
            $m = (5 - $x) / (5 - 1);
        } elseif ($x >= 5) {
            $m = 0;
        }

        return $m;
    }

    // fungsi untuk menentukan fungsi keanggotaan fuzzy sedang
    public function fungsi_keanggotaan_sedang($x)
    {
        if ($x <= 1 || $x >= 10) {
            $m = 0;
        } elseif ($x > 1 && $x < 5) {
            $m = ($x - 1) / (5 - 1);
        } elseif ($x >= 5 && $x <= 10) {
            $m = (10 - $x) / (10 - 5);
        }

        return $m;
    }

    // fungsi untuk menentukan fungsi keanggotaan fuzzy berat
    public function fungsi_keanggotaan_berat($x)
    {
        if ($x <= 5) {
            $m = 0;
        } elseif ($x > 5 && $x < 10) {
            $m = ($x - 5) / (10 - 5);
        } elseif ($x >= 10) {
            $m = 1;
        }

        return $m;
    }

    // fungsi untuk mengurutkan array berdasarkan kolom
    function array_sort_by_column(&$arr, $col, $dir = SORT_DESC)
    {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }

    // print out pdf
    public function pdf(Request $request)
    {
        $gejala = $request->gejala;
        $solusi = $request->solusi;
        $nama_penyakit = $request->nama_penyakit;
        $nilai_cf = $request->nilai_cf;
        $data_diri = $request->data_diri;
        $hasil = $request->hasil;

        $pdf = App::make('dompdf.wrapper');
        $html = view('diagnosis_pdf', compact('gejala', 'solusi', 'nama_penyakit', 'nilai_cf', 'data_diri', 'hasil'));
        $pdf->loadHTML($html);
        return $pdf->stream();
    }
}
