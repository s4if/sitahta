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
    <div class="btn-group">
        <div class="btn-group"role="group">
            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownImport" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-import"></span>
                Import
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownImport">
                <li role="presentation">
                    <a role="menuitem" data-toggle="modal" data-target="#ModalImportGen">
                        Buat Template
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" data-toggle="modal" data-target="#ModalImportUp">
                        Upload Template
                    </a>
                </li>
            </ul>
        </div>
        <div class="btn-group"role="group">
            <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownKelas" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-list-alt"></span>
                Kelas
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownKelas">
                <li role="presentation">
                    <a role="menuitem" href="<?=  base_url()?>nilai/<?=$judul_kelas[0]?>/<?=$semester?>">
                        Semua
                    </a>
                </li>
                <?php foreach ($list_kelas as $item_kelas) :?>
                <li role="presentation">
                    <a role="menuitem" href="<?=  base_url()?>nilai/<?=$item_kelas->getId()?>/<?=$semester?>">
                        <?=$item_kelas->getNamaKelas()?>
                    </a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="btn-group"role="group">
            <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                <span class="glyphicon glyphicon-time"></span>
                Semester
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                <li role="presentation">
                    <a role="menuitem" href="<?=  base_url()?>nilai/<?=$judul_kelas[0]?>/1">
                        1
                    </a>
                </li>
                <li role="presentation">
                    <a role="menuitem" href="<?=  base_url()?>nilai/<?=$judul_kelas[0]?>/2">
                        2
                    </a>
                </li>
            </ul>
        </div>
        <!-- Form template generator -->
        <div class="modal fade" id="ModalImportGen" tabindex="-1" role="dialog" aria-labelledby="ModalGenImport" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="addModal">Tambah Nilai</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal input_fields_wrap" role="form" method="post" action="<?=base_url();?>admin/nilai/template/<?=$id_kelas?>/<?=$semester?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kelas" 
                                   placeholder="Kelas" value="<?=$judul_kelas[0]?>" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester :</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" name="semester" 
                                   placeholder="Semester" value="<?=$semester?>" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tahun Ajaran :</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="tahun_ajaran" 
                                   placeholder="Semester" value="<?=$tahun_ajaran.'/'.($tahun_ajaran+1)?>" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Juz :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="juz" 
                                   placeholder="Masukkan Juz" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">UH :</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" name="uh[]">
                        </div>
                        <label class="col-sm-2 control-label">Halaman :</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="text" name="halaman[]">
                        </div>
                        <div class="col-sm-2">
                            <a class="add_field_button btn btn-primary">Tambah</a>
                        </div>
                    </div>
                    <div class="form-group insert_point">
                        <label class="col-sm-3 control-label">Tgl Ulangan :</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="hari" pattern="[0-9]{2}"
                                   placeholder="Tanggal" value="" required="true">
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="bulan">
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">Mei</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Agu</option>
                                <option value="9">Sep</option>
                                <option value="10">Okt</option>
                                <option value="11">Nov</option>
                                <option value="12">Des</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="tahun" pattern="[0-9]{4}"
                                   placeholder="Tahun" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-primary">OK</button>
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
        <!-- Real Import -->
        <div class="modal fade" id="ModalImportUp" tabindex="-1" role="dialog" aria-labelledby="ModalImport" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="ModalImportLabel>">Pilih File</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="<?=base_url();?>admin/nilai/import/<?=$judul_kelas[0]?>/<?=$semester?>" enctype="multipart/form-data">
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
<?php //echo $tambah;?>
<div class="col-md-12">
    &nbsp;
</div>
<div class="col-md-12">
    <h3><?php foreach ($judul_kelas as $str_kelas) :
        echo $str_kelas.' ';
    endforeach;?>
        &nbsp;Semester <?=$semester?>
    </h3>
</div>
<div class="col-md-12">
    &nbsp;
</div>
<div class="col-md-12">
    <style type="text/css">
        .fixed-panel {
              min-width: 10;
              max-width: 10;
              //overflow-y: scroll;
              overflow-x: scroll;
        }
  </style>
