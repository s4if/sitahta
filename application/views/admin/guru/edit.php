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
<?php foreach ($data_guru as $guru):?>
<div class="modal fade" id="editModal<?= $guru->nip;?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $guru->nip;?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Guru</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/guru/edit/<?= $guru->nip;?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NIP :</label>
                        <div class="col-sm-8 error">
                            <input type="text" class="form-control" name="nip" disabled="true"
                                   placeholder="Masukkan NIP" value="<?= $guru->nip;?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" 
                                   placeholder="Masukkan Nama" value="<?= $guru->nama;?>" required="true">
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin :</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="L" 
                                        <?php if(!empty($guru->jenis_kelamin)):?>
                                            <?php if($guru->jenis_kelamin=='L'):?>
                                                checked
                                            <?php endif;?>
                                        <?php endif;?>>
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="P"
                                        <?php if(!empty($guru->jenis_kelamin)):?>
                                            <?php if($guru->jenis_kelamin=='P'):?>
                                                checked
                                            <?php endif;?>
                                        <?php endif;?>>
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat :</label>
                        <div class="col-sm-8">
                            <textarea class="form-control col-sm-10" rows="3" name="alamat"><?=$guru->alamat?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">E-mail :</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" name="email" 
                                   placeholder="Masukkan Email" value="<?=$guru->email?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Telepon :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_telp" 
                                   placeholder="Masukkan Nomor Telepon" value="<?=$guru->no_telp?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kewenangan :</label>
                        <div class="col-sm-5">
                            <select class="form-control" name="kewenangan">
                                <option value="admin" 
                                    <?php if(!empty($guru->kewenangan)):?>
                                        <?php if($guru->kewenangan=='admin'): ?>
                                                selected="true"
                                        <?php endif;?>
                                    <?php endif;?>>
                                    Admin
                                </option>
                                <option value="guru" 
                                    <?php if(!empty($guru->kewenangan)):?>
                                        <?php if($guru->kewenangan=='guru'): ?>
                                                selected="true"
                                        <?php endif;?>
                                    <?php endif;?>>
                                    Guru
                                </option>
                            </select>
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
<div class="modal fade" id="myModal<?= $guru->nip;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?=$guru->nip?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel<?= $guru->nip;?>">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data Guru dengan NIP = <?= $guru->nip;?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?php echo base_url().'admin/guru/hapus/'.$guru->nip;?>">OK</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>