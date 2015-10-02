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
                <a role="menuitem" href="<?=  base_url()?>kurikulum/X">
                    Kelas X
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/XI">
                    Kelas XI
                </a>
            </li>
            <li role="presentation">
                <a role="menuitem" href="<?=  base_url()?>kurikulum/XII">
                    Kelas XII
                </a>
            </li>
            </ul>
        </div>
    </div>
    <h3>Kelas <?=$kelas?></h3>
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
            <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $kurikulum->getId();?>">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
            </a>
            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal<?= $kurikulum->getId();?>">
                <span class="glyphicon glyphicon-alert"></span>&nbsp;Reset
            </a>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>
<?=$edit?>