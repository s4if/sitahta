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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Tambah Siswa</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/siswa/tambah">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NIS :</label>
                        <div class="col-sm-8 error">
                            <input type="number" class="form-control" name="nis" 
                                   placeholder="Masukkan NIS" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" 
                                   placeholder="Masukkan Nama" value="" required="true">
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin :</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="L">
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="P">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Lahir :</label>
                        <div class="col-sm-8">
                            <input class="form-control datepicker" type="text" 
                                   data-date-format="dd-mm-yyyy" name="tgl">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Lahir :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tempat_lahir" 
                                   placeholder="Masukkan Kota/Kabupaten" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="kelas">
                                <option value="X" >X</option>
                                <option value="XI" >XI</option>
                                <option value="XII" >XII</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="jurusan">
                                <option value="Tahfidz" >Tahfidz</option>
                                <option value="IPA" >IPA</option>
                                <option value="IPS" >IPS</option>
                                <option value="Reguler" >Reguler</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="no_kelas" 
                                   placeholder="Paralel" value="" required="true" pattern="[1-9]{1}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama Ortu/Wali :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_ortu" 
                                   placeholder="Masukkan Nama" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tahun Ajaran :</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" name="tahun_ajaran" 
                                   placeholder="Ex: 2015" value="" required="true">
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