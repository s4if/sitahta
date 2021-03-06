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
    Lihat Kurikulum
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li class="active">
        Pengaturan
    </li>
</ol>
<div class="col-md-12">
    <div class="btm-group">
        <div class="btn-group" role="group">
            <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownKelas" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-list-alt"></span>
                Kelas
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownKelas">
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/X/1">
                    Kelas X Semester 1
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/X/2">
                    Kelas X Semester 2
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/XI/1">
                    Kelas XI Semester 1
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/XI/2">
                    Kelas XI Semester 2
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/XII/1">
                    Kelas XII Semester 1
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/XII/2">
                    Kelas XII Semester 2
                </a>
            </li>
            </ul>
        </div>
    </div>
    <h3>Kelas <?=$kelas?> Semester <?=$semester?></h3>
</div>
<div class="col-md-12">
    &nbsp;
</div>
<div class="col-md-12">
<div class="table-responsive">
    <table class="table table-striped table-bordered table-condensed" id="tabel_utama">
        <thead>
            <tr>
                <td>Kelas</td>
                <td>Semester</td>
                <td>Ulangan</td>
                <td>Juz</td>
                <td>Surat Awal</td>
                <td>Ayat Awal</td>
                <td>Surat Akhir</td>
                <td>Ayat Akhir</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_kurikulum as $kurikulum):?>
            <tr>
            <td><?= $kurikulum->getKelas();?></td>
            <td><?= $kurikulum->getSemester();?></td>
            <td><?= $kurikulum->getNo_uh();?></td>
            <td><?= $kurikulum->getJuz();?></td>
            <td><?= $kurikulum->getSurat_awal();?></td>
            <td><?= $kurikulum->getAyat_awal();?></td>
            <td><?= $kurikulum->getSurat_akhir();?></td>
            <td><?= $kurikulum->getAyat_akhir();?></td>
            <td>
            <a class="btn btn-sm btn-warning" id="btnEdit<?= $kurikulum->getId();?>">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
            </a>
            <a class="btn btn-sm btn-danger" id="btnDel<?= $kurikulum->getId();?>">
                <span class="glyphicon glyphicon-alert"></span>&nbsp;Reset
            </a>
            <script type="text/javascript">
                $("#btnEdit<?= $kurikulum->getId();?>").click(function (){
                    $("#formEdit").attr("action", "<?=base_url();?>admin/kurikulum/edit/<?= $kurikulum->getKelas().'/'.$kurikulum->getSemester().'/'.$kurikulum->getNo_uh().'/'.$kurikulum->getTahun();?>");
                    $("#editKelas").attr("value", "<?= $kurikulum->getKelas();?>");
                    $("#editSemester").attr("value", "<?= $kurikulum->getSemester();?>");
                    $("#editUlangan").attr("value", "<?= $kurikulum->getNo_uh();?>");
                    $("#editJuz").attr("value", "<?= $kurikulum->getJuz();?>");
                    $('select[name="surat_awal"]').find('option[value="<?= $kurikulum->getSurat_awal();?>"]').attr("selected",true);
                    $('select[name="surat_akhir"]').find('option[value="<?= $kurikulum->getSurat_akhir();?>"]').attr("selected",true);
                    $("#editSuratAwal").attr("value", "<?= $kurikulum->getSurat_awal();?>");
                    $("#editAyatAwal").attr("value", "<?= $kurikulum->getAyat_awal();?>");
                    $("#editSuratAkhir").attr("value", "<?= $kurikulum->getSurat_akhir();?>");
                    $("#editAyatAkhir").attr("value", "<?= $kurikulum->getAyat_akhir();?>");
                    $("#editModal").modal("toggle");
                });
                $("#btnDel<?= $kurikulum->getId();?>").click(function (){
                    $("#btnDelOk").attr("href", "<?php echo base_url().'admin/kurikulum/reset/'.$kurikulum->getKelas().'/'.$kurikulum->getSemester().'/'.$kurikulum->getNo_uh().'/'.$kurikulum->getTahun();?>");
                    $("#modalReset").modal("toggle");
                });
            </script>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>
<?=$edit?>