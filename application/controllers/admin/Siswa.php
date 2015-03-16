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
 * Description of Siswa
 *
 * @author s4if
 */
class Siswa extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('model_siswa','siswa',TRUE);
        $this->load->model('model_nilai','nilai',TRUE);
        $this->load->model('model_sertifikasi','sertifikasi',TRUE);
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
        $data_siswa = $this->siswa->getData();
        $data = [
            'title' => 'Lihat Siswa',
            'user' => ucwords($this->session->login_data->nama),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->nama,
            'tambah' => $this->load->view("admin/siswa/tambah",[],TRUE),
            'edit' => $this->load->view("admin/siswa/edit",['data_siswa' => $data_siswa],TRUE),
            'data_siswa' => $data_siswa
        ];
        $this->loadView('admin/siswa/lihat', $data);
    }
    
    public function tambah(){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['tgl_lahir'] = $data_insert['tahun']."-".$data_insert['bulan']."-".$data_insert['tanggal'];
        $data_insert['password'] = md5("qwerty");
        if($this->siswa->dataExist($this->input->post('nis', true))){
            $this->session->set_flashdata("errors",[0 => "Maaf, NIS yang dimasukkan sudah terpakai!"]);
            redirect('admin/siswa');
        }else{
            $res = $this->siswa->insertData($data_insert, 'siswa');
            if($res >= 1){
                $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
                redirect('admin/siswa');
            } else {
                $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
                redirect('admin/siswa');
            }
        }
    }
    
    public function edit($nis){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['nis'] = $nis;
        $data_insert['tgl_lahir'] = $data_insert['tahun']."-".$data_insert['bulan']."-".$data_insert['tanggal'];
        $res = $this->siswa->updateData($data_insert, 'siswa');
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('admin/siswa');
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('admin/siswa');
        }
    }
    
    public function hapus($nis){
        $this->blockUnloggedOne();
        if($this->siswa->deleteData(['nis' => $nis])){
            $this->session->set_flashdata("notices",[0 => "Data telah berhasil dihapus"]);
            redirect('admin/siswa/lihat', 'refresh');
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, Siswa dengan nis = ".$nis." tidak ditemukan"]);
            redirect('admin/siswa/lihat', 'refresh');
        }
    }
    
    public function profil($nis){
        $this->blockUnloggedOne();
        $siswa = $this->siswa->getData($nis);
        $data = [
            'title' => 'Profil Siswa',
            'user' => ucwords($this->session->login_data->nama),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->nama,
            'siswa' => $siswa
        ];
        $this->loadView('admin/siswa/profil', $data);
    }
}
