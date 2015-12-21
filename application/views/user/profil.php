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
        Profil
    </li>
</ol>
<h3><em>Data Diri</em></h3>
<style>
    .foto-profil {
        resize: both;
        height: 100%;
        width: 100%;
    }
</style>
<div class="col-md-12 container-fluid">
    <div class="col-md-2">
        <img class="foto-profil img-rounded" src="<?=$foto_profil?>" alt="foto-profil">
    </div>
    <div class="col-md-8">
    <table>
        <tr>
            <td> Nama </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->getNama();?> </td>
        </tr>
        <tr>
            <td> NIS </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->getNis()?> </td>
        </tr>
        <tr>
            <td> I/A </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=($siswa->getJenis_kelamin() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
        </tr>
        <tr>
            <td> TTL </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=ucwords($siswa->getTempat_lahir())?>, <?=  tgl_indo(date('Y m d', $siswa->getTgl_lahir()->getTimestamp()))?> </td>
        </tr>
        <tr>
            <td rowspan="4"> Kelas </td>
            <td rowspan="4"> &nbsp;:&nbsp; </td>
        </tr>
            <?php $kelas = $siswa->getKelas()->toArray()?>
            <?php for ($i = 0; $i < 3; $i++): ?>
            <tr><td> <?php echo (empty($kelas[$i])) ? '' : $kelas[$i]->getId();?> </td></tr>
            <?php endfor;?>
        <tr>
            <td> Nama Ortu / Wali </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->getNama_ortu()?> </td>
        </tr>
        <tr>
            <td>
                <a class="btn btn-primary btn-sm" id="btnEditSiswa">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit Profil
                </a>
                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalImport">
                    <span class="glyphicon glyphicon-upload"></span>
                    Upload Foto
                </a>
            </td>
        </tr>
    </table>
    </div>
    &nbsp;
</div>

<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=base_url();?>user/upload_foto/<?=$siswa->getNis()?>" enctype="multipart/form-data">
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
<div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="editProfil" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Siswa</h4>
            </div>
            <div class="modal-body">
                <form id="formEdit" class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NIS :</label>
                        <div class="col-sm-8 error">
                            <input id="nisEdit" type="number" class="form-control" name="nis" disabled="true"
                                   placeholder="Masukkan NIS" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input id="namaEdit" type="text" class="form-control" name="nama" 
                                   placeholder="Masukkan Nama" value="" required="true">
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin :</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label>
                                    <input id="jkEditL" type="radio" name="jenis_kelamin" value="L">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input id="jkEditP" type="radio" name="jenis_kelamin" value="P">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Lahir :</label>
                        <div class="col-sm-8">
                            <input id="tanggalEdit" class="form-control datepicker" type="text" 
                                   data-date-format="dd-mm-yyyy" name="tgl">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Lahir :</label>
                        <div class="col-sm-8">
                            <input id="tempatEdit" type="text" class="form-control" name="tempat_lahir" 
                                   placeholder="Masukkan Kota/Kabupaten" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Ortu/Wali :</label>
                        <div class="col-sm-8">
                            <input id="ortuEdit" type="text" class="form-control" name="nama_ortu" 
                                   placeholder="Masukkan Nama" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-sm btn-primary">OK</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>  
            </div>
            <div class="modal-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#btnEditSiswa").click(function (){
        $("#formEdit").attr("action", "<?=base_url();?>user/edit/");
        $("#nisEdit").attr("value", "<?= $siswa->getNis();?>");
        $("#namaEdit").attr("value", "<?= $siswa->getNama();?>");
        $("#jkEdit<?= $siswa->getJenis_kelamin();?>").attr("checked", "true");
        $("#tempatEdit").attr("value", "<?=$siswa->getTempat_lahir()?>");
        $("#ortuEdit").attr("value", "<?=$siswa->getNama_ortu();?>");
        $("#tanggalEdit").attr("value", "<?=date('d-n-Y', $siswa->getTgl_lahir()->getTimestamp());?>");
        $("#editProfil").modal("toggle");
    });
</script>
