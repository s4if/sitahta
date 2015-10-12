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
    Lihat Peserta
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li>
        <a href="<?=base_url();?>sertifikasi">Sertifikasi</a>
    </li>
    <li class="active">
        Peserta
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
                        <form role="form" method="post" action="<?=base_url();?>admin/peserta/import" enctype="multipart/form-data">
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
<!--<=$tambah?>-->
<div class="col-md-12">
    &nbsp;
</div>
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
                <td>Jenis Kelamin</td>
                <td>TTL</td>
                <td>Juz</td>
                <td>Nilai</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sertifikasi->getPeserta() as $peserta): ?>
            <tr>
            <td><?= $peserta->getSiswa()->getNis();?></td>
            <td><?= $peserta->getSiswa()->getNama();?></td>
            <td><?= $peserta->getSiswa()->getJenis_kelamin();?></td>
            <?php
            $tmpt = ucwords($peserta->getSiswa()->getTempat_lahir());
            $tgl = $peserta->getSiswa()->getTgl_lahir();
            $tanggal = date("d F Y", $tgl->getTimestamp());
            $ttl = $tmpt.", ".$tanggal;
            ?>
            <td><?= $ttl;?></td>
            <td><?= $peserta->getJuz()?></td>
            <td><?= $peserta->getNilai();?></td>
            <td>
                <a class="btn btn-sm btn-success" href="<?=base_url();?>peserta/<?=$peserta->getId()?>">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <?php if($position === 'admin'):?>
                <a id="btnEditSiswa<?= $peserta->getId();?>" class="btn btn-sm btn-warning">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
<!--                <script type="text/javascript">
                    $("#btnEditSiswa<= $peserta->getNis();?>").click(function (){
                        $("#formEdit").attr("action", "<=base_url();?>admin/peserta/edit/<= $peserta->getNis();?>");
                        $("#nisEdit").attr("value", "<= $peserta->getNis();?>");
                        $("#namaEdit").attr("value", "<= $peserta->getNama();?>");
                        $("#jkEdit<= $peserta->getJenis_kelamin();?>").attr("checked", "true");
                        $("#tempatEdit").attr("value", "<=$peserta->getTempat_lahir()?>");
                        $("#ortuEdit").attr("value", "<=$peserta->getNama_ortu();?>");
                        $("#tanggalEdit").attr("value", "<=date('d-n-Y', $peserta->getTgl_lahir()->getTimestamp());?>");
                        $("#editModal").modal("toggle");
                    });
                </script>-->
                <a id="btnHapusSiswa<?=$peserta->getId();?>" class="btn btn-sm btn-danger">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
                <script type="text/javascript">
                    $("#btnHapusSiswa<?=$peserta->getId();?>").click(function (){
                        $("#btnDelOk").attr("href", "<?=base_url().'admin/peserta/hapus/'.$peserta->getId();?>");
                        $("#deleteSiswa").modal("toggle");
                    });
                </script>
                <?php endif;?>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel_utama').DataTable({
            "order": [[ 1, "asc" ]]
        } );
    } );
</script>
<!--<=$edit?>-->
