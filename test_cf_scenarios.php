<?php
/**
 * Test Script: Simulasi Certainty Factor untuk 3 skenario kecanduan
 * 
 * Jalankan: php artisan tinker < test_cf_scenarios.php
 * atau: php test_cf_scenarios.php (standalone simulation tanpa DB)
 * 
 * Script ini mensimulasikan algoritma CF yang sama persis dengan DiagnosisController
 * menggunakan data aturan yang baru dari seeder.
 */

echo "\n========================================================\n";
echo "  SIMULASI CERTAINTY FACTOR - TEST SKENARIO KECANDUAN\n";
echo "========================================================\n\n";

// === Data Aturan Baru (dari DatabaseSeeder.php) ===
$aturan = [
    // K01 - Ringan
    'K01' => [
        'G001' => 0.8, 'G002' => 0.8, 'G003' => 0.4,
        'G004' => 0.7, 'G005' => 0.6, 'G006' => 0.3, 'G015' => 0.7,
    ],
    // K02 - Sedang
    'K02' => [
        'G003' => 0.7, 'G004' => 0.3, 'G006' => 0.6,
        'G007' => 0.8, 'G008' => 0.7, 'G009' => 0.4,
        'G013' => 0.4, 'G015' => 0.3, 'G016' => 0.8,
        'G017' => 0.7, 'G018' => 0.3, 'G019' => 0.4,
    ],
    // K03 - Berat
    'K03' => [
        'G009' => 0.6, 'G010' => 0.8, 'G011' => 0.9,
        'G012' => 0.9, 'G013' => 0.6, 'G014' => 0.8,
        'G016' => 0.4, 'G017' => 0.4, 'G018' => 0.8,
        'G019' => 0.7, 'G020' => 0.8,
    ],
];

$nama_kecanduan = [
    'K01' => 'Kecanduan Ringan',
    'K02' => 'Kecanduan Sedang',
    'K03' => 'Kecanduan Berat',
];

// === Fungsi Certainty Factor (replika dari DiagnosisController) ===
function hitung_cf($gejala_dipilih, $aturan) {
    $hasil = [];
    
    foreach ($aturan as $kode_kecanduan => $rules) {
        $cf_kombinasi = 0;
        
        foreach ($rules as $gejala_kode => $cf_pakar) {
            $cf_user = 0;
            
            if (isset($gejala_dipilih[$gejala_kode])) {
                $g = floatval($gejala_dipilih[$gejala_kode]);
                if ($g > 0) {
                    $cf_user = $g;
                }
            }
            
            if ($cf_user > 0) {
                $cf = $cf_user * $cf_pakar;
                
                if ($cf_kombinasi == 0) {
                    $cf_kombinasi = $cf;
                } else {
                    $cf_kombinasi = $cf_kombinasi + ($cf * (1 - $cf_kombinasi));
                }
            }
        }
        
        if ($cf_kombinasi > 0) {
            $hasil[] = [
                'kode' => $kode_kecanduan,
                'cf' => $cf_kombinasi,
                'persentase' => round($cf_kombinasi * 100, 2),
            ];
        }
    }
    
    // Sort descending by CF
    usort($hasil, function($a, $b) {
        return $b['cf'] <=> $a['cf'];
    });
    
    return $hasil;
}

