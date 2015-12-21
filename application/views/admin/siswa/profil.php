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
            <td rowspan="5"> Kelas </td>
            <td rowspan="5"> &nbsp;:&nbsp; </td>
        </tr>
            <?php $kelas = $siswa->getKelas()->toArray()?>
            <?php for ($i = 0; $i < 4; $i++): ?>
            <tr><td> <?php echo (empty($kelas[$i])) ? '' : $kelas[$i]->getId();?> </td></tr>
            <?php endfor;?>
        <tr>
            <td> Nama Ortu / Wali </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->getNama_ortu()?> </td>
        </tr>
        <?php if($position === 'admin'):?>
        <tr>
            <td>
                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editKelas">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit Kelas
                </a>
                <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalImport">
                    <span class="glyphicon glyphicon-upload"></span>
                    Upload Foto
                </a>
            </td>
        </tr>
        <?php endif?>
    </table>
    </div>
    &nbsp;
</div>
<div class="col-md-12 container-fluid">
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
                <?php if (empty($data_sertifikat[0])): ?>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSertifikasi">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                </td>
                </tr>
                <?php else: ?>
                <?php foreach ($data_sertifikat as $sertifikat): ?>
                <tr>
                <td><?=$siswa->getNama();?></td>
                <td><?=  tgl_indo(date('Y m d', $sertifikat->getTgl_ujian()->getTimestamp()));?></td>
                <td><?=$sertifikat->getTempat_ujian();?></td>
                <td><?=$sertifikat->getJuz();?></td>
                <td><?=$sertifikat->getNilai();?></td>
                <td><?=$sertifikat->getPredikat();?></td>
                <td><?=$sertifikat->getKeterangan();?></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSertifikasi">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editSertifikasi<?=$sertifikat->getId();?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteSertifikasi<?=$sertifikat->getId();?>">
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
<?php $list_kelas = ['X', 'XI', 'XII'];?>
<?php foreach ($list_kelas as $kelas_tabel): ?>
    <?php for ($i = 1; $i <= 2; $i++):
	$data_nilai = $siswa->getNilaiByKelas($kelas_tabel, $i);?>
    <h4>Kelas <?=$kelas_tabel?> Semester <?=$i?></h4>
    <div class="col-md-12 container-fluid">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>UH</td>
                        <td>Juz</td>
                        <td>Materi</td>
                        <td>Nilai Awal</td>
                        <td>Nilai Remidi</td>
                        <td>Nilai Akhir</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data_nilai[1])): ?>
                    <tr>
                    <td>#</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($data_nilai as $nilai): ?>
                    <tr>
                    <td>#<?=$nilai->getNo_uh();?></td>
                    <td><?=$nilai->getMeta()->getJuz();?></td>
                    <td>
                        <?=$nilai->getMeta()->getSurat_awal()?> ayat <?=$nilai->getMeta()->getAyat_awal()?> S/D <?=$nilai->getMeta()->getSurat_akhir()?> ayat <?=$nilai->getMeta()->getAyat_akhir()?>
                    </td>
                    <td><?=$nilai->getNilai()?></td>
                    <td><?php echo (is_null($nilai->getNilai_remidi())) ? '-' : $nilai->getNilai_remidi();?></td>
                    <td><?=$nilai->getNilai_akhir();?></td>
                    <td><?=$nilai->getKeterangan()?></td>
                    </tr>
                    <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
<?php endfor;?>
<?php endforeach;?>
<div class="modal fade" id="editKelas" tabindex="-1" role="dialog" aria-labelledby="editKelas" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Kelas</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal input_fields_wrap" role="form" method="post" action="<?=base_url();?>admin/siswa/edit_kelas/<?=$siswa->getNis()?>">
                    <div class="form-group insert_sebelum">
                        <div class="col-sm-offset-2 col-sm-3">
                            <a id="tbhSebelum" class="btn btn-primary add_field_button_sebelum"><span class="glyphicon glyphicon-chevron-up"></span>
                                Tambah tahun_awal Sebelumnya
                            </a>
                        </div>
                    </div>
                    <?php foreach ($siswa->getKelas() as $kelas):?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">TA <?=$kelas->getTahun_ajaran()?> :</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kelas_<?=$kelas->getTahun_ajaran()?>" 
                                   placeholder="Tingkat" value="<?=$kelas->getKelas()?>" required="true">
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="jurusan_<?=$kelas->getTahun_ajaran()?>">
                                <?php
                                $selected = ['IPA' => '', 'IPS' => '', 'reguler' => ''];
                                if($kelas->getJurusan() == 'IPA'){
                                    $selected['IPA'] = 'selected="true"';
                                } elseif ($kelas->getJurusan() == 'IPS') {
                                    $selected['IPS'] = 'selected="true"';
                                } else {
                                    $selected['reguler'] = 'selected="true"';
                                }
                                ?>
                                <option value="IPA" <?=$selected['IPA']?>>
                                    IPA
                                </option>
                                <option value="IPA" <?=$selected['IPS']?>>
                                    IPS
                                </option>
                                <option value="IPA" <?=$selected['reguler']?>>
                                    Reguler
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="no_kelas_<?=$kelas->getTahun_ajaran()?>" 
                                   placeholder="No. Kelas" value="<?=$kelas->getNo_kelas()?>" required="true">
                        </div>
                        <div class="col-sm-3">
                            <button type="button" id="hapus_<?=$kelas->getTahun_ajaran()?>" class="btn btn-danger" >
                                <span class="glyphicon glyphicon-remove"></span>
                                Hapus Kelas
                            </button>
                            <script type="text/javascript">
                                $("#hapus_<?=$kelas->getTahun_ajaran()?>").click(function (){
                                    $("#btnDelOk").attr("href", "<?=base_url()?>admin/siswa/hapus_kelas/<?=$siswa->getNis()?>/"+
                                            "<?=$kelas->getKelas()?>/"+
                                            "<?=$kelas->getJurusan()?>/"+
                                            "<?=$kelas->getNo_kelas()?>/"+
                                            "<?=$kelas->getTahun_ajaran()?>");
                                    $("#deleteKelas").modal("toggle");
                                });
                            </script>
                        </div>
                        <div class="col-sm-1">
                             <input type="number" class="form-control hidden" name="tahun[]"
                                   value="<?=$kelas->getTahun_ajaran()?>" hidden>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <div class="form-group insert_setelah">
                        <div class="col-sm-offset-2 col-sm-3">
                            <a id="tbhSetelah" class="btn btn-primary add_field_button_setelah"><span class="glyphicon glyphicon-chevron-down"></span>
                                Tambah tahun_awal Berikutnya
                            </a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-primary">OK</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
                </form>
            </div>
            <div class="modal-footer">
                &nbsp;
            </div>
        </div>
    </div>
