<?php

namespace Database\Seeders;

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
        Role::create([
            'name' => 'Admin',
        ]);

        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => Role::where(['name' => 'Admin'])->first()->id,
        ]);

        Profil::create([
            'profil' => '<p>Aplikasi sistem pakar diagnosa awal penyakit jantung menggunakan metode certainty factor dan fuzzy adalah sebuah solusi inovatif untuk membantu pengguna dalam mendeteksi dini gejala-gejala penyakit jantung dan mengenali faktor risiko yang relevan. Dengan teknologi certainty factor, aplikasi ini memberikan tingkat kepercayaan yang tinggi dalam hasil diagnosanya berdasarkan data yang dikumpulkan dari pengguna, seperti gejala yang dialami dan riwayat kesehatan. Selain itu, pemanfaatan metode fuzzy memungkinkan aplikasi untuk mengatasi ketidakpastian data dan ambiguitas, sehingga memberikan hasil diagnosa yang lebih akurat.</p>
            <p>Aplikasi ini hadir dengan antarmuka yang mudah digunakan, sehingga pengguna dari berbagai latar belakang dapat dengan cepat memanfaatkan layanan ini. Pengguna dapat menginputkan gejala yang dirasakan, dan aplikasi akan memberikan diagnosa awal serta rekomendasi tindakan medis yang tepat berdasarkan data yang diberikan. Dengan kemampuan ini, aplikasi sistem pakar diagnosa awal penyakit jantung menjadi alat bantu yang sangat berharga dalam mendukung upaya deteksi dini dan pencegahan penyakit jantung, serta meningkatkan kesadaran masyarakat akan kesehatan jantung secara menyeluruh.</p>',
            'foto' => 'public/files/foto.png',
        ]);
    }
}
