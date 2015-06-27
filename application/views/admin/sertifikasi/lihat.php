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
    Lihat Guru
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li class="active">
        Sertifikasi
    </li>
</ol>
<div class="col-md-12">
    <div class="btn-group">
        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal">
            <span class="glyphicon glyphicon-plus"></span>
            Tambah
        </a>
    </div>
</div>
<?=$tambah?>
<div class="col-md-12">
    &nbsp;
</div>
<div class="col-md-12">
<div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed" id="tabel_utama">
        <thead>
            <tr>
                <td>ID</td>
                <td>Tanggal</td>
                <td>Nama</td>
                <td>Tempat</td>
                <td>Jumlah Peserta</td>
                <td>Status</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_sertifikasi as $sertifikasi):?>
            <tr>
            <td><?= $sertifikasi->getId();?></td>
            <td><?= $sertifikasi->getTanggal()->format("l, j F Y");?></td>
            <td><?= $sertifikasi->getNama();?></td>
            <td><?= $sertifikasi->getTempat();?></td>
            <td><?= $sertifikasi->getJumlahPeserta();?></td>
            <td><?= $sertifikasi->getStatus();?></td>
            <td>
                <a class="btn btn-sm btn-success" href="<?=base_url();?>sertifikasi/<?=$sertifikasi->getId()?>">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel_utama').DataTable();
    } );
</script>
<?=$edit?>
