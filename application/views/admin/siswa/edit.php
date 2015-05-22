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
                        <label class="col-sm-3 control-label">Tempat Lahir :</label>
                        <div class="col-sm-8">
                            <input id="tempatEdit" type="text" class="form-control" name="tempat_lahir" 
                                   placeholder="Masukkan Kota/Kabupaten" value="" required="true">
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="kelas">
                                <option value="X" <?ph echo ($siswa->getKelasSekarang($tahun_ajaran)->getKelas() === "X")?'selected="true"':'';?>>X</option>
                                <option value="XI" <?ph echo ($siswa->ggetKelasSekarang($tahun_ajaran)->getKelas() === "XI")?'selected="true"':'';?>>XI</option>
                                <option value="XII" <?ph echo ($siswa->getKelasSekarang($tahun_ajaran)->getKelas() === "XII")?'selected="true"':'';?>>XII</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="jurusan">
                                <option value="Tahfidz" <?ph echo ($siswa->getKelasSekarang($tahun_ajaran)->getJurusan() === "Tahfidz")?'selected="true"':'';?>>
                                    Tahfidz</option>
                                <option value="IPA" <?ph echo ($siswa->getKelasSekarang($tahun_ajaran)->getJurusan() === "IPA")?'selected="true"':'';?>>IPA</option>
                                <option value="IPS" <?ph echo ($siswa->getKelasSekarang($tahun_ajaran)->getJurusan() === "IPS")?'selected="true"':'';?>>IPS</option>
                                <option value="Reguler" <?ph echo ($siswa->getKelasSekarang($tahun_ajaran)->getJurusan() === "Reguler")?'selected="true"':'';?>>Reguler</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="no_kelas" 
                                   placeholder="Paralel" value="<?$siswa->getNo_kelas()?>" required="true" pattern="[1-9]{1}">
                        </div>
                    </div>-->
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
<div class="modal fade" id="deleteSiswa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="deleteSiswa">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data Siswa?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a id="btnDelOk" class="btn btn-danger" href="">OK</a>
            </div>
        </div>
    </div>
</div>