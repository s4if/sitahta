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
        <a class="navbar-brand" href="#">SB Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> &nbsp; <?=$user?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><span class="glyphicon glyphicon-user"></span> &nbsp; Profil</a>
                </li>
                <li>
                    <a href="<?=base_url();?>home/password"><span class="glyphicon glyphicon-edit"></span> &nbsp; Kata Sandi</a>
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
            <li>
                <a href="<?=base_url()?>home"><span class="glyphicon glyphicon-dashboard"></span> &nbsp; Dashboard</a>
            </li>
            <?php if($position === 'admin'):?>
            <li>
                <a href="<?=base_url()?>guru"><span class="glyphicon glyphicon-user"></span> &nbsp; Guru</a>
            </li>
            <li>
                <a href="<?=base_url()?>siswa"><span class="glyphicon glyphicon-user"></span> &nbsp; Siswa</a>
            </li>
            <li>
                <a href="<?=base_url()?>nilai"><span class="glyphicon glyphicon-list"></span> &nbsp; Nilai</a>
            </li>
            <?php else :?>
            <!-- Nanti diganti dengan yang sesuai!! -->
            <li>
                <a href="<?=base_url()?>"><i class="glyphicon glyphicon-dashboard"></i> &nbsp; User</a>
            </li>
            <?php endif;?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>