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
    Lihat Siswa
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li class="active">
        Siswa
    </li>
</ol>
<?=$tambah?>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>NIS</td>
                <td>Nama</td>
                <td>P/L</td>
                <td>TTL</td>
                <td>Kelas</td>
                <td>Nama Orang Tua</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_siswa as $siswa):?>
            <tr>
            <td><?= $siswa->nis;?></td>
            <td><?= $siswa->nama;?></td>
            <td><?= $siswa->jenis_kelamin;?></td>
            <?php
            $tmpt = ucwords($siswa->tempat_lahir);
            $tgl = explode('-', $siswa->tgl_lahir);
            $bln = '';
            switch ($tgl[1]):
                case 1 :
                    $bln = 'Jan';
                    break;
                case 2 :
                    $bln = 'Feb';
                    break;
                case 3 :
                    $bln = 'Mar';
                    break;
                case 4 :
                    $bln = 'Apr';
                    break;
                case 5 :
                    $bln = 'Mei';
                    break;
                case 6 :
                    $bln = 'Jun';
                    break;
                case 7 :
                    $bln = 'Jul';
                    break;
                case 8 :
                    $bln = 'Ags';
                    break;
                case 9 :
                    $bln = 'Sep';
                    break;
                case 10 :
                    $bln = 'Okt';
                    break;
                case 11 :
                    $bln = 'Nov';
                    break;
                case 12 :
                    $bln = 'Des';
                    break;
            endswitch;
            $ttl = $tmpt.", ".$tgl[2]." ".$bln." ".$tgl[0];
            ?>
            <td><?= $ttl;?></td>
            <?php
            $kelas = ($siswa->kelas !== 'X')?$siswa->kelas."-".$siswa->jurusan."-".$siswa->no_kelas:
                $siswa->kelas."-".$siswa->no_kelas;
            ?>
            <td><?= $kelas;?></td>
            <td><?= $siswa->nama_ortu;?></td>
            <td>
                <a class="btn btn-sm btn-success" href="<?=base_url();?>siswa/<?=$siswa->nis?>">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahModal">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $siswa->nis;?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal<?= $siswa->nis;?>">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?=$edit?>
