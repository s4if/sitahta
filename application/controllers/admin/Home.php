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
 * Description of Home
 *
 * @author s4if
 */
class Home extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_login','login',TRUE);
        $this->load->model('model_guru', 'guru', true);
    }
    
    public function index(){
        if (is_cli())
        {
            echo 'This Is For Avoiding Load Session in CLI. ';
            return;
        }  else {
            $this->realIndex();
        }
    }
    
    public function realIndex(){
        $this->blockUnloggedOne();
        $data = [
            'title' => 'Beranda',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nav_pos' => 'dashboard',
            'nama' => $this->session->login_data->getNama(),
        ];
        $this->loadView('admin/index', $data);
    }
    
    public function password(){
        $this->blockUnloggedOne();
        $data = [
            'title' => 'Ganti Password',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama()
        ];
        $this->loadView('admin/password', $data);
    }
    
    public function profil(){
        $this->blockUnloggedOne();
        $guru = $this->guru->getData($this->session->login_data->getNip());
        $data = [
            'title' => 'Beranda',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nav_pos' => 'dashboard',
            'nama' => $this->session->login_data->getNama(),
            'guru' => $guru
        ];
        $this->loadView('admin/profil', $data);
    }
    
    public function edit(){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nip'] = $this->session->login_data->getNip();
        $res = $this->guru->updateData($data_insert, 'guru');
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('home/profil');
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('home/profil');
        }
        var_dump($data_insert);
    }
    
    public function changePassword(){
        $this->blockUnloggedOne(false);
        $new_pass = $this->input->post('new_password', true);
        $confirm_pass = $this->input->post('confirm_password', TRUE);
        $stored_pass = $this->input->post('stored_password', true);
        $nip = $this->session->login_data->getNip();
        $position = $this->session->position;
        if($new_pass === $confirm_pass){
            if($this->login->checkPassword($nip, $stored_pass, $position)){
                $this->login->updatePassword($nip,$new_pass, $position);
                $this->session->set_flashdata("notices",[0 => "Password telah berhasil diganti"]);
                redirect('admin/home/password', 'refresh');
            }else{
                $this->session->set_flashdata("errors",[0 => "Maaf, Password lama salah!"]);
                redirect('admin/home/password', 'refresh');
            }
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, Password baru dan konfirmasi password tidak sama"]);
            redirect('admin/home/password', 'refresh');
        }
        
    }
    
    public function tahun_ajaran(){
        $semester = $this->input->post('semester');
        $tahun_ajaran = $this->input->post('tahun');
        $this->session->set_userdata('tahun_ajaran', $tahun_ajaran);
        $this->session->set_userdata('semester', $semester);
        redirect('admin/home', 'refresh');
    }
}
