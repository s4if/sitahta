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
<!-- Form Edit -->
<div class="modal fade" id="form-modal" 
     tabindex="-1" role="dialog" aria-labelledby="editNilai" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="judul-form">Edit Nilai</h4>
            </div>
            <div class="modal-body">
                <form id="form-edit" class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">UH Ke :</label>
                        <div class="col-sm-8">
                            <input id="no_uh" type="text" class="form-control" name="no_uh" 
                                   placeholder="Ulangan Harian" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-8">
                            <input id="kelas" type="text" class="form-control" name="kelas" 
                                   placeholder="Kelas" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester :</label>
                        <div class="col-sm-8">
                            <input id="semester" type="number" class="form-control" name="semester" 
                                   placeholder="Semester" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tahun Ajaran :</label>
                        <div class="col-sm-8">
                            <input id="tahun_ajaran" type="number" class="form-control" name="tahun_ajaran" 
                                   placeholder="Tahun Ajaran" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai :</label>
                        <div class="col-sm-8">
                            <input id="input_nilai" type="number" class="form-control" name="nilai" 
                                   placeholder="Masukkan Nilai" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai Remidi :</label>
                        <div class="col-sm-8">
                            <input id="nilai_remidi" type="number" class="form-control" name="nilai_remidi"
                                   placeholder="Kosongkan jika tidak perlu" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Ulangan :</label>
                        <div class="col-sm-8">
                            <input id="tgl" class="form-control datepicker" type="text" 
                                   data-date-format="dd-mm-yyyy" name="tgl">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="button" class="btn btn-primary btn-save" onclick="save()">OK</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <a id="btn-del" class="btn btn-danger" data-toggle="modal" data-target="#delete-modal">
                                Hapus
                            </a>
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
<!-- Form Delete -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data nilai?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="btn-del-ok" class="btn btn-danger hidden" href="">OK</a>
                <a id="btn-del-x" class="btn btn-danger" onclick="hapus()">OK</a>
            </div>
        </div>
    </div>
</div>
