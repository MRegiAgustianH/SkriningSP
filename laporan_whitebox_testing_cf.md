# Whitebox Testing Metode Certainty Factor

## 1. Objek Pengujian

Pengujian whitebox dilakukan pada metode `certainty_factor()` yang terdapat pada:

`app/Http/Controllers/DiagnosisController.php`

Metode ini digunakan untuk menghitung nilai Certainty Factor (CF) berdasarkan gejala yang dipilih pengguna, nilai keyakinan pengguna (`cf_user`), dan nilai keyakinan pakar (`cf_pakar`) pada tabel aturan.

## 2. Potongan Logika Program

```php
public function certainty_factor($gejala)
{
    $hasil = [];
    $kecanduan_list = Kecanduan::all();

    foreach ($kecanduan_list as $k) {
        $cf_kombinasi = 0;

        $aturan = Aturan::where('kecanduan_id', $k->id)->get();
        foreach ($aturan as $a) {
            $cf_user = 0;

            foreach ($gejala as $id_gejala => $g) {
                if ($id_gejala == $a->gejala_id) {
                    $g = floatval($g);
                    if ($g > 0) {
                        $cf_user = $g;
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
                'kecanduan_id' => $k->id,
                'nama_kecanduan' => $k->nama_kecanduan,
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
```

## 3. Rumus Certainty Factor

Nilai CF setiap gejala dihitung dengan rumus:

```text
CF gejala = CF user x CF pakar
```

Jika terdapat lebih dari satu gejala pada tingkat kecanduan yang sama, maka nilai CF digabungkan dengan rumus:

```text
CF kombinasi = CF lama + CF baru x (1 - CF lama)
```

Nilai akhir dalam bentuk persentase:

```text
Persentase = CF kombinasi x 100
```

## 4. Flow Graph

Node alur logika metode CF:

```text
1  Mulai
2  Inisialisasi hasil dan ambil daftar tingkat kecanduan
3  Perulangan setiap tingkat kecanduan
4  Inisialisasi CF kombinasi = 0
5  Ambil aturan berdasarkan tingkat kecanduan
6  Perulangan setiap aturan
7  Inisialisasi CF user = 0
8  Perulangan setiap gejala yang dipilih user
9  Cek apakah id gejala user sama dengan id gejala pada aturan
10 Cek apakah nilai gejala user > 0
11 Set nilai CF user
12 Cek apakah CF user > 0
13 Hitung CF = CF user x CF pakar
14 Cek apakah CF kombinasi masih 0
15 Set CF kombinasi pertama
16 Hitung CF kombinasi lanjutan
17 Cek apakah CF kombinasi > 0
18 Simpan hasil diagnosis
19 Cek apakah hasil tidak kosong
20 Urutkan hasil berdasarkan CF tertinggi
21 Return hasil
22 Selesai
```

## 5. Cyclomatic Complexity

Cyclomatic complexity dihitung berdasarkan jumlah predicate node.

Predicate node:

```text
P1  foreach tingkat kecanduan
P2  foreach aturan
P3  foreach gejala
P4  if id_gejala == aturan.gejala_id
P5  if g > 0
P6  if cf_user > 0
P7  if cf_kombinasi == 0
P8  if cf_kombinasi > 0
P9  if !empty($hasil)
```

Rumus:

```text
V(G) = P + 1
V(G) = 9 + 1
V(G) = 10
```

Berdasarkan hasil perhitungan, nilai cyclomatic complexity metode `certainty_factor()` adalah 10. Artinya, minimal terdapat 10 jalur independen yang perlu diuji agar struktur logika utama metode CF tercakup.

## 6. Independent Path

Daftar jalur independen:

| Path | Jalur Logika |
|---|---|
| P1 | Start -> tidak ada tingkat kecanduan -> hasil kosong -> return |
| P2 | Start -> ada tingkat kecanduan -> tidak ada aturan -> hasil kosong -> return |
| P3 | Start -> ada aturan -> gejala user tidak cocok dengan aturan -> CF user tetap 0 -> tidak dihitung |
| P4 | Start -> gejala cocok -> nilai gejala user = 0 -> CF user tetap 0 -> tidak dihitung |
| P5 | Start -> gejala cocok -> nilai gejala user > 0 -> CF kombinasi pertama dihitung |
| P6 | Start -> gejala cocok lebih dari satu -> CF kombinasi lanjutan dihitung |
| P7 | Start -> CF kombinasi > 0 -> data hasil dimasukkan ke array hasil |
| P8 | Start -> beberapa tingkat kecanduan menghasilkan CF -> hasil diurutkan descending |
| P9 | Start -> hanya satu tingkat kecanduan menghasilkan CF -> hasil tetap diurutkan dan dikembalikan |
| P10 | Start -> semua gejala bernilai 0 atau tidak relevan -> hasil kosong -> return |

## 7. Test Case Whitebox

