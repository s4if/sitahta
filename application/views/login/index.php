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
            background: url("<?=  base_url() ?>assets/img/bg.jpeg");
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body class="login">
<div class="container" style="margin-top:30px">
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
        <div class="panel panel-primary">
            <div class="panel-heading"><h3 class="panel-title"><strong>Silahkan Login</strong></h3></div>
            <div class="panel-body">
                <form action="<?= base_url()."login/verify"?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="NIP" name="nip" value="<?php echo isset($data['nip'])? $data['nip']:'';?>" required="true">
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