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
//Menggunakan Modal!! nanti bukan dengan link, tapi dengan modal supaya lebih mudah
//modal disini nanti di load pake load view true kemudian dikumpulkan dalam bentuk array, 
//lalu di echokan kedalam view dalam bentuk data
?>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Sertifikasi</h4>
            </div>
            <div class="modal-body">
                <form id="formEdit" class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Lahir :</label>
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
                            <input id="tahunEdit" type="text" class="form-control" name="tahun" pattern="[0-9]{4}"
                                   placeholder="Tahun" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input id="namaEdit" type="text" class="form-control" name="nama" 
                                   placeholder="Masukkan Nama" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat :</label>
                        <div class="col-sm-8">
                            <input id="tempatEdit" type="text" class="form-control" name="tempat" 
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
<div class="modal fade" id="deleteSertifikasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data Sertifikasi?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="btnDelOk" class="btn btn-danger" href="">OK</a>
            </div>
        </div>
    </div>
</div>