<div class="fixed-panel">
<div class="table">
    <table class="table table-striped table-bordered table-condensed" id="tabel_utama">
        <thead>
            <tr>
                <td rowspan="2">NIS</td>
                <td rowspan="2">Nama</td>
                <?php $jml_uh = ($judul_kelas [0] == 'X')?20:10; ?>
                <?php for($i = 1; $i<=$jml_uh;$i++) : ?>
                <td colspan="2">#<?=$i?></td>
                <?php endfor;?>
            </tr>
            <tr>
                <?php for($i = 1; $i<=$jml_uh;$i++) : ?>
                <td>N</td>
                <td>R</td>
                <?php endfor;?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_kelas as $kelas) : ?>
            <?php if (!$kelas->getSiswa()->isEmpty()) : ?>
            <?php foreach ($kelas->getSiswa() as $siswa): ?>
            <tr>
                <td><a href="<?=base_url();?>siswa/<?=$siswa->getNis()?>"><?= $siswa->getNis();?></a></td>
            <td><?= $siswa->getNama();?></td>
            <?php for($i = 1; $i<=$jml_uh;$i++) : ?>
            <?php if(is_null($siswa->getNilaiByUH($judul_kelas[0], $i, $semester)[0])) : ?>
            <td>
                <a id="tombol<?=$siswa->getNis()."_".$i?>">
                    --
                </a>
                <script type="text/javascript">
                    $("#tombol<?=$siswa->getNis()."_".$i?>").click(function (){
                        $("#formAdd").attr("action", "<?=base_url();?>admin/nilai/tambah_nilai/<?=$judul_kelas[0]?>/<?= $siswa->getNis();?>");
                        $("#UhAdd").attr("value", "<?=$i?>");
                        $("#kelasAdd").attr("value", "<?=$judul_kelas[0]?>");
                        $("#semesterAdd").attr("value", "<?=$semester?>");
                        $("#tglAdd").attr("value", "<?=date('d');?>");
                        $("#bulanAdd<?=date('n');?>").attr("selected", "true");
                        $("#tahunAdd").attr("value", "<?=date('Y');?>");
                        $("#addNilai").modal("toggle");
                    });
                </script>
            </td>
            <td> -- </td>
            <?php else : ?>
            <?php $data_nilai = $siswa->getNilaiByUH($judul_kelas[0], $i, $semester)[0];
            $keterangan = $data_nilai->getKeterangan();
            $css_cell;
            if($keterangan == "Lulus tanpa remidi"){
                $css_cell = 'success';
            } elseif($data_nilai->getKeterangan() == "Lulus dengan remidi"){
                $css_cell = 'warning';
            } else {
                $css_cell = 'danger';
            }
            ?>
            <td class="<?=$css_cell?>">
                <a data-toggle="modal" id="editNilai<?=$data_nilai->getId();?>">
                    <?= $data_nilai->getNilai();?>
                </a>
                <script type="text/javascript">
                    $("#editNilai<?=$data_nilai->getId();?>").click(function (){
                        $("#formEdit").attr("action", "<?=base_url();?>admin/nilai/edit_nilai/<?=$data_nilai->getKelas()?>/<?= $data_nilai->getSiswa()->getNis();?>");
                        $("#UhEdit").attr("value", "<?=$data_nilai->getNo_uh()?>");
                        $("#kelasEdit").attr("value", "<?=$data_nilai->getKelas()?>");
                        $("#semesterEdit").attr("value", "<?=$data_nilai->getSemester()?>");
                        $("#juzEdit").attr("value", "<?=$data_nilai->getJuz()?>");
                        $("#halamanEdit").attr("value", "<?=$data_nilai->getHalaman()?>");
                        $("#nilaiEdit").attr("value", "<?=$data_nilai->getNilai()?>");
                        $("#nilaiRemidiEdit").attr("value", "<?php echo (is_null($data_nilai->getNilai_remidi())) ? '' : $data_nilai->getNilai_remidi();?>");
                        $("#tglEdit").attr("value", "<?=date('d', $data_nilai->getTanggal()->getTimestamp());?>");
                        $("#bulanEdit<?=date('n', $data_nilai->getTanggal()->getTimestamp());?>").attr("selected", "true");
                        $("#tahunEdit").attr("value", "<?=date('Y', $data_nilai->getTanggal()->getTimestamp());?>");
                        $("#btnDelOk").attr("href", "<?php echo base_url().'admin/nilai/hapus_nilai';?>/<?= $data_nilai->getSiswa()->getNis();?>/<?= $data_nilai->getKelas();?>/<?= $data_nilai->getSemester();?>/<?= $data_nilai->getNo_uh();?>");
                        $("#editNilai").modal("toggle");
                    });
                </script>
            </td>
            <td class="<?=$css_cell?>"> <?php echo (is_null($data_nilai->getNilai_remidi()))?'--':$data_nilai->getNilai_remidi();?> </td>
            <?php endif;?>
            <?php endfor;?>
            </tr>
            <?php endforeach;?>
            <?php endif;?>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel_utama').DataTable({
            "order": [[ 1, "asc" ]]
        } );
    } );
    $(document)
            .on('show.bs.modal', '.modal', function(event) {
                $(this).appendTo($('body'));
            })
            .on('shown.bs.modal', '.modal.in', function(event) {
                setModalsAndBackdropsOrder();
            })
            .on('hidden.bs.modal', '.modal', function(event) {
                setModalsAndBackdropsOrder();
            });

    function setModalsAndBackdropsOrder() {  
        var modalZIndex = 1040;
        $('.modal.in').each(function(index) {
            var $modal = $(this);
            modalZIndex++;
            $modal.css('zIndex', modalZIndex);
            $modal.next('.modal-backdrop.in').addClass('hidden').css('zIndex', modalZIndex - 1);
    });
        $('.modal.in:visible:last').focus().next('.modal-backdrop.in').removeClass('hidden');
    }
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var point         = $(".insert_point"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var id = 1;
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                var inpt = '<div class="form-group">'+
                        '<label class="col-sm-3 control-label">UH :</label>'+
                        '<div class="col-sm-2">'+
                        '<input class="form-control" type="text" name="uh[]">'+
                        '</div>'+
                        '<label class="col-sm-2 control-label">Halaman :</label>'+
                        '<div class="col-sm-2">'+
                        '<input class="form-control" type="text" name="halaman[]">'+
                        '</div>'+
                        '<div class="col-sm-2">'+
                        '<a href="#" class="remove_field btn btn-warning">Hapus</a>'+
                        '</div>'+
                        '</div>';
                $(point).before(inpt);
                id++;
                //$(wrapper).append('<div class="col-sm-12"><input class="col-sm-3 form-control" type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove(); x--;
        });
    });
</script>
<?= $edit;?>
