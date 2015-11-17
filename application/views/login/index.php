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
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <title><?=$title?></title>
    <link href="<?=  base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=  base_url() ?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?=  base_url() ?>assets/css/style.css" rel="stylesheet">
    <script src="<?=  base_url() ?>assets/js/jquery-2.0.3.min.js"></script>
    <script src="<?=  base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?=  base_url() ?>assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=  base_url() ?>assets/js/user.js"></script>
    <style>
        body {
            background: url("<?=  base_url() ?>assets/img/bg.png");
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        @media screen and (min-width: 680px) {
        .navbar-transparent {
            background: rgba(255,255,255,0.5);
            background-image: none;
            border-color: transparent;
        }
        .navbar-default .navbar-nav>.active>a,
        .navbar-default .navbar-nav>.active>a:focus,
        .navbar-default .navbar-nav>.active>a:hover {
            background: rgba(255,255,255,0.5);
            background-image: none;
            border-color: transparent;
        }}
        #navbar ul li.active {
            background:rgba(255,255,255,0.5);
            background-image: none;
            border-color: transparent;
        }

        #navbar ul li:hover {
            background:rgba(255,255,255,0.5);
            background-image: none;
            border-color: transparent;
        }
        
        .navbar-brand > img {
            max-height: 100%;
            height: 100%;
            width: auto;
            min-height: 32px;
            min-width: 32px;
            margin: 0 auto;


            /* probably not needed anymore, but doesn't hurt */
            -o-object-fit: contain;
            object-fit: contain
        }
    </style>
</head>
<body class="login">
    <div class="navbar navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=  base_url() ?>">
                    <img class="navbar-brand" alt="Brand" src="<?=  base_url() ?>assets/img/logo.png">
                    Sistem Informasi Tahsin Tahfidz SMAIT Ihsanul Fikri Mungkid
                </a>
            </div>
        </div>
    </div>
<div class="container" style="margin-top:100px">
    <div class="col-md-4 col-md-offset-4">
        <?php if(empty($this->session->flashdata('notices')) === false): ?>
        <div class="alert alert-success alert-dismissible">
        <?php
            echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'.
                    'Close</span></button>'.
                    implode('</p><p>', $this->session->flashdata('notices')) . '</p>';	
            ?>
        </div>
        <?php endif; ?>
        <?php if(empty($this->session->flashdata('errors')) === false): ?>
        <div class="alert alert-warning alert-dismissible">
        <?php
            echo '<button type="button" class="close" data-dismiss="alert"><p>' . 
                    '<span aria-hidden="true">&times;</span><span class="sr-only">'.
                    'Close</span></button>'.
                    implode('</p><p>', $this->session->flashdata('errors')) . '</p></span></button>';	
            ?>
        </div>
        <?php endif; ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title"><strong>Silahkan Login</strong></h3></div>
            <div class="panel-body">
                <form action="<?= base_url()."login/verify"?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="NIS/Id Musyrif" name="nip" value="<?php echo isset($data['nip'])? $data['nip']:'';?>" required="true">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required="true">
                    </div>
                    <button type="submit" class="btn btn-sm btn-default col-xs-4">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
