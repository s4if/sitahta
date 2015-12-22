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
                        <label class="col-sm-3 control-label">Ulangan :</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="uh[]">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal :</label>
                        <div class="col-sm-6">
                            <input class="form-control datepicker" type="text" data-date-format="dd-mm-yyyy" name="tanggal[]">
                        </div>
                        <div class="col-sm-3">
                            <a class="add_field_button btn btn-primary">Tambah</a>
                        </div>
                    </div>
                    <div class="form-group insert_point">
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
        <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#cetakRaport">
            <span class="glyphicon glyphicon-download-alt"></span>
            Cetak PDF
        </a>
        <div class="modal fade" id="cetakRaport" tabindex="-1" role="dialog" aria-labelledby="cetakRaport" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-center">Cetak Raport</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/nilai/raport">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kelas :</label>
                                <div class="col-sm-3">
                                    <select class="form-control" name="kelas">
                                        <?php foreach ($list_kelas as $item_kelas) :?>
                                        <option value='<?=$item_kelas->getId()?>' ><?=$item_kelas->getNamaKelas()?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Semester :</label>
                                <div class="col-sm-2">
                                    <select class="form-control" name="semester">
                                        <option value='1' >1</option>
                                        <option value='2' >2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Tanggal :</label>
                                <div class="col-sm-6">
                                    <input class="form-control datepicker" type="text" data-date-format="dd-mm-yyyy" name="tanggal">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-sm btn-primary">OK</button>
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
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
              overflow-x: scroll;
        }
  </style>
<div class="table">
    <table class="table table-striped table-bordered table-condensed" id="tabel_utama">
        <thead>
            <tr>
                <td rowspan="2">NIS</td>
                <td rowspan="2">Nama</td>
                <?php $jml_uh = ($judul_kelas [0] == 'X')?20:15; ?>
                <?php for($i = 1; $i<=$jml_uh;$i++) : ?>
                <td colspan="2">#<?=$i?></td>
                <?php endfor;?>
                <td colspan="2">#UTS</td>
                <td colspan="2">#UAS</td>
            </tr>
            <tr>
                <?php for($i = 1; $i<=$jml_uh+2;$i++) : ?>
                <td>N</td>
                <td>R</td>
                <?php endfor;?>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
</div>
<script type="text/javascript">
    var table;
    $(function() {
        table = $('#tabel_utama').DataTable({
            "order": [[ 1, "asc" ]],
            "pageLength" : 25,
            "scrollX": true,
            "ajax": {
                "url": "<?php echo base_url().'admin/nilai/ajax_lihat/'.$id_kelas.'/'.$semester?>",
                "type": "POST"
            }
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
    $(function() {
        var max_fields      = 21; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var point         = $(".insert_point"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var id = 1;
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                var inpt = '<div class="form-group extra_delete">'+
                         '<label class="col-sm-3 control-label">Ulangan :</label>'+
                        '<div class="col-sm-6">'+
                        '<input class="form-control" type="text" name="uh[]">'+
                        '</div>'+
                        '</div>'+
                        '<div class="form-group">'+
                        '<label class="col-sm-3 control-label">Tanggal :</label>'+
                        '<div class="col-sm-6">'+
                        '<input class="form-control datepicker" type="text" data-date-format="dd-mm-yyyy" name="tanggal[]">'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                        '<a href="#" class="remove_field btn btn-warning">Hapus</a>'+
                        '</div>'+
                        '</div>';
                $(point).before(inpt);
                $('.datepicker').datepicker();
                id++;
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').prev('.extra_delete').remove();
            $(this).parent('div').parent('div').remove(); x--;
        });
    });
    function save()
    {
        $('.form-group').removeClass('has-error'); // clear error class
        $('.btn-save').text('Menyimpan...'); //change button text
        $('.btn-save').attr('disabled',true); //set button disable 
        var url;

        url = $('#form-edit').prop('action');

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-edit').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#alert-div').empty();
                    $('#alert-div').prepend('<div class="alert alert-success alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert"><p>'+
                        '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                        'Close</span></button>'+
                        '<p>Data Berhasil Disimpan</p>'+
                        '</div>'
                    );
                    table.ajax.reload(null,false);
                }
                else
                {
                    $('#alert-div').empty();
                    $('#alert-div').append('<div class="alert alert-warning alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert"><p>'+
                        '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                        'Close</span></button>'+
                        '<p>Maaf Penyimpanan Data Gagal</p>'+
                        '</div>'
                    );
                }
                $('#form-modal').modal('hide');
                $('.btn-save').text('OK'); //change button text
                $('.btn-save').attr('disabled',false); //set button enable 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('.btn-save').text('OK'); //change button text
                $('.btn-save').attr('disabled',false); //set button enable 

            }
        });
    }
    
    function hapus()
    {
        $('.form-group').removeClass('has-error'); // clear error class
        $('.btn-save').text('Menyimpan...'); //change button text
        $('.btn-save').attr('disabled',true); //set button disable 
        var url;

        url = $('#btn-del-ok').prop('href');

        // ajax adding delete data
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form-edit').serialize(),
            dataType: "JSON",
            success: function(data)
            {

                if(data.status) //if success close modal and reload ajax table
                {
                    $('#alert-div').prepend('<div class="alert alert-success alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert"><p>'+
                        '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                        'Close</span></button>'+
                        '<p>Data Berhasil Dihaous</p>'+
                        '</div>'
                    );
                    table.ajax.reload(null,false);
                }
                else
                {
                    $('#alert-div').append('<div class="alert alert-warning alert-dismissible">'+
                        '<button type="button" class="close" data-dismiss="alert"><p>'+
                        '<span aria-hidden="true">&times;</span><span class="sr-only">'+
                        'Close</span></button>'+
                        '<p>Maaf Penyimpanan Data Gagal</p>'+
                        '</div>'
                    );
                }
                $('#form-modal').modal('hide');
                $('#delete-modal').modal('hide');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error delete data');
            }
        });
    }
</script>
<?= $edit;?>
