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
    Lihat Nilai
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li class="active">
        Nilai
    </li>
</ol>
<div class="col-md-12">
    <div class="btn-group" role="group">
        <div class="btn-group"role="group">
            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-import"></span>
                Import
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#ModalImportSemua">Import Semua</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#ModalImportUH">Import Ulangan Harian</a></li>
            </ul>
        </div>
        <div class="btn-group"role="group">
            <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-import"></span>
                Kelas
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"><a role="menuitem" href="<?=  base_url()?>nilai/<?=$kelas['kelas']?>">
                        Semua
                    </a></li>
                <?php foreach ($list_kelas as $item_kelas) :?>
                <li role="presentation"><a role="menuitem" href="<?=  base_url()?>nilai/<?=$item_kelas->getKelas()?>/<?php echo ($item_kelas->getKelas() == 'X')?'empty':$item_kelas->getJurusan();?>/<?=$item_kelas->getNo_kelas()?>">
                        <?=$item_kelas->getKelas()?>-
                        <?php echo ($item_kelas->getKelas() == 'X')?'':$item_kelas->getJurusan().'-';?>
                        <?=$item_kelas->getNo_kelas()?>
                    </a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImportUH" tabindex="-1" role="dialog" aria-labelledby="ModalImportUH" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Import Nilai</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=base_url();?>admin/nilai/import_uh" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Masukkan Input</label>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="form-group">
                        <label>Masukkan Ulangan Harian</label>
                        <div class="input-group-sm">
                            <input type="number" class="form-control" name="no_uh" value="0">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImportSemua" tabindex="-1" role="dialog" aria-labelledby="ModalImportSemua" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=base_url();?>admin/nilai/import_semua" enctype="multipart/form-data">
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
<div class="col-md-12">
    &nbsp;
</div>
<?php $jml_uh = ($kelas ['kelas'] == 'X')?20:10; ?>
<div class="col-md-12">
    <h4>Kelas <?=$kelas['kelas']?><?php echo ($kelas['kelas'] == 'X' || $kelas['jurusan'] == 'empty')?'':'-'.$kelas['jurusan'];?><?php echo ($kelas['no_kelas'] == 0)?'':'-'.$kelas['no_kelas'];?>
    </h4>
</div>
<div class="col-md-12">
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>NIS</td>
                <td>Nama</td>
                <?php for($i = 1; $i<=$jml_uh/2;$i++) : ?>
                <td colspan="2">#<?=$i?></td>
                <?php endfor;?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_siswa as $siswa):?>
            <tr>
                <td><a href="<?=  base_url().'siswa/'.$siswa->getNis()?>"><?= $siswa->getNis();?></a></td>
                <td><?= $siswa->getNama();?></td>
                <?php 
                $nilai = array();
                foreach ($siswa->getNilai() as $nilai_siswa) :
                    $nilai[$siswa->getNis()][$nilai_siswa->getNo_uh()] = $nilai_siswa;
                endforeach;?>
                <?php for($i = 1; $i<=$jml_uh;$i++) : ?>
                <?php if(empty($nilai[$siswa->getNis()][$i])) : ?>
                <td>
                    <a id="tombol<?=$siswa->getNis()."_".$i?>">
                        --
                    </a>
                    <script type="text/javascript">
                        $("#tombol<?=$siswa->getNis()."_".$i?>").click(function (){
                            assignVal(
                                "<?=base_url();?>admin/nilai/tambah_nilai/<?=$siswa->getNis()?>/<?=$i?>/<?=$siswa->getKelas()?>",
                                "<?=$siswa->getNama()?>",
                                "<?=$i?>",
                                "<?=$siswa->getKelas()?>");
                            $("#tambahNilai").modal("toggle");
                        });
                    </script>
                </td>
                <?php else : ?>
                <?php $data_nilai = $nilai[$siswa->getNis()][$i]?>
                <td>
                    <a data-toggle="modal" data-target="#editNilai<?= $siswa->getNis();?><?= $data_nilai->getKelas();?><?= $data_nilai->getNo_uh();?>">
                        <?= $data_nilai->getNilai();?>
                    </a>
                </td>
                <?php endif;?>
                <?php endfor;?>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>
<?=$edit?>