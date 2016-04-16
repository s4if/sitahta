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

$arr_kelas = explode('-', $id_kelas);
$txt_kelas = '';
if ($arr_kelas[0] == 'X'){
    $txt_kelas = $arr_kelas[0].'-'.$arr_kelas[1];
} else {
    $txt_kelas = $arr_kelas[0].'-'.$arr_kelas[1].'-'.$arr_kelas[2];
}
?>
<!DOCTYPE html>
<html>
    
<head>
    <title>Laporan Hasil Belajar Kelas <?=$id_kelas?></title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 0.8em;
            font-size-adjust: 0.5;
        }
        h1.header-print {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1em;
            font-size-adjust: 0.5;
            text-align: center;
        }
        p.xprint{
            font-size: 0.7em;
            font-weight: bold;
        }
        td.catatan {
            font-family: inherit;
            font-style: italic;
            font-size: 0.8em;
            font-size-adjust: 0.5;
        }
        table.utama {
            font-family: inherit;
            font-size: 0.75em;
            color:#333333;
            border-width: 1px;
            border-color: #000000;
            border-collapse: collapse;
        }
        table.utama thead {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #dedede;
            text-align: center;
            font-weight: bolder;
        }
        table.utama th {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #dedede;
        }
        table.utama td {
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
            background-color: #ffffff;
        }
        td.surat{
            font:inherit;
            font-style: italic;
            text-align: center;
        }
        td.tengah{
            font:inherit;
            text-align: center;
            font-weight: bold;
        }
        div.end-break {
            page-break-after: always;
        }
        div.page-content{
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <div class="page-content">
        <h1 class="header-print">LAPORAN TENGAH SEMESTER TAHSIN-TAHFIDZ</h1>
        <h1 class="header-print">SMAIT IHSANUL FIKRI MUNGKID</h1>
        <hr />
        <table style="width: 100%; border-style: none">
            <tr>
                <td style="width: 10%; text-align: left">Nama</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 48%; text-align: left"><?=$siswa->getNama()?></td>
                <td style="width: 20%; text-align: left">Semester</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 18%; text-align: left"><?=($semester == 1)?'Ganjil':'Genap'?></td>
            </tr>
            <tr>
                <td style="width: 10%; text-align: left">Kelas</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 48%; text-align: left"><?=$txt_kelas?></td>
                <td style="width: 20%; text-align: left">Tahun Ajaran</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 18%; text-align: left"><?php echo $tahun_ajaran.'-'.((int)$tahun_ajaran+1);?></td>
            </tr>
        </table>
        <table style="width: 100%" class="utama">
            <thead>
                <tr>
                    <td >No.</td>
                    <td >Aspek Penilaian</td>
                    <td >Materi</td>
                    <td >Nilai</td>
                    <td >Remidi</td>
                    <td >Akhir</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            $count = $uh_terakhir;
            $n_count = 0;
            $n_sum = 0;
            $n_uts = 0;
            $no = 1;
            for($i = 1; $i <= $count+1; $i++):
                $no_uh;
                $aspek_penilaian;
                if($i == $count+1){
                    $no_uh = 'UTS';
                    $aspek_penilaian = 'UTS';
                } elseif ($i == $count+2) {
                    $no_uh = 'UAS';
                    $aspek_penilaian = 'UAS';
                }  else {
                    $no_uh = $i;
                    $aspek_penilaian = 'Ulangah Harian '.$i;
                }
                if(is_null($siswa->getNilaiByUH($arr_kelas[0], $no_uh, $semester))):
            ?>
            <?php if($no_uh <=10) :?>
            <tr>
                <td class="tengah"><?=$no++?></td>
                <td class="tengah"><?=$aspek_penilaian;?></td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
            </tr>
            <?php endif;?>
            <?php else: 
                $nilai = $siswa->getNilaiByUH($arr_kelas[0], $no_uh, $semester);
                ?>
                <tr>
                <td class="tengah"><?=$no++?></td>
                <td class="tengah"><?=$aspek_penilaian;?></td>
                <td class="surat">
                    <?=$nilai->getMeta()->getSurat_awal()?> ayat <?=$nilai->getMeta()->getAyat_awal()?> s/d <?=$nilai->getMeta()->getSurat_akhir()?> ayat <?=$nilai->getMeta()->getAyat_akhir()?>
                </td>
                <td><?=$nilai->getNilai()?></td>
                <td><?=$nilai->getNilai_remidi()?></td>
                <td><?=$nilai->getNilai_akhir()?></td>
                <?php if ($i <= $count) :
                    $n_sum = $n_sum + $nilai->getNilai_akhir(); $n_count++;
                    elseif($i == $count+1) : $n_uts = $nilai->getNilai_akhir();
                    endif;?>
                </tr>
            <?php endif;?>
            <?php endfor;?>
            </tbody>
        </table>
        
        <p class="xprint">Catatan:</p>
        <table style="width: 100%" class="utama">
            <tr>
                <td class="catatan">
                    Tingkatkan semangat dalam menghafal Al-Qur'an!
                    Bersabar dan memaksimalkan ikhtiar adalah kuncinya.
                    Semoga Allah Limpahkan berkah dan kecintaan bersama Al Qur'an.
                </td>
            </tr>
        </table>
        
        <p class="xprint">Sertifikasi Hafalan Al Qur'an Yang Dilakukan Semester Ini:</p>
        <table style="width: 100%" class="utama">
            <thead>
                <tr>
                    <td >No</td>
                    <td >Tanggal Ujian</td>
                    <td >Juz</td>
                    <td >Nilai</td>
                    <td >Predikat</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data_sertifikat)): ?>
                <tr>
                <td >&nbsp;</td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td ></td>
                </tr>
                <?php else: ?>
                <?php 
                $sertifikat_count = 1;
                foreach ($data_sertifikat as $sertifikat): 
                    ?>
                <tr>
                    <td class="tengah"><?=$sertifikat_count;?></td>
                    <td ><?=  tgl_indo($sertifikat->getTgl_ujian()->format('Y m d'));?></td>
                <td ><?=$sertifikat->getJuz();?></td>
                <td ><?=$sertifikat->getNilai();?></td>
                <td ><?=$sertifikat->getPredikat();?></td>
                </tr>
                <?php $sertifikat_count++;
                endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
        <table style="width: 100%; border-style: none">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 40%">&nbsp;</td>
                <td style="width: 20%">&nbsp;</td>
                <?php
                $date = new DateTime($tanggal_print);
                ?>
                <td style="width: 40%; text-align: center">Mungkid, <?php echo tgl_indo($date->format('Y m d'));?></td>
            </tr>
            <tr>
                <td style="width: 40%; text-align: center">Orang Tua Siswa/Wali</td>
                <td style="width: 20%">&nbsp;</td>
                <td style="width: 40%; text-align: center">Wali Kelas</td>
            </tr>
            <tr >
                <td style="height: 60px">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 40%; text-align: center">.....................</td>
                <td style="width: 20%">&nbsp;</td>
                <td style="width: 30%; text-align: center">.....................</td>
            </tr>
        </table>
    </div>
</body>

</html>