</div>
<!-- Form Delete -->
<div class="modal fade" id="deleteKelas" tabindex="-1" role="dialog" aria-labelledby="deleteNilai" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data Kelas?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="btnDelOk" class="btn btn-danger" href="">OK</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalImport" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="<?=base_url();?>admin/siswa/upload_foto/<?=$siswa->getNis()?>" enctype="multipart/form-data">
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
<?=$tambah_sertifikat?>
<?=$edit_sertifikat?>
<?php 
$array = new Doctrine\Common\Collections\ArrayCollection();
$tahun_awal = $siswa->getKelas()->first()->getTahun_ajaran();
$tahun_akhir = $siswa->getKelas()->last()->getTahun_ajaran();
?>
<script type="text/javascript">
    
    $(function() {
        var max_fields          = 6; //maximum input boxes allowed
        var wrapper             = $(".input_fields_wrap"); //Fields wrapper
        var point_before        = $(".insert_sebelum"); //Fields wrapper
        var point_after         = $(".insert_setelah"); //Fields wrapper
        var add_button_before   = $(".add_field_button_sebelum"); //Add button ID
        var add_button_after    = $(".add_field_button_setelah"); //Add button ID
        var tahun_awal          = <?=$tahun_awal?>;
        var tahun_akhir          = <?=$tahun_akhir?>;

        var id_before = 1;
        var x_before = 1; //initlal text box count
        $(add_button_before).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_before < max_fields){ //max input box allowed
                x_before++; //text box increment
                tahun_awal--;
                var inpt = '<div class="form-group">'+
                        '<label class="col-sm-2 control-label">TA '+tahun_awal+' :</label>'+
                        '<div class="col-sm-2">'+
                        '<input type="text" class="form-control" name="kelas_'+tahun_awal+'"'+
                        'placeholder="Tingkat" value="" required="true">'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                        '<select class="form-control" name="jurusan_'+tahun_awal+'">'+
                        '<option value="IPA">IPA</option>'+
                        '<option value="IPS">IPS</option>'+
                        '<option value="Reguler">Reguler</option>'+
                        '</select>'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                        '<input type="number" class="form-control" name="no_kelas_'+tahun_awal+'" '+
                        'placeholder="No. Kelas" required="true">'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                        '<a class="btn btn-warning remove_field_before" ><span class="glyphicon glyphicon-remove"></span> Hapus Form </a>'+
                        '</div>'+
                        '<div class="col-sm-1">'+
                        '<input type="number" class="form-control hidden" name="tahun[]" value="'+tahun_awal+'" hidden>'+
                        '</div>'+
                        '</div>';
                $(point_before).after(inpt);
                id_before++;
            }
        });

        $(wrapper).on("click",".remove_field_before", function(e){ //user click on remove text
            e.preventDefault();
            tahun_awal++;
            $(this).parent('div').parent('div').remove(); x_before--;
        });
        
        
        //Setelah
        var id_after = 1;
        var x_after = 1; //initlal text box count
        $(add_button_after).click(function(e){ //on add input button click
            e.preventDefault();
            if(x_after < max_fields){ //max input box allowed
                x_after++; //text box increment
                tahun_akhir++;
                var inpt = '<div class="form-group">'+
                        '<label class="col-sm-2 control-label">TA '+tahun_akhir+' :</label>'+
                        '<div class="col-sm-2">'+
                        '<input type="text" class="form-control" name="kelas_'+tahun_akhir+'"'+
                        'placeholder="Tingkat" value="" required="true">'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                        '<select class="form-control" name="jurusan_'+tahun_akhir+'">'+
                        '<option value="IPA">IPA</option>'+
                        '<option value="IPS">IPS</option>'+
                        '<option value="Reguler">Reguler</option>'+
                        '</select>'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                        '<input type="number" class="form-control" name="no_kelas_'+tahun_akhir+'" '+
                        'placeholder="No. Kelas" required="true">'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                        '<a class="btn btn-warning remove_field_before" ><span class="glyphicon glyphicon-remove"></span> Hapus Form </a>'+
                        '</div>'+
                        '<div class="col-sm-1">'+
                        '<input type="number" class="form-control hidden" name="tahun[]" value="'+tahun_akhir+'" hidden>'+
                        '</div>'+
                        '</div>';
                $(point_after).before(inpt);
                id_after++;
            }
        });

        $(wrapper).on("click",".remove_field_after", function(e){ //user click on remove text
            e.preventDefault();
            tahun_akhir--;
            $(this).parent('div').parent('div').remove(); x_before--;
        });
    });
</script>