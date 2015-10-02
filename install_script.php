<?php

/* 
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require_once "bootstrap.php";

// Add Default User
$guru = new GuruEntity();
$guru->setNip('1');
$guru->setNama("admin");
$guru->setJenis_kelamin("L");
$guru->setPassword(password_hash('qwerty', PASSWORD_BCRYPT));
$guru->setKewenangan('admin');

$entityManager->persist($guru);
$entityManager->flush();

// Setting Jumlah Ulangan
$jumlah_ulangan ['X']= 20;
$jumlah_ulangan ['XI'] = 10;
$jumlah_ulangan ['XII'] = $jumlah_ulangan ['XI'];
$arr_kelas =['X','XI','XII'];

//fungsi untuk insert kurikulum
function insert_kurikulum($kelas, $semester, $no_uh, $em){
    $kurikulum = new KurikulumEntity();
    $kurikulum->setKelas($kelas);
    $kurikulum->setSemester($semester);
    $kurikulum->setNo_uh($no_uh);
    $kurikulum->generateId();
    $em->persist($kurikulum);
    $em->flush();
}

// Set Up Kurikulum
foreach ($arr_kelas as $kelas){
    for($j = 1; $j <= 2 ; $j++){
        for($i = 1; $i <= $jumlah_ulangan[$kelas];$i++){
            insert_kurikulum($kelas, $j, $i, $entityManager);
        }
        insert_kurikulum($kelas, $j, 'UTS', $entityManager);
        insert_kurikulum($kelas, $j, 'UAS', $entityManager);
    }
}

echo "Admin Default :" . $guru->getNip() . "\n";
echo "Jumlah Ulangan Kelas X :" . $jumlah_ulangan['X'] . "\n";
echo "Jumlah Ulangan Kelas XI :" . $jumlah_ulangan['XI'] . "\n";
echo "Jumlah Ulangan Kelas XII :" . $jumlah_ulangan['XII'] . "\n";
