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

<h1 class="page-header">
    Profil Siswa
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li>
        <a href="<?=base_url();?>siswa">Siswa</a>
    </li>
    <li class="active">
        Profil
    </li>
</ol>
<h3><em>Data Diri</em></h3>
<div class="col-md-12 container-fluid">
    <table>
        <tr>
            <td> Nama </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->getNama();?> </td>
        </tr>
        <tr>
            <td> NIS </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->getNis()?> </td>
        </tr>
        <tr>
            <td> I/A </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=($siswa->getJenis_kelamin() == 'L') ? 'Ikhwan' : 'Akhwat'?> </td>
        </tr>
        <tr>
            <td> TTL </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=ucwords($siswa->getTempat_lahir())?>, <?=date('d F Y', $siswa->getTgl_lahir()->getTimestamp())?> </td>
        </tr>
        <tr>
            <td rowspan="3"> Kelas </td>
            <td rowspan="3"> &nbsp;:&nbsp; </td>
        </tr>
            <?php $kelas = $siswa->getKelas()->toArray()?>
            <?php for ($i = 0; $i < 3; $i++): ?>
            <tr><td> <?php echo (empty($kelas[$i])) ? '' : $kelas[$i]->getId();?> </td></tr>
            <?php endfor;?>
        <tr>
            <td> Nama Ortu / Wali </td>
            <td> &nbsp;:&nbsp; </td>
            <td> <?=$siswa->getNama_ortu()?> </td>
        </tr>
        <tr>
            <td> Hafalan sebelum <br> masuk sma </td>
            <td> &nbsp;:&nbsp; </td>
            <td> - </td>
        </tr>
    </table>
    &nbsp;
</div>
<h3><em>Sertifikasi Hafalan</em></h3>
<div class="col-md-12 container-fluid">
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>Tanggal Ujian</td>
                    <td>Tempat Ujian</td>
                    <td>Juz</td>
                    <td>Nilai</td>
                    <td>Predikat</td>
                    <td>Keterangan</td>
                    <td>Aksi</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data_sertifikasi[0])): ?>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSertifikasi">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                </td>
                </tr>
                <?php else: ?>
                <?php foreach ($data_sertifikasi as $sertifikasi): ?>
                <tr>
                <td><?=$siswa->getNama();?></td>
                <td><?=date('d F Y', $sertifikasi->getTgl_ujian()->getTimestamp());?></td>
                <td><?=$sertifikasi->getTempat_ujian();?></td>
                <td><?=$sertifikasi->getJuz();?></td>
                <td><?=$sertifikasi->getNilai();?></td>
                <td><?=$sertifikasi->getPredikat();?></td>
                <td><?=$sertifikasi->getKeterangan();?></td>
                <td>
                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSertifikasi">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editSertifikasi<?=$sertifikasi->getId();?>">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>
                <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteSertifikasi<?=$sertifikasi->getId();?>">
                    <span class="glyphicon glyphicon-remove"></span>
                </a>
                </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
<h3><em>Ulangan Harian</em></h3>
<?php $list_kelas = array('X', 'XI', 'XII');?>
<?php foreach ($list_kelas as $kelas_tabel): ?>
    <?php for ($i = 1; $i <= 2; $i++):
	$data_nilai = $siswa->getNilaiByKelas($kelas_tabel, $i);?>
    <h4>Kelas <?=$kelas_tabel?> Semester <?=$i?></h4>
    <div class="col-md-12 container-fluid">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>UH</td>
                        <td>Juz</td>
                        <td>Halaman</td>
                        <td>Nilai Awal</td>
                        <td>Nilai Remidi</td>
                        <td>Nilai Akhir</td>
                        <td>Tanggal</td>
                        <td>Penguji</td>
                        <td>Keterangan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data_nilai[0])): ?>
                    <tr>
                    <td>#</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahNilai">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                    </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($data_nilai as $nilai): ?>
                    <tr>
                    <td>#<?=$nilai->getNo_uh();?></td>
                    <td><?=$nilai->getJuz();?></td>
                    <td><?=$nilai->getHalaman();?></td>
                    <td><?=$nilai->getNilai()?></td>
                    <td><?php echo (is_null($nilai->getNilai_remidi())) ? '-' : $nilai->getNilai_remidi();?></td>
                    <td><?=$nilai->getNilai_akhir();?></td>
                    <td><?=date('d F Y', $nilai->getTanggal()->getTimestamp());?></td>
                    <td><?=$nilai->getPenguji()->getNama();?></td>
                    <td><?=$nilai->getKeterangan()?></td>
                    <td>
                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahNilai">
                        <span class="glyphicon glyphicon-plus"></span>
                    </a>
                    <!--<a class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editNilai">-->
                        <!--<span class="glyphicon glyphicon-pencil"></span>-->
                    <!--</a>-->
                    <a id="btnEditNilai<?=$nilai->getId();?>" class="btn btn-sm btn-warning">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <script type="text/javascript">
                        $("#btnEditNilai<?=$nilai->getId();?>").click(function (){
                        $("#formEdit").attr("action", "<?=base_url();?>admin/siswa/edit_nilai/<?= $nilai->getSiswa()->getNis();?>");
                        $("#UhEdit").attr("value", "<?=$nilai->getNo_uh()?>");
                        $("#kelasEdit").attr("value", "<?=$nilai->getKelas()?>");
                        $("#semesterEdit").attr("value", "<?=$nilai->getSemester()?>");
                        $("#juzEdit").attr("value", "<?=$nilai->getJuz()?>");
                        $("#halamanEdit").attr("value", "<?=$nilai->getHalaman()?>");
                        $("#nilaiEdit").attr("value", "<?=$nilai->getNilai()?>");
                        $("#nilaiRemidiEdit").attr("value", "<?php echo (is_null($nilai->getNilai_remidi())) ? '' : $nilai->getNilai_remidi();?>");
                        $("#tglEdit").attr("value", "<?=date('d', $nilai->getTanggal()->getTimestamp());?>");
                        $("#bulanEdit<?=date('n', $nilai->getTanggal()->getTimestamp());?>").attr("selected", "true");
                        $("#tahunEdit").attr("value", "<?=date('Y', $nilai->getTanggal()->getTimestamp());?>");
                        $("#editNilai").modal("toggle");
                        });
                    </script>
                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteNilai">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                    </td>
                    </tr>
                    <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
<?php endfor;?>
<?php endforeach;?>
<?=$tambah_nilai?>
<?=$edit_nilai?>
<?=$tambah_sertifikasi?>
<?=$edit_sertifikasi?>