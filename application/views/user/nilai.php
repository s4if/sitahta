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

<h1 class="page-header">
    Profil Siswa
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>user/home">Beranda</a>
    </li>
    <li class="active">
        Nilai
    </li>
</ol>
<h3><em>Ulangan Harian</em></h3>
<?php $list_kelas = array('X', 'XI', 'XII');?>
<?php foreach ($list_kelas as $kelas_tabel): ?>
    <?php for ($i = 1; $i <= 2; $i++):
	$data_nilai = $siswa->getNilaiByKelas($kelas_tabel, $i);
        if (!empty($data_nilai[0])): ?>
    <h4>Kelas <?=$kelas_tabel?> Semester <?=$i?></h4>
    <div class="col-md-12 container-fluid">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>UH</td>
                        <td>Juz</td>
                        <td>Halaman</td>
                        <td>Nilai Awal</td>
                        <td>Nilai Remidi</td>
                        <td>Nilai Akhir</td>
                        <td>Tanggal</td>
                        <td>Penguji</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_nilai as $nilai): ?>
                    <tr>
                    <td>#<?=$nilai->getNo_uh();?></td>
                    <td><?=$nilai->getJuz();?></td>
                    <td><?=$nilai->getHalaman();?></td>
                    <td><?=$nilai->getNilai()?></td>
                    <td><?php echo (is_null($nilai->getNilai_remidi())) ? '-' : $nilai->getNilai_remidi();?></td>
                    <td><?=$nilai->getNilai_akhir();?></td>
                    <td><?=date('d F Y', $nilai->getTanggal()->getTimestamp());?></td>
                    <td><?=$nilai->getPenguji()->getNama();?></td>
                    <td><?=$nilai->getKeterangan()?></td>
                    </tr>
                    <?php endforeach;?>
            
            </tbody>
        </table>
    </div>
</div>
<?php endif;?>
<?php endfor;?>
<?php endforeach;?>