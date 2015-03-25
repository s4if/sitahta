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
    Lihat Guru
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>home">Beranda</a>
    </li>
    <li class="active">
        Nilai
    </li>
</ol>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>NIS</td>
                <td>Nama</td>
                <?php 
                $uh = ($kelas_10)?20:10;
                for($i = 1; $i<=$uh;$i++) : 
                    echo '<td>#'.$i.'</td>'; 
                endfor;
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_siswa as $siswa):?>
            <tr>
                <td><a href="<?=  base_url().'siswa/'.$siswa->nis?>"><?= $siswa->nis;?></a></td>
                <td><?= $siswa->nama;?></td>
                <?php for($i = 1; $i<=$uh;$i++) : ?>
                <?php if(empty($data_nilai[$siswa->nis][$i])) : ?>
                <td>
                    <a data-toggle="modal" data-target="#tambahNilai<?=$siswa->nis."_".$i?>">
                        --
                    </a>
                </td>
                <?php else : ?>
                <?php $nilai = $data_nilai[$siswa->nis][$i]?>
                <td>
                    <a data-toggle="modal" data-target="#editNilai<?= $nilai->nis;?><?= $nilai->kelas;?><?= $nilai->no_uh;?>">
                        <?= $nilai->nilai;?>
                    </a>
                </td>
                <?php endif;?>
                <?php endfor;?>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?=$edit?>