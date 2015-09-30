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
?>
<html>
    
<head>
    <title>Laporan Hasil Belajar Kelas <?=$id_kelas?></title>
    <style>
        .utama {
            border: thin solid black;
            border-collapse: collapse;
        }
        .isi {
            text-align: center;
            border-spacing: 1px;
            font-size: small;
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
    <?php foreach ($data_siswa as $siswa) :?>
    <div class="page-content">
        <table style="width: 100%; border-style: none">
            <tr>
                <td style="width: 10%; text-align: left">NIS</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 38%; text-align: left"><?=$siswa->getNis()?></td>
                <td style="width: 10%; text-align: left">Kelas</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 38%; text-align: left"><?=$id_kelas?></td>
            </tr>
            <tr>
                <td style="width: 10%; text-align: left">Nama</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 38%; text-align: left"><?=$siswa->getNama()?></td>
                <td style="width: 10%; text-align: left">Semester</td>
                <td style="width: 2%; text-align: left">:</td>
                <td style="width: 38%; text-align: left"><?=$semester?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table style="width: 100%" class="utama">
            <thead>
                <tr>
                    <td class="utama isi">UH</td>
                    <td class="utama isi">Juz</td>
                    <td class="utama isi">Materi</td>
                    <td class="utama isi">Nilai</td>
                    <td class="utama isi">Tanggal</td>
                    <td class="utama isi">Penguji</td>
                    <td class="utama isi">Keterangan</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            $arr_kelas = explode('-', $id_kelas);
            $count = ($arr_kelas[0] == 'X')?20:10;
            for($i = 1; $i <= $count; $i++):
                if(is_null($siswa->getNilaiByUH($arr_kelas[0], $i, $semester)[0])):
            ?>
            <tr>
                <td class="utama isi">&nbsp;</td>
                <td class="utama isi"></td>
                <td class="utama isi"></td>
                <td class="utama isi"></td>
                <td class="utama isi"></td>
                <td class="utama isi"></td>
                <td class="utama isi"></td>
            </tr>
            <?php else: 
                $nilai = $siswa->getNilaiByUH($arr_kelas[0], $i, $semester)[0];
                ?>
                <tr>
                <td class="utama isi"><?=$nilai->getNo_uh()?></td>
                <td class="utama isi"><?=$nilai->getMeta()->getJuz()?></td>
                <td class="utama isi">
                    <?=$nilai->getMeta()->getSurat_awal()?> ayat <?=$nilai->getMeta()->getAyat_awal()?> S/D <?=$nilai->getMeta()->getSurat_akhir()?> ayat <?=$nilai->getMeta()->getAyat_akhir()?>
                </td>
                <td class="utama isi"><?=$nilai->getNilai_akhir()?></td>
                <td class="utama isi"><?=date('d F Y', $nilai->getTanggal()->getTimestamp());?></td>
                <td class="utama isi"><?=$nilai->getPenguji()->getNama();?></td>
                <td class="utama isi"><?=$nilai->getKeterangan()?></td>
                </tr>
            <?php endif;?>
            <?php endfor;?>
            </tbody>
        </table>
        <table style="width: 100%; border-style: none">
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 40%">&nbsp;</td>
                <td style="width: 20%">&nbsp;</td>
                <td style="width: 40%; text-align: center">Mengetahui,</td>
            </tr>
            <tr>
                <td style="width: 40%; text-align: center">Wali Kelas</td>
                <td style="width: 20%">&nbsp;</td>
                <td style="width: 40%; text-align: center">Wali Siswa</td>
            </tr>
            <tr >
                <td style="height: 60px">&nbsp;</td>
            </tr>
            <tr>
                <td style="width: 40%; text-align: center">...................</td>
                <td style="width: 20%">&nbsp;</td>
                <td style="width: 30%; text-align: center">...................</td>
            </tr>
        </table>
    </div>
    <div class="end-break">&nbsp;</div>
    <?php endforeach;?>
</body>

</html>
