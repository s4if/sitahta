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
<?php foreach ($data_siswa as $siswa):?>
<?php for($i = 1; $i<=20;$i++) : ?>
<?php if(empty($data_nilai[$siswa->nis][$i])) : ?>
<div class="modal fade" id="tambahNilai<?=$siswa->nis."_".$i?>" tabindex="-1" role="dialog" aria-labelledby="tambahNilai" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Tambah Nilai</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" 
                      action="<?=base_url();?>admin/nilai/tambah_nilai/<?=$siswa->nis?>/<?=$i?>/<?=$siswa->kelas?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" disabled="true" 
                                   placeholder="Ulangan Harian" value="<?=$siswa->nama?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">UH Ke :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="no_uh" disabled="true"
                                   placeholder="Ulangan Harian" value="<?=$i?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_uh" disabled="true"
                                   placeholder="Ulangan Harian" value="<?=$siswa->kelas?>" required="true">
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
                        <label class="col-sm-3 control-label">Halaman :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="halaman" 
                                   placeholder="Masukkan Halaman" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="nilai" 
                                   placeholder="Masukkan NIlai" value="" required="true">
                        </div>
                    </div>
                    <?php
                        $tgl = explode("-", date('Y-m-d'));
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Ulangan :</label>
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
<?php else : ?>
<?php $nilai = $data_nilai[$siswa->nis][$i] ?>
<div class="modal fade" id="editNilai<?= $nilai->nis;?><?= $nilai->kelas;?><?= $nilai->no_uh;?>" 
     tabindex="-1" role="dialog" aria-labelledby="editNilai<?= $nilai->nis;?><?= $nilai->kelas;?><?= $nilai->no_uh;?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" id="tambahModal">Edit Nilai</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="post" 
                      action="<?=base_url();?>admin/nilai/edit_nilai/<?=$siswa->nis?>/<?=$i?>/<?=$siswa->kelas?>">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="no_uh" disabled="true"
                                   placeholder="Ulangan Harian" value="<?=$siswa->nama?>" required="false">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">UH Ke :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="no_uh" disabled="true"
                                   placeholder="Ulangan Harian" value="<?=$nilai->no_uh?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Kelas :</label>
                        <div class="col-sm-2">
                            <select class="form-control" name="kelas">
                                <option value="X" <?php echo ($nilai->kelas === "X")?'selected="true"':'';?>>X</option>
                                <option value="XI" <?php echo ($nilai->kelas === "XI")?'selected="true"':'';?>>XI</option>
                                <option value="XII" <?php echo ($nilai->kelas === "XII")?'selected="true"':'';?>>XII</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Juz :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="juz" 
                                   placeholder="Masukkan Juz" value="<?=$nilai->juz?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Halaman :</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="halaman" 
                                   placeholder="Masukkan Nama" value="<?=$nilai->halaman?>" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nilai :</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="nilai" 
                                   placeholder="Masukkan Nama" value="<?=$nilai->nilai?>" required="true">
                        </div>
                    </div>
                    <?php
                        $tgl = explode("-", $nilai->tanggal);
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tgl Ulangan :</label>
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
                        <div class="col-sm-offset-2 col-sm-6">
                            <button type="submit" class="btn btn-primary">OK</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" 
                                    data-target="#deleteNilai<?= $nilai->nis;?><?= $nilai->kelas;?><?= $nilai->no_uh;?>">
                                Hapus
                            </button>
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
<div class="modal fade" id="deleteNilai<?= $nilai->nis;?><?= $nilai->kelas;?><?= $nilai->no_uh;?>" tabindex="-1" role="dialog" aria-labelledby="deleteNilai<?=$siswa->nis?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel<?= $siswa->nis;?>">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data nilai?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger" href="<?php echo base_url().'admin/nilai/hapus_nilai';?>/
                <?= $nilai->nis;?>/
                <?= $nilai->kelas;?>/
                <?= $nilai->no_uh;?>">OK</a>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<?php endfor;?>
<?php endforeach; ?>
