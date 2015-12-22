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
    Lihat Kegiatan Sertifikasi
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
    <?php if($position === 'admin'):?>
    <div class="btn-group">
        <a id="tmbhSertifikasi" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-plus"></span>
            Tambah
        </a>
    </div>
    <script type="text/javascript">
        $("#tmbhSertifikasi").click(function (){
            $("#formEdit").attr("action", "<?=base_url();?>admin/sertifikasi/tambah/");
            $("#tanggalEdit").attr("value", "<?=date('d-n-Y');?>");
            $("#editModal").modal("toggle");
        });
    </script>
    <?php endif;?>
</div>
<!--<=$tambah?>-->
<div class="col-md-12">
    &nbsp;
</div>
<div class="col-md-12">
    <table class="table table-striped table-bordered table-condensed" id="tabel_utama">
        <thead>
            <tr>
                <td>No.</td>
                <td>Tanggal</td>
                <td>Nama</td>
                <td>Tempat</td>
                <td>Kota</td>
                <td>Tahun Ajaran</td>
                <td>Jumlah Peserta</td>
                <td>Status</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            foreach ($data_sertifikasi as $sertifikasi):?>
            <tr>
            <td><?php echo $count++;?></td>
            <td><?= hari_indo($sertifikasi->getTanggal()->format("N")).', '. tgl_indo($sertifikasi->getTanggal()->format("Y m d"));?></td>
            <td><?= $sertifikasi->getNama();?></td>
            <td><?= $sertifikasi->getTempat();?></td>
            <td><?= $sertifikasi->getKota();?></td>
            <td><?php echo $sertifikasi->getTahun_ajaran() .'/'. (string)((int)$sertifikasi->getTahun_ajaran()+1) ;?></td>
            <td><?= $sertifikasi->getJumlahPeserta();?></td>
            <td><?= $sertifikasi->getStatus();?></td>
            <td>
                <a class="btn btn-sm btn-success" href="<?=base_url();?>sertifikasi/<?=$sertifikasi->getId()?>">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <?php if($position === 'admin'):?>
                <a id="btnEditSertifikasi<?= $sertifikasi->getId();?>" class="btn btn-sm btn-warning">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a id="btnDeleteSertifikasi<?= $sertifikasi->getId();?>" class="btn btn-sm btn-danger" data-toggle="modal">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
                <script type="text/javascript">
                    $("#btnEditSertifikasi<?= $sertifikasi->getId();?>").click(function (){
                        $("#formEdit").attr("action", "<?=base_url();?>admin/sertifikasi/edit/<?= $sertifikasi->getId();?>");
                        $("#namaEdit").attr("value", "<?= $sertifikasi->getNama();?>");
                        $("#tempatEdit").attr("value", "<?= $sertifikasi->getTempat();?>");
                        $("#kotaEdit").attr("value", "<?= $sertifikasi->getKota();?>");
                        $("#tahunAjaranEdit").attr("value", "<?= $sertifikasi->getTahun_ajaran();?>");
                        $("#tanggalEdit").attr("value", "<?= $sertifikasi->getTanggal()->format("d-n-Y");?>");
                        $("#editModal").modal("toggle");
                    });
                    $("#btnDeleteSertifikasi<?= $sertifikasi->getId();?>").click(function (){
                        $("#btnDelOk").attr("href", "<?= base_url().'admin/sertifikasi/hapus/'.$sertifikasi->getId();?>");
                        $("#deleteModal").modal("toggle");
                    });
                </script>
                <?php endif;?>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel_utama').DataTable({
            "scrollX": true
        });
    } );
</script>
<?=$edit?>
