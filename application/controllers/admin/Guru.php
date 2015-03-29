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
        $this->load->model('model_guru','guru',TRUE);
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
        $data_guru = $this->guru->getData();
        $data = [
            'title' => 'Lihat Guru',
            'user' => ucwords($this->session->login_data->nama),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->nama,
            'tambah' => $this->load->view("admin/guru/tambah",[],TRUE),
            'edit' => $this->load->view("admin/guru/edit",['data_guru' => $data_guru],TRUE),
            'data_guru' => $data_guru
        ];
        $this->loadView('admin/guru/lihat', $data);
    }
    
    public function tambah(){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['password'] = md5("qwerty");
        print_r($data_insert);
        if($this->guru->dataExist($this->input->post('nip', true))){
            $this->session->set_flashdata("errors",[0 => "Maaf, NIP yang dimasukkan sudah terpakai!"]);
            redirect('admin/guru');
        }else{
            $res = $this->guru->insertData($data_insert, 'guru');
            if($res >= 1){
                $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
                redirect('admin/guru');
            } else {
                $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
                redirect('admin/guru');
            }
        }
    }
    
    public function edit($nip){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nip'] = $nip;
        $res = $this->guru->updateData($data_insert, 'guru');
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('admin/guru');
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('admin/guru');
        }
    }
    
    public function hapus($nip){
        $this->blockUnloggedOne();
        if($this->guru->deleteData(['nip' => $nip])){
            $this->session->set_flashdata("notices",[0 => "Data telah berhasil dihapus"]);
            redirect('admin/guru/lihat', 'refresh');
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, Guru dengan nip = ".$nip." tidak ditemukan"]);
            redirect('admin/guru/lihat', 'refresh');
        }
    }
    
    public function import(){
        $this->blockUnloggedOne();
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->guru->importData($fileUrl);
        if($res == 0){
            $this->session->set_flashdata("notices",[0 => "Import Data Berhasil!"]);
            redirect('guru');
        } elseif($res > 0) {
            $this->session->set_flashdata("errors",[0 => "Import Data Gagal!,<br> cek kembali isi dokumen yang akan diimport!"]);
            redirect('guru');
        }  else {
            $this->session->set_flashdata("errors",[0 => "Import Data Gagal!,<br> File yang dimasukkan bukan file excel!"]);
            redirect('guru');
        }
    }

}