// === Skenario Test ===
$skenario = [
    [
        'nama' => 'TEST KECANDUAN RINGAN',
        'expected' => 'K01',
        'desc' => 'Pilih gejala awal: G001, G002, G004, G005, G015 (Yakin = 0.6)',
        'gejala' => [
            'G001' => 0.6, 'G002' => 0.6, 'G004' => 0.6,
            'G005' => 0.6, 'G015' => 0.6,
        ],
    ],
    [
        'nama' => 'TEST KECANDUAN RINGAN (Sangat Yakin)',
        'expected' => 'K01',
        'desc' => 'Pilih gejala awal: G001, G002, G005 (Sangat Yakin = 0.8)',
        'gejala' => [
            'G001' => 0.8, 'G002' => 0.8, 'G005' => 0.8,
        ],
    ],
    [
        'nama' => 'TEST KECANDUAN SEDANG',
        'expected' => 'K02',
        'desc' => 'Pilih gejala sosial/gangguan: G006, G007, G008, G016, G017 (Yakin = 0.6)',
        'gejala' => [
            'G006' => 0.6, 'G007' => 0.6, 'G008' => 0.6,
            'G016' => 0.6, 'G017' => 0.6,
        ],
    ],
    [
        'nama' => 'TEST KECANDUAN SEDANG (Sangat Yakin)',
        'expected' => 'K02',
        'desc' => 'Pilih gejala sosial/gangguan: G007, G008, G016, G017 (Sangat Yakin = 0.8)',
        'gejala' => [
            'G007' => 0.8, 'G008' => 0.8, 'G016' => 0.8, 'G017' => 0.8,
        ],
    ],
    [
        'nama' => 'TEST KECANDUAN BERAT',
        'expected' => 'K03',
        'desc' => 'Pilih gejala berat: G011, G012, G014, G018, G020 (Yakin = 0.6)',
        'gejala' => [
            'G011' => 0.6, 'G012' => 0.6, 'G014' => 0.6,
            'G018' => 0.6, 'G020' => 0.6,
        ],
    ],
    [
        'nama' => 'TEST KECANDUAN BERAT (Sangat Yakin)',
        'expected' => 'K03',
        'desc' => 'Pilih gejala berat: G010, G011, G012, G014, G020 (Sangat Yakin = 0.8)',
        'gejala' => [
            'G010' => 0.8, 'G011' => 0.8, 'G012' => 0.8,
            'G014' => 0.8, 'G020' => 0.8,
        ],
    ],
    [
        'nama' => 'TEST CAMPURAN (Ringan + sedikit Sedang)',
        'expected' => 'K01',
        'desc' => 'Dominan ringan: G001(0.8), G002(0.8), G005(0.6) + sedikit sedang: G006(0.4)',
        'gejala' => [
            'G001' => 0.8, 'G002' => 0.8, 'G005' => 0.6, 'G006' => 0.4,
        ],
    ],
    [
        'nama' => 'TEST CAMPURAN (Sedang + sedikit Berat)',
        'expected' => 'K02',
        'desc' => 'Dominan sedang: G007(0.8), G016(0.8), G017(0.6) + sedikit berat: G010(0.4)',
        'gejala' => [
            'G007' => 0.8, 'G016' => 0.8, 'G017' => 0.6, 'G010' => 0.4,
        ],
    ],
];

$passed = 0;
$failed = 0;

foreach ($skenario as $i => $s) {
    echo "---------------------------------------------------\n";
    echo "Skenario " . ($i + 1) . ": {$s['nama']}\n";
    echo "Deskripsi: {$s['desc']}\n";
    echo "Expected: {$nama_kecanduan[$s['expected']]} ({$s['expected']})\n\n";
    
    $hasil = hitung_cf($s['gejala'], $aturan);
    
    if (empty($hasil)) {
        echo "  Hasil: Tidak terdeteksi kecanduan\n";
        $failed++;
    } else {
        foreach ($hasil as $h) {
            $marker = ($h['kode'] === $hasil[0]['kode']) ? ' ← WINNER' : '';
            echo "  {$nama_kecanduan[$h['kode']]} ({$h['kode']}): CF = {$h['cf']} ({$h['persentase']}%){$marker}\n";
        }
        
        $actual = $hasil[0]['kode'];
        if ($actual === $s['expected']) {
            echo "\n  ✅ PASS - Hasil sesuai expected\n";
            $passed++;
        } else {
            echo "\n  ❌ FAIL - Expected {$s['expected']} tapi dapat {$actual}\n";
            $failed++;
        }
    }
    echo "\n";
}

echo "========================================================\n";
echo "  HASIL: {$passed} PASS / {$failed} FAIL dari " . count($skenario) . " skenario\n";
echo "========================================================\n\n";

if ($failed === 0) {
    echo "🎉 SEMUA SKENARIO BERHASIL! Sistem skrining siap digunakan.\n\n";
} else {
    echo "⚠️  Ada skenario yang gagal. Perlu review aturan CF.\n\n";
}
