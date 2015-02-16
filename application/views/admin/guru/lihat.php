<!--
The MIT License

Copyright 2015 s4if.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
-->

<h1 class="page-header">
    Lihat Guru
</h1>
<ol class="breadcrumb">
    <li>
        <a href="<?=base_url();?>admin/home">Beranda</a>
    </li>
    <li class="active">
        Guru
    </li>
</ol>
<a class="btn btn-sm btn-success" href="<?php  echo base_url().'admin/guru/tambah/'?>">
    <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah
</a>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <td>NIP</td>
                <td>Nama</td>
                <td>P/L</td>
                <td>Alamat</td>
                <td>E-mail</td>
                <td>No. Telp</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_guru as $guru):?>
            <tr>
            <td><?= $guru->nip;?></td>
            <td><?= $guru->nama;?></td>
            <td><?= $guru->jenis_kelamin;?></td>
            <td><?= $guru->alamat;?></td>
            <td><?= $guru->email;?></td>
            <td><?= $guru->no_telp;?></td>
            <td>
            <a class="btn btn-sm btn-info" href="<?php  echo base_url().'admin/guru/edit/'.$guru->nip;?>"><span class="glyphicon glyphicon-pencil"></span></a>
            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal<?= $guru->nip;?>">
                <span class="glyphicon glyphicon-remove"></span>
            </a>
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
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>