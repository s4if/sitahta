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
<?php foreach ($data_kurikulum as $kurikulum):?>
<div class="modal fade" id="editModal<?= $kurikulum->getId();?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $kurikulum->getId();?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Kurikulum</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/kurikulum/edit/<?= $kurikulum->getKelas().'/'.$kurikulum->getSemester().'/'.$kurikulum->getNo_uh().'/'.$kurikulum->getTahun();?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="kelas" disabled="true"
                                   placeholder="Masukkan Kelas" value="<?= $kurikulum->getKelas();?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="semester" disabled="true"
                                   placeholder="Masukkan Semester" value="<?= $kurikulum->getSemester();?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ulangan :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_uh" disabled="true"
                                   placeholder="Masukkan Ulangan" value="<?= $kurikulum->getNo_uh();?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Juz :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="juz"  
                                   placeholder="Masukkan Juz" value="<?= $kurikulum->getJuz();?>" required="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Surat Awal :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="surat_awal"  
                                   placeholder="Masukkan Surat Awal" value="<?= $kurikulum->getSurat_awal();?>" required="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ayat Awal :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="ayat_awal"  
                                   placeholder="Masukkan Ayat Awal" value="<?= $kurikulum->getAyat_awal();?>" required="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Surat Akhir :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="surat_akhir"  
                                   placeholder="Masukkan Surat Akhir" value="<?= $kurikulum->getSurat_akhir();?>" required="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Ayat Akhir :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="ayat_akhir"  
                                   placeholder="Masukkan Ayat Akhir" value="<?= $kurikulum->getAyat_akhir();?>" required="false">
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
<div class="modal fade" id="myModal<?= $kurikulum->getId();?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?=$kurikulum->getId()?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel<?= $kurikulum->getId();?>">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Mereset Data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?php echo base_url().'admin/kurikulum/reset/'.$kurikulum->getKelas().'/'.$kurikulum->getSemester().'/'.$kurikulum->getNo_uh().'/'.$kurikulum->getTahun();?>">OK</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>