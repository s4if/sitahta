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
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li>
        <a href="<?=base_url();?>siswa">Siswa</a>
    </li>
    <li class="active">
        Profil
    </li>
</ol>
<h3><em>Data Diri</em></h3>
<div class="col-md-12 container-fluid">
    <table>
        <tr>
            <td> Nama </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->nama?> </td>
        </tr>
        <tr>
            <td> NIS </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->nis?> </td>
        </tr>
        <tr>
            <td> I/A </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=($siswa->jenis_kelamin == 'L')?'Ikhwan': 'Akhwat'?> </td>
        </tr>
        <tr>
            <td> TTL </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=  ucwords($siswa->tempat_lahir) ?>, <?=  nice_date($siswa->tgl_lahir, 'd F Y') ?> </td>
        </tr>
        <?php
            $kelas = ($siswa->kelas !== 'X')?$siswa->kelas."-".$siswa->jurusan."-".$siswa->no_kelas:
                $siswa->kelas."-".$siswa->no_kelas;
        ?>
        <tr>
            <td> Kelas </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$kelas?> </td>
        </tr>
        <tr>
            <td> Nama Ortu / Wali </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->nama_ortu?> </td>
        </tr>
        <tr>
            <td> Hafalan sebelum <br> masuk sma </td>
            <td> &nbsp;:&nbsp; </td>
            <td> - </td>
        </tr>
    </table>
    &nbsp;
</div>
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
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data_sertifikasi[0])) :?>
                <tr>
                <td><?= $sertifikasi->nama;?></td>
                <td><?= nice_date($sertifikasi->tgl_ujian, 'd F Y');?></td>
                <td><?= $sertifikasi->tempat_ujian;?></td>
                <td><?= $sertifikasi->juz;?></td>
                <td><?= $sertifikasi->nilai;?></td>
                <td><?= $sertifikasi->predikat;?></td>
                <td><?= $sertifikasi->keterangan;?></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSertifikasi">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                </td>
                </tr>
                <?php else :?>
                <?php foreach ($data_sertifikasi as $sertifikasi):?>
                <tr>
                <td><?= $sertifikasi->nama;?></td>
                <td><?= nice_date($sertifikasi->tgl_ujian, 'd F Y');?></td>
                <td><?= $sertifikasi->tempat_ujian;?></td>
                <td><?= $sertifikasi->juz;?></td>
                <td><?= $sertifikasi->nilai;?></td>
                <td><?= $sertifikasi->predikat;?></td>
                <td><?= $sertifikasi->keterangan;?></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSertifikasi">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editSertifikasi<?= $sertifikasi->id;?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteSertifikasi<?=$sertifikasi->id;?>">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
                </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
<h3><em>Ulangan Harian</em></h3>
<div class="col-md-12 container-fluid">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Kelas</td>
                    <td>UH</td>
                    <td>Juz</td>
                    <td>Halaman</td>
                    <td>Nilai</td>
                    <td>Tanggal</td>
                    <td>Penguji</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($data_nilai[0])) :?>
                <tr>
                <td><?= $nilai->kelas;?></td>
                <td>#<?= $nilai->no_uh;?></td>
                <td><?= $nilai->juz;?></td>
                <td><?= $nilai->halaman;?></td>
                <td><?= $nilai->nilai;?></td>
                <td><?= nice_date($nilai->tanggal, 'd F Y');?></td>
                <td><?= $nilai->nama_penguji;?></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahNilai">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                </td>
                </tr>
                <?php else :?>
                <?php foreach ($data_nilai as $nilai):?>
                <tr>
                <td><?= $nilai->kelas;?></td>
                <td>#<?= $nilai->no_uh;?></td>
                <td><?= $nilai->juz;?></td>
                <td><?= $nilai->halaman;?></td>
                <td><?= $nilai->nilai;?></td>
                <td><?= nice_date($nilai->tanggal, 'd F Y');?></td>
                <td><?= $nilai->nama_penguji;?></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahNilai">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editNilai<?= $nilai->nis;?><?= $nilai->kelas;?><?= $nilai->no_uh;?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteNilai<?= $nilai->nis;?><?= $nilai->kelas;?><?= $nilai->no_uh;?>">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
                </td>
                </tr>
                <?php endforeach;?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?=$tambah_sertifikasi?>
<?=$edit_sertifikasi?>
<?=$tambah_nilai?>
<?=$edit_nilai?>
