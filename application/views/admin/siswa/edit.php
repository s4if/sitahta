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
<?php foreach ($data_siswa as $siswa):?>
<div class="modal fade" id="editModal<?= $siswa->nis;?>" tabindex="-1" role="dialog" aria-labelledby="editModal<?= $siswa->nis;?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Siswa</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" action="<?=base_url();?>admin/siswa/edit/<?= $siswa->nis;?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NIS :</label>
                        <div class="col-sm-8 error">
                            <input type="number" class="form-control" name="nis" disabled="true"
                                   placeholder="Masukkan NIS" value="<?= $siswa->nis;?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" 
                                   placeholder="Masukkan Nama" value="<?= $siswa->nama;?>" required="true">
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin :</label>
                        <div class="col-sm-5">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="L" 
                                        <?php if(!empty($siswa->jenis_kelamin)):?>
                                            <?php if($siswa->jenis_kelamin=='L'):?>
                                                checked
                                            <?php endif;?>
                                        <?php endif;?>>
                                    Laki - Laki
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="jenis_kelamin" value="P"
                                        <?php if(!empty($siswa->jenis_kelamin)):?>
                                            <?php if($siswa->jenis_kelamin=='P'):?>
                                                checked
                                            <?php endif;?>
                                        <?php endif;?>>
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php
                        $tgl = explode("-", $siswa->tgl_lahir);
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Lahir :</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="tanggal">
                                <option value="1" <?php echo ($tgl[2] == 1)?'selected="true"':'';?>>1</option>
                                <option value="2" <?php echo ($tgl[2] == 2)?'selected="true"':'';?>>2</option>
                                <option value="3" <?php echo ($tgl[2] == 3)?'selected="true"':'';?>>3</option>
                                <option value="4" <?php echo ($tgl[2] == 4)?'selected="true"':'';?>>4</option>
                                <option value="5" <?php echo ($tgl[2] == 5)?'selected="true"':'';?>>5</option>
                                <option value="6" <?php echo ($tgl[2] == 6)?'selected="true"':'';?>>6</option>
                                <option value="7" <?php echo ($tgl[2] == 7)?'selected="true"':'';?>>7</option>
                                <option value="8" <?php echo ($tgl[2] == 8)?'selected="true"':'';?>>8</option>
                                <option value="9" <?php echo ($tgl[2] == 9)?'selected="true"':'';?>>9</option>
                                <option value="10" <?php echo ($tgl[2] == 10)?'selected="true"':'';?>>10</option>
                                <option value="11" <?php echo ($tgl[2] == 11)?'selected="true"':'';?>>11</option>
                                <option value="12" <?php echo ($tgl[2] == 12)?'selected="true"':'';?>>12</option>
                                <option value="13" <?php echo ($tgl[2] == 13)?'selected="true"':'';?>>13</option>
                                <option value="14" <?php echo ($tgl[2] == 14)?'selected="true"':'';?>>14</option>
                                <option value="15" <?php echo ($tgl[2] == 15)?'selected="true"':'';?>>15</option>
                                <option value="16" <?php echo ($tgl[2] == 16)?'selected="true"':'';?>>16</option>
                                <option value="17" <?php echo ($tgl[2] == 17)?'selected="true"':'';?>>17</option>
                                <option value="18" <?php echo ($tgl[2] == 18)?'selected="true"':'';?>>18</option>
                                <option value="19" <?php echo ($tgl[2] == 19)?'selected="true"':'';?>>19</option>
                                <option value="20" <?php echo ($tgl[2] == 20)?'selected="true"':'';?>>20</option>
                                <option value="21" <?php echo ($tgl[2] == 21)?'selected="true"':'';?>>21</option>
                                <option value="22" <?php echo ($tgl[2] == 22)?'selected="true"':'';?>>22</option>
                                <option value="23" <?php echo ($tgl[2] == 23)?'selected="true"':'';?>>23</option>
                                <option value="24" <?php echo ($tgl[2] == 24)?'selected="true"':'';?>>24</option>
                                <option value="25" <?php echo ($tgl[2] == 25)?'selected="true"':'';?>>25</option>
                                <option value="26" <?php echo ($tgl[2] == 26)?'selected="true"':'';?>>26</option>
                                <option value="27" <?php echo ($tgl[2] == 27)?'selected="true"':'';?>>27</option>
                                <option value="28" <?php echo ($tgl[2] == 28)?'selected="true"':'';?>>28</option>
                                <option value="29" <?php echo ($tgl[2] == 29)?'selected="true"':'';?>>29</option>
                                <option value="30" <?php echo ($tgl[2] == 30)?'selected="true"':'';?>>30</option>
                                <option value="31" <?php echo ($tgl[2] == 31)?'selected="true"':'';?>>31</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="bulan">
                                <option value="1" <?php echo ($tgl[1] == 1)?'selected="true"':'';?>>Jan</option>
                                <option value="2" <?php echo ($tgl[1] == 2)?'selected="true"':'';?>>Feb</option>
                                <option value="3" <?php echo ($tgl[1] == 3)?'selected="true"':'';?>>Mar</option>
                                <option value="4" <?php echo ($tgl[1] == 4)?'selected="true"':'';?>>Apr</option>
                                <option value="5" <?php echo ($tgl[1] == 5)?'selected="true"':'';?>>Mei</option>
                                <option value="6" <?php echo ($tgl[1] == 6)?'selected="true"':'';?>>Jun</option>
                                <option value="7" <?php echo ($tgl[1] == 7)?'selected="true"':'';?>>Jul</option>
                                <option value="8" <?php echo ($tgl[1] == 8)?'selected="true"':'';?>>Agu</option>
                                <option value="9" <?php echo ($tgl[1] == 9)?'selected="true"':'';?>>Sep</option>
                                <option value="10" <?php echo ($tgl[1] == 10)?'selected="true"':'';?>>Okt</option>
                                <option value="11" <?php echo ($tgl[1] == 11)?'selected="true"':'';?>>Nov</option>
                                <option value="12" <?php echo ($tgl[1] == 12)?'selected="true"':'';?>>Des</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="tahun" pattern="[0-9]{4}"
                                   placeholder="Tahun" value="<?=$tgl[0]?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Lahir :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tempat_lahir" 
                                   placeholder="Masukkan Kota/Kabupaten" value="<?=$siswa->tempat_lahir?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="kelas">
                                <option value="X" <?php echo ($siswa->kelas === "X")?'selected="true"':'';?>>X</option>
                                <option value="XI" <?php echo ($siswa->kelas === "XI")?'selected="true"':'';?>>XI</option>
                                <option value="XII" <?php echo ($siswa->kelas === "XII")?'selected="true"':'';?>>XII</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" name="jurusan">
                                <option value="Tahfidz" <?php echo ($siswa->jurusan === "Tahfidz")?'selected="true"':'';?>>
                                    Tahfidz</option>
                                <option value="IPA" <?php echo ($siswa->jurusan === "IPA")?'selected="true"':'';?>>IPA</option>
                                <option value="IPS" <?php echo ($siswa->jurusan === "IPS")?'selected="true"':'';?>>IPS</option>
                                <option value="Reguler" <?php echo ($siswa->jurusan === "Reguler")?'selected="true"':'';?>>Reguler</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="no_kelas" 
                                   placeholder="Paralel" value="<?=$siswa->no_kelas?>" required="true" pattern="[1-9]{1}">
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
<div class="modal fade" id="myModal<?= $siswa->nis;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?=$siswa->nis?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel<?= $siswa->nis;?>">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data Siswa dengan Nis = <?= $siswa->nis;?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?php echo base_url().'admin/siswa/hapus/'.$siswa->nis;?>">OK</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>