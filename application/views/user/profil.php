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
        <a href="<?=base_url();?>user/home">Beranda</a>
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
    </table>
    &nbsp;
</div>