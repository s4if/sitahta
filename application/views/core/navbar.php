<?php

/* 
 * The MIT License
 *
 * Copyright 2014 s4if.
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
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Sistem Informasi Program Tahsin Tahfidz</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li><a data-toggle="modal" data-target="#modalTA" >TA : <?=$this->session->tahun_ajaran?>, SEM : <?=$this->session->semester?></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> &nbsp; <?=$user?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?=base_url();?><?=($position === 'admin' || $position === 'guru')?'home':'user';?>/profil"><span class="glyphicon glyphicon-user"></span> &nbsp; Profil</a>
                </li>
                <li>
                    <a href="<?=base_url();?><?=($position === 'admin' || $position === 'guru')?'home':'user';?>/password"><span class="glyphicon glyphicon-edit"></span> &nbsp; Kata Sandi</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?=base_url()?>logout"><span class="glyphicon glyphicon-log-out"></span> &nbsp; Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <?php if($position === 'admin' || $position === 'guru'):?>
            <li id="navDashboard">
                <a href="<?=base_url()?>home"><span class="glyphicon glyphicon-home"></span> &nbsp; Dashboard</a>
            </li>
            <?php if($position === 'admin'):?>
            <li id="navGuru">
                <a href="<?=base_url()?>guru"><span class="glyphicon glyphicon-user"></span> &nbsp; Guru</a>
            </li>
            <?php endif; ?>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#siswa"><span class="glyphicon glyphicon-user"></span> Siswa <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="siswa" class="collapse">
                    <li id="navSiswaX" class="active">
                        <a href="<?=base_url()?>siswa/kelas/X">Kelas X</a>
                    </li>
                    <li id="navSiswaXI">
                        <a href="<?=base_url()?>siswa/kelas/XI">Kelas XI</a>
                    </li>
                    <li id="navSiswaXII">
                        <a href="<?=base_url()?>siswa/kelas/XII">Kelas XII</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#nilai"><span class="glyphicon glyphicon-list"></span> Nilai <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="nilai" class="collapse">
                    <li id="navNilaiX">
                        <a href="<?=base_url()?>nilai/X/<?=(empty($semester))?'':$semester;?>">Kelas X</a>
                    </li>
                    <li id="navNilaiXI">
                        <a href="<?=base_url()?>nilai/XI/<?=(empty($semester))?'':$semester;?>">Kelas XI</a>
                    </li>
                    <li id="navNilaiXII">
                        <a href="<?=base_url()?>nilai/XII/<?=(empty($semester))?'':$semester;?>">Kelas XII</a>
                    </li>
                </ul>
            </li>
            <?php if($position === 'admin'):?>
            <li id="navKurikulum">
                <a href="<?=base_url()?>kurikulum"><span class="glyphicon glyphicon-cog"></span> &nbsp; Kurikulum</a>
            </li>
            <?php endif; ?>
            <li id="navSertifikasi">
                <a href="<?=base_url()?>sertifikasi"><span class="glyphicon glyphicon-list-alt"></span> &nbsp; Sertifikasi</a>
            </li>
            <?php elseif($position === 'user') :?>
            <!-- Nanti diganti dengan yang sesuai!! -->
            <li id="navDashboardUser">
                <a href="<?=base_url()?>user/home"><span class="glyphicon glyphicon-dashboard"></span> &nbsp; Dashboard</a>
            </li>
            <li id="navProfilUser">
                <a href="<?=base_url()?>user/profil"><i class="glyphicon glyphicon-user"></i> &nbsp; Profil</a>
            </li>
            <li id="navNilaiUser">
                <a href="<?=base_url()?>user/nilai"><i class="glyphicon glyphicon-list"></i> &nbsp; Nilai</a>
            </li>
            <li id="navHafalanUser">
                <a href="<?=base_url()?>user/hafalan"><i class="glyphicon glyphicon-list-alt"></i> &nbsp; Hafalan</a>
            </li>
            <?php endif;?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

<div class="modal fade" id="modalTA" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ModalImportLabel">Pilih Tahun Ajaran</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" role="form" action="<?=base_url()?>admin/home/tahun_ajaran">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tahun Ajaran :</label>
                        <div class="col-sm-9">
                            <input id="tahunEdit" type="text" class="form-control" name="tahun" pattern="[0-9]{4}"
                                   placeholder="Ex. 2014" value="" required="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Semester :</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="semester">
                                <option>1</option>
                                <option>2</option>
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

<script type="text/javascript">
    $("#nav<?=  ucfirst($nav_pos);?>").attr('class','active');
</script>