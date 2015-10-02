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
<!-- Form Tambah -->
<div class="modal fade" id="addNilai" 
     tabindex="-1" role="dialog" aria-labelledby="editNilai" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="addModal">Tambah Nilai</h4>
            </div>
            <div class="modal-body">
                <form id="formAdd" class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">UH Ke :</label>
                        <div class="col-sm-8">
                            <input id="UhAdd" type="number" class="form-control" name="no_uh" 
                                   placeholder="Ulangan Harian" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-2">
                            <input id="kelasAdd" type="text" class="form-control" name="kelas" 
                                   placeholder="Kelas" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester :</label>
                        <div class="col-sm-2">
                            <input id="semesterAdd" type="number" class="form-control" name="semester" 
                                   placeholder="Semester" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">TahunAjaran :</label>
                        <div class="col-sm-2">
                            <input id="tahun_ajaranAdd" type="number" class="form-control" name="tahun_ajaran" 
                                   placeholder="Tahun ajaran" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai :</label>
                        <div class="col-sm-8">
                            <input id="nilaiAdd" type="number" class="form-control" name="nilai" 
                                   placeholder="Masukkan Nilai" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai Remidi :</label>
                        <div class="col-sm-8">
                            <input id="nilaiRemidiAdd" type="number" class="form-control" name="nilai_remidi"
                                   placeholder="Kosongkan jika tidak perlu" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Ulangan :</label>
                        <div class="col-sm-2">
                            <input id="tglAdd" type="text" class="form-control" name="tanggal" pattern="[0-9]{2}"
                                   placeholder="Tanggal" value="" required="true">
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="bulan">
                                <option id="bulanAdd1" value="1">Jan</option>
                                <option id="bulanAdd2" value="2">Feb</option>
                                <option id="bulanAdd3" value="3">Mar</option>
                                <option id="bulanAdd4" value="4">Apr</option>
                                <option id="bulanAdd5" value="5">Mei</option>
                                <option id="bulanAdd6" value="6">Jun</option>
                                <option id="bulanAdd7" value="7">Jul</option>
                                <option id="bulanAdd8" value="8">Agu</option>
                                <option id="bulanAdd9" value="9">Sep</option>
                                <option id="bulanAdd10" value="10">Okt</option>
                                <option id="bulanAdd11" value="11">Nov</option>
                                <option id="bulanAdd12" value="12">Des</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input id="tahunAdd" type="text" class="form-control" name="tahun" pattern="[0-9]{4}"
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
<!-- Form Edit -->
<div class="modal fade" id="editNilai" 
     tabindex="-1" role="dialog" aria-labelledby="editNilai" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Nilai</h4>
            </div>
            <div class="modal-body">
                <form id="formEdit" class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">UH Ke :</label>
                        <div class="col-sm-8">
                            <input id="UhEdit" type="number" class="form-control" name="no_uh" 
                                   placeholder="Ulangan Harian" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-2">
                            <input id="kelasEdit" type="text" class="form-control" name="kelas" 
                                   placeholder="Kelas" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester :</label>
                        <div class="col-sm-2">
                            <input id="semesterEdit" type="number" class="form-control" name="semester" 
                                   placeholder="Semester" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tahun Ajaran :</label>
                        <div class="col-sm-2">
                            <input id="tahun_ajaranEdit" type="number" class="form-control" name="tahun_ajaran" 
                                   placeholder="Tahun Ajaran" value="" required="true" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai :</label>
                        <div class="col-sm-8">
                            <input id="nilaiEdit" type="number" class="form-control" name="nilai" 
                                   placeholder="Masukkan Nilai" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai Remidi :</label>
                        <div class="col-sm-8">
                            <input id="nilaiRemidiEdit" type="number" class="form-control" name="nilai_remidi"
                                   placeholder="Kosongkan jika tidak perlu" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Ulangan :</label>
                        <div class="col-sm-2">
                            <input id="tglEdit" type="text" class="form-control" name="tanggal" pattern="[0-9]{2}"
                                   placeholder="Tanggal" value="" required="true">
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="bulan">
                                <option id="bulanEdit1" value="1">Jan</option>
                                <option id="bulanEdit2" value="2">Feb</option>
                                <option id="bulanEdit3" value="3">Mar</option>
                                <option id="bulanEdit4" value="4">Apr</option>
                                <option id="bulanEdit5" value="5">Mei</option>
                                <option id="bulanEdit6" value="6">Jun</option>
                                <option id="bulanEdit7" value="7">Jul</option>
                                <option id="bulanEdit8" value="8">Agu</option>
                                <option id="bulanEdit9" value="9">Sep</option>
                                <option id="bulanEdit10" value="10">Okt</option>
                                <option id="bulanEdit11" value="11">Nov</option>
                                <option id="bulanEdit12" value="12">Des</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input id="thnEdit" type="number" class="form-control" name="tahun"
                                   placeholder="Tahun" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-sm btn-primary">OK</button>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteNilai">
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
<div class="modal fade" id="deleteNilai" tabindex="-1" role="dialog" aria-labelledby="deleteNilai" aria-hidden="true">
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
                <a id="btnDelOk" class="btn btn-danger" href="">OK</a>
            </div>
        </div>
    </div>
</div>
