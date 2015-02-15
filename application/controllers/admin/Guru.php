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

/**
 * Description of Guru
 *
 * @author s4if
 */
class Guru extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        if (is_cli())
        {
            echo 'This Is For Avoiding Load Session in CLI. ';
            return;
        }  else {
            $this->lihat();
        }
    }
    
    public function lihat(){
        $this->blockUnloggedOne();
        $data = [
            'header' => $this->header(['title' => 'Lihat Guru',
                'user' => ucwords($this->session->login_data->nama)
                ]),
            'navbar' => $this->navbar(['position' => $this->session->position]),
            'footer' => $this->footer(),
            'nama' => $this->session->login_data->nama
        ];
        $this->loadView('admin/guru/lihat', $data);
    }
    
    public function tambah(){
        $this->blockUnloggedOne();
        echo 'tambah';
    }
    
    public function edit(){
        $this->blockUnloggedOne();
        echo 'edit';
    }
    
    public function hapus(){
        $this->blockUnloggedOne();
        echo 'hapus';
    }
    
}