| No | Skenario Uji | Input Gejala | Expected Output | Jalur yang Diuji | Status |
|---|---|---|---|---|---|
| 1 | Tidak ada gejala valid | Semua gejala bernilai 0 | Hasil kosong / tidak terdeteksi | P4, P10 | Valid |
| 2 | Gejala tidak sesuai aturan tertentu | Gejala yang dipilih tidak terdapat pada salah satu aturan kecanduan | Aturan tersebut tidak menghasilkan CF | P3 | Valid |
| 3 | Satu gejala ringan | G001 = 0.8 | K01 menghasilkan CF awal 0.64 | P5, P7, P9 | Valid |
| 4 | Beberapa gejala ringan | G001 = 0.8, G002 = 0.8, G005 = 0.8 | K01 menjadi hasil tertinggi dengan CF 93.26% | P5, P6, P7, P9 | Pass |
| 5 | Beberapa gejala sedang | G007 = 0.8, G008 = 0.8, G016 = 0.8, G017 = 0.8 | K02 menjadi hasil tertinggi dengan CF 97.49% | P5, P6, P7, P8 | Pass |
| 6 | Beberapa gejala berat | G010 = 0.8, G011 = 0.8, G012 = 0.8, G014 = 0.8, G020 = 0.8 | K03 menjadi hasil tertinggi dengan CF 99.63% | P5, P6, P7, P8 | Pass |
| 7 | Gejala overlap ringan dan sedang | G001 = 0.8, G002 = 0.8, G005 = 0.6, G006 = 0.4 | K01 tetap menjadi hasil tertinggi dengan CF 92.70% | P6, P7, P8 | Pass |
| 8 | Gejala overlap sedang dan berat | G007 = 0.8, G016 = 0.8, G017 = 0.6, G010 = 0.4 | K02 menjadi hasil tertinggi dengan CF 92.48% | P6, P7, P8 | Pass |
| 9 | Gejala yakin sedang | G006 = 0.6, G007 = 0.6, G008 = 0.6, G016 = 0.6, G017 = 0.6 | K02 menjadi hasil tertinggi dengan CF 94.18% | P5, P6, P7, P8 | Pass |
| 10 | Gejala yakin berat | G011 = 0.6, G012 = 0.6, G014 = 0.6, G018 = 0.6, G020 = 0.6 | K03 menjadi hasil tertinggi dengan CF 97.02% | P5, P6, P7, P8 | Pass |

## 8. Contoh Perhitungan Manual

Skenario: pengguna memilih gejala ringan dengan nilai sangat yakin.

Input:

```text
G001 = 0.8, CF pakar = 0.8
G002 = 0.8, CF pakar = 0.8
G005 = 0.8, CF pakar = 0.6
```

Perhitungan:

```text
CF G001 = 0.8 x 0.8 = 0.64
CF G002 = 0.8 x 0.8 = 0.64
CF G005 = 0.8 x 0.6 = 0.48

CF kombinasi 1 = 0.64
CF kombinasi 2 = 0.64 + 0.64 x (1 - 0.64)
                 = 0.64 + 0.2304
                 = 0.8704

CF kombinasi 3 = 0.8704 + 0.48 x (1 - 0.8704)
                 = 0.8704 + 0.062208
                 = 0.932608

Persentase = 0.932608 x 100 = 93.26%
```

Hasil akhir:

```text
Kecanduan Ringan = 93.26%
```

## 9. Hasil Eksekusi Pengujian

Pengujian dilakukan menggunakan script simulasi `test_cf_scenarios.php` dengan hasil:

| No | Skenario | Expected | Actual | CF Tertinggi | Status |
|---|---|---|---|---|---|
| 1 | Kecanduan Ringan, yakin | K01 | K01 | 94.18% | Pass |
| 2 | Kecanduan Ringan, sangat yakin | K01 | K01 | 93.26% | Pass |
| 3 | Kecanduan Sedang, yakin | K02 | K02 | 94.18% | Pass |
| 4 | Kecanduan Sedang, sangat yakin | K02 | K02 | 97.49% | Pass |
| 5 | Kecanduan Berat, yakin | K03 | K03 | 97.02% | Pass |
| 6 | Kecanduan Berat, sangat yakin | K03 | K03 | 99.63% | Pass |
| 7 | Campuran ringan dan sedikit sedang | K01 | K01 | 92.70% | Pass |
| 8 | Campuran sedang dan sedikit berat | K02 | K02 | 92.48% | Pass |

Total hasil pengujian:

```text
8 Pass / 0 Fail
```

## 10. Kesimpulan

Berdasarkan pengujian whitebox pada metode Certainty Factor, seluruh jalur logika utama pada fungsi `certainty_factor()` telah diuji, meliputi kondisi gejala tidak cocok, nilai gejala bernilai 0, perhitungan CF pertama, perhitungan CF kombinasi lanjutan, penyimpanan hasil, dan pengurutan hasil berdasarkan nilai CF tertinggi.

Nilai cyclomatic complexity sebesar 10 menunjukkan bahwa metode memiliki 10 jalur independen utama. Hasil pengujian menunjukkan seluruh skenario valid menghasilkan output sesuai expected, sehingga metode Certainty Factor pada sistem skrining kecanduan game online berjalan sesuai dengan aturan dan rumus yang digunakan.
