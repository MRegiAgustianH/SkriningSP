<?php
$gejalas = App\Models\Gejala::whereIn('kode_gejala', ['G001', 'G002', 'G003', 'G004', 'G005'])->get();
foreach($gejalas as $g) {
    $g->animasi = 'public/animasi/' . $g->kode_gejala . '.mp4';
    $g->save();
}
echo "Done updating DB.\n";
