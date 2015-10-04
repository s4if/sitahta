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
<div class="modal fade" id="tambahSertifikasi" tabindex="-1" role="dialog" aria-labelledby="tambahSertifikasi" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Tambah Sertifikat</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/siswa/tambah_sertifikat/<?=$nis?>">
                    <?php
                        $tgl = explode("-", date('Y-m-d'));
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Ujian :</label>
                        <div class="col-sm-8">
                            <input class="form-control datepicker" type="text" 
                                   data-date-format="dd-mm-yyyy" name="tgl">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Ujian :</label>
                        <div class="col-sm-8">
                            <textarea class="form-control col-sm-10" rows="3" name="tempat_ujian" required="true"></textarea>
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
                        <label class="col-sm-3 control-label">Nilai :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="nilai" 
                                   placeholder="Masukkan NIlai" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Predikat :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="predikat" 
                                   placeholder="Masukkan Predikat" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan :</label>
                        <div class="col-sm-8">
                            <textarea class="form-control col-sm-10" rows="3" name="keterangan" required="false"></textarea>
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