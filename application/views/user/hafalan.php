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
        Hafalan
    </li>
</ol>
<h3><em>Sertifikasi Hafalan</em></h3>
<div class="col-md-12 container-fluid">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Tanggal Ujian</td>
                    <td>Tempat Ujian</td>
                    <td>Juz</td>
                    <td>Nilai</td>
                    <td>Predikat</td>
                    <td>Keterangan</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data_sertifikat[0])): ?>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <?php else: ?>
                <?php foreach ($data_sertifikat as $sertifikat): ?>
                <tr>
                <td><?=$siswa->getNama();?></td>
                <td><?=date('d F Y', $sertifikat->getTgl_ujian()->getTimestamp());?></td>
                <td><?=$sertifikat->getTempat_ujian();?></td>
                <td><?=$sertifikat->getJuz();?></td>
                <td><?=$sertifikat->getNilai();?></td>
                <td><?=$sertifikat->getPredikat();?></td>
                <td><?=$sertifikat->getKeterangan();?></td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</div>