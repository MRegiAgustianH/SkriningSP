<?php

namespace Database\Seeders;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Kecanduan;
use App\Models\Profil;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // === Roles ===
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Petugas']);

        // === Users ===
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => Role::where(['name' => 'Admin'])->first()->id,
        ]);

        // === Profil ===
        Profil::create([
            'profil' => '<p>Aplikasi Sistem Pakar Skrining Kecanduan Game Online menggunakan metode Certainty Factor adalah sebuah solusi inovatif untuk membantu pengguna dalam mendeteksi tingkat kecanduan bermain game online. Dengan teknologi Certainty Factor, aplikasi ini memberikan tingkat kepercayaan yang tinggi dalam hasil skriningnya berdasarkan data gejala yang dikumpulkan dari pengguna.</p>
            <p>Aplikasi ini hadir dengan antarmuka yang mudah digunakan, sehingga pengguna dari berbagai latar belakang dapat dengan cepat memanfaatkan layanan ini. Pengguna dapat memilih gejala yang dirasakan beserta tingkat keyakinannya, dan aplikasi akan memberikan hasil skrining berupa tingkat kecanduan serta rekomendasi penanganan yang tepat. Dengan kemampuan ini, aplikasi Sistem Pakar Skrining Kecanduan Game Online menjadi alat bantu yang sangat berharga dalam mendukung upaya deteksi dini dan pencegahan kecanduan game online.</p>',
            'foto' => 'public/files/foto.png',
        ]);

        // === Tingkat Kecanduan (menggantikan Penyakit) ===
        $k01 = Kecanduan::create([
            'kode_kecanduan' => 'K01',
            'nama_kecanduan' => 'Kecanduan Ringan',
            'deskripsi' => 'Tingkat kecanduan ringan ditandai dengan keinginan bermain game yang mulai meningkat namun belum mengganggu aktivitas sehari-hari secara signifikan.',
            'solusi' => '<p>Solusi penanganan kecanduan ringan:</p><ul><li>Batasi waktu bermain game maksimal 1-2 jam per hari</li><li>Buat jadwal aktivitas harian yang terstruktur</li><li>Cari hobi atau aktivitas alternatif yang menarik</li><li>Komunikasi terbuka dengan keluarga tentang kebiasaan bermain game</li><li>Gunakan fitur pengingat waktu bermain pada perangkat</li></ul>',
        ]);

        $k02 = Kecanduan::create([
            'kode_kecanduan' => 'K02',
            'nama_kecanduan' => 'Kecanduan Sedang',
            'deskripsi' => 'Tingkat kecanduan sedang ditandai dengan mulai mengabaikan tanggung jawab dan hubungan sosial demi bermain game online.',
            'solusi' => '<p>Solusi penanganan kecanduan sedang:</p><ul><li>Konsultasi dengan psikolog atau konselor</li><li>Terapkan jadwal bermain game yang ketat dengan pengawasan</li><li>Ikuti kegiatan sosial dan komunitas di luar game</li><li>Hindari bermain game di malam hari untuk menjaga pola tidur</li><li>Minta dukungan keluarga dan teman untuk mengontrol waktu bermain</li><li>Pertimbangkan untuk mengikuti terapi kognitif-perilaku (CBT)</li></ul>',
        ]);

        $k03 = Kecanduan::create([
            'kode_kecanduan' => 'K03',
            'nama_kecanduan' => 'Kecanduan Berat',
            'deskripsi' => 'Tingkat kecanduan berat ditandai dengan ketergantungan tinggi terhadap game online, disertai gangguan emosional dan mengabaikan kehidupan nyata.',
            'solusi' => '<p>Solusi penanganan kecanduan berat:</p><ul><li>Segera konsultasi dengan psikolog atau psikiater profesional</li><li>Pertimbangkan program rehabilitasi kecanduan</li><li>Terapi kognitif-perilaku (CBT) secara intensif</li><li>Dukungan penuh dari keluarga dalam proses pemulihan</li><li>Batasi akses terhadap perangkat game secara bertahap</li><li>Ikuti program detoks digital</li><li>Bergabung dengan kelompok dukungan (support group)</li></ul>',
        ]);

        // === Gejala ===
        $gejala = [
            ['kode_gejala' => 'G001', 'nama_gejala' => 'Keinginan bermain game setiap waktu'],
            ['kode_gejala' => 'G002', 'nama_gejala' => 'Game online dianggap mengasyikkan'],
            ['kode_gejala' => 'G003', 'nama_gejala' => 'Melakukan bohong karena bermain game online'],
            ['kode_gejala' => 'G004', 'nama_gejala' => 'Menyembunyikan bahwa pemain selalu bermain game online'],
            ['kode_gejala' => 'G005', 'nama_gejala' => 'Sangat menyukai aktivitas bermain game online'],
            ['kode_gejala' => 'G006', 'nama_gejala' => 'Menganggap game online lebih menyenangkan daripada aktivitas lain'],
            ['kode_gejala' => 'G007', 'nama_gejala' => 'Menghilang dari sosial'],
            ['kode_gejala' => 'G008', 'nama_gejala' => 'Menganggap bersosial di game online lebih penting dari bersosial di kehidupan nyata'],
            ['kode_gejala' => 'G009', 'nama_gejala' => 'Marah jika melarang untuk berhenti bermain game online'],
            ['kode_gejala' => 'G010', 'nama_gejala' => 'Cenderung menjadi defensif terhadap game online'],
            ['kode_gejala' => 'G011', 'nama_gejala' => 'Menjadi cemas jika tidak bermain game online'],
            ['kode_gejala' => 'G012', 'nama_gejala' => 'Menjadi depresi jika tidak bermain game online'],
            ['kode_gejala' => 'G013', 'nama_gejala' => 'Menjadikan game online sebagai pelarian'],
            ['kode_gejala' => 'G014', 'nama_gejala' => 'Tidak memedulikan terhadap kehidupan nyata, hanya memedulikan game online'],
            ['kode_gejala' => 'G015', 'nama_gejala' => 'Menghabiskan waktu bermain game lebih lama dari yang direncanakan'],
            ['kode_gejala' => 'G016', 'nama_gejala' => 'Mengabaikan tugas atau tanggung jawab karena bermain game'],
            ['kode_gejala' => 'G017', 'nama_gejala' => 'Mengalami gangguan pola tidur akibat bermain game'],
            ['kode_gejala' => 'G018', 'nama_gejala' => 'Tetap bermain game meskipun mengetahui dampak negatifnya'],
            ['kode_gejala' => 'G019', 'nama_gejala' => 'Mengalami penurunan prestasi akademik atau pekerjaan'],
            ['kode_gejala' => 'G020', 'nama_gejala' => 'Merasa gelisah atau tidak nyaman saat tidak dapat bermain game'],
        ];

        foreach ($gejala as $g) {
            Gejala::create($g);
        }

        // === Aturan (Rule CF Pakar) ===
        // Kecanduan Ringan (K01)
        $aturanK01 = [
            ['gejala' => 'G001', 'cf_pakar' => 0.4],
            ['gejala' => 'G002', 'cf_pakar' => 0.5],
            ['gejala' => 'G003', 'cf_pakar' => 0.6],
            ['gejala' => 'G004', 'cf_pakar' => 0.6],
            ['gejala' => 'G006', 'cf_pakar' => 0.8],
            ['gejala' => 'G015', 'cf_pakar' => 0.5],
        ];

        foreach ($aturanK01 as $a) {
            Aturan::create([
                'kecanduan_id' => $k01->id,
                'gejala_id' => Gejala::where('kode_gejala', $a['gejala'])->first()->id,
                'cf_pakar' => $a['cf_pakar'],
            ]);
        }

        // Kecanduan Sedang (K02)
        $aturanK02 = [
            ['gejala' => 'G003', 'cf_pakar' => 0.5],
            ['gejala' => 'G005', 'cf_pakar' => 0.4],
            ['gejala' => 'G006', 'cf_pakar' => 0.5],
            ['gejala' => 'G007', 'cf_pakar' => 0.5],
            ['gejala' => 'G008', 'cf_pakar' => 0.6],
            ['gejala' => 'G009', 'cf_pakar' => 0.8],
            ['gejala' => 'G016', 'cf_pakar' => 0.7],
            ['gejala' => 'G017', 'cf_pakar' => 0.8],
        ];

        foreach ($aturanK02 as $a) {
            Aturan::create([
                'kecanduan_id' => $k02->id,
                'gejala_id' => Gejala::where('kode_gejala', $a['gejala'])->first()->id,
                'cf_pakar' => $a['cf_pakar'],
            ]);
        }

        // Kecanduan Berat (K03)
        $aturanK03 = [
            ['gejala' => 'G005', 'cf_pakar' => 0.4],
            ['gejala' => 'G008', 'cf_pakar' => 0.5],
            ['gejala' => 'G009', 'cf_pakar' => 0.6],
            ['gejala' => 'G010', 'cf_pakar' => 0.8],
            ['gejala' => 'G011', 'cf_pakar' => 0.8],
            ['gejala' => 'G012', 'cf_pakar' => 0.6],
            ['gejala' => 'G013', 'cf_pakar' => 0.5],
        ];

        foreach ($aturanK03 as $a) {
            Aturan::create([
                'kecanduan_id' => $k03->id,
                'gejala_id' => Gejala::where('kode_gejala', $a['gejala'])->first()->id,
                'cf_pakar' => $a['cf_pakar'],
            ]);
        }
    }
}
