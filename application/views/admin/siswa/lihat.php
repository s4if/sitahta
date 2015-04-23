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
<div class="col-md-12">
    <div class="btn-group">
        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal">
            <span class="glyphicon glyphicon-plus"></span>
            Tambah
        </a>
        <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalImport">
            <span class="glyphicon glyphicon-import"></span>
            Import
        </a>
        <div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="<?=base_url();?>admin/siswa/import" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Masukkan Input</label>
                                <input type="file" id="file" name="file">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
            <td><?= $siswa->getNis();?></td>
            <td><?= $siswa->getNama();?></td>
            <td><?= $siswa->getJenis_kelamin();?></td>
            <?php
            $tmpt = ucwords($siswa->getTempat_lahir());
            $tgl = $siswa->getTgl_lahir();
            $tanggal = date("d F Y", $tgl->getTimestamp());
            $ttl = $tmpt.", ".$tanggal;
            ?>
            <td><?= $ttl;?></td>
            <?php
            $kelas = ($siswa->getKelas() !== 'X')?$siswa->getKelas()."-".$siswa->getJurusan()."-".$siswa->getNo_kelas():
                $siswa->getKelas()."-".$siswa->getNo_kelas();
            ?>
            <td><?= $kelas;?></td>
            <td><?= $siswa->getNama_ortu();?></td>
            <td>
                <a class="btn btn-sm btn-success" href="<?=base_url();?>siswa/<?=$siswa->getNis()?>">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $siswa->getNis();?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal<?= $siswa->getNis();?>">
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
