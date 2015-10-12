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
<?php foreach ($data_sertifikat as $sertifikat):?>
<div class="modal fade" id="editSertifikasi<?=$sertifikat->getId()?>" tabindex="-1" role="dialog" aria-labelledby="editNilai" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Nilai</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/siswa/edit_sertifikat/<?= $sertifikat->getSiswa()->getNis();?>/<?= $sertifikat->getId();?>">
                    <?php
                        $t_obj = $sertifikat->getTgl_ujian();
                        $tgl = date("j-n-Y", $t_obj->getTimestamp());
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Ujian :</label>
                        <div class="col-sm-8">
                            <input class="form-control datepicker" type="text" value="<?=$tgl?>" 
                                   data-date-format="dd-mm-yyyy" name="tgl">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Ujian :</label>
                        <div class="col-sm-8">
                            <textarea class="form-control col-sm-10" rows="3" name="tempat_ujian" required="true"><?=$sertifikat->getTempat_ujian()?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Juz :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="juz" 
                                   placeholder="Masukkan Juz" value="<?=$sertifikat->getJuz()?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="nilai" 
                                   placeholder="Masukkan NIlai" value="<?=$sertifikat->getNilai()?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterangan :</label>
                        <div class="col-sm-8">
                            <textarea class="form-control col-sm-10" rows="3" name="keterangan" required="false"><?=$sertifikat->getKeterangan()?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-sm btn-primary">OK</button>
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
<div class="modal fade" id="deleteSertifikasi<?= $sertifikat->getId();?>" tabindex="-1" role="dialog" aria-labelledby="deleteNilai<?=$sertifikat->getId()?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Sertifikat?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?php echo base_url().'admin/siswa/hapus_sertifikat';?>/<?= $sertifikat->getSiswa()->getNis();?>/<?= $sertifikat->getId();?>">OK</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
