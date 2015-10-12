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
 * Description of Sertifikasi
 *
 * @author s4if
 */
class Sertifikasi extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_sertifikasi','sertifikasi',TRUE);
    }
    
    public function index() {
        if (is_cli()) {
            echo 'This Is For Avoiding Load Session in CLI. ';
            return;
        } else {
            $this->lihat();
        }
    }
    
    public function lihat() {
        $this->blockUnloggedOne();
        $data_sertifikasi = $this->sertifikasi->getData();
        $data = [
            'title' => 'Lihat Sertifikasi',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'nav_pos' => "sertifikasi",
            'data_sertifikasi' => $data_sertifikasi,
            'tahun_ajaran' => $this->session->tahun_ajaran,
            'semester' => $this->session->semester,
            'tambah' => "", //belum
            'edit' => $this->load->view("admin/sertifikasi/edit", [], TRUE),
        ];
        $this->loadView('admin/sertifikasi/lihat', $data);
    }
    
    public function tambah(){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $res = $this->sertifikasi->insertData($data_insert);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
            redirect('admin/sertifikasi');
        } else {
            $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
            redirect('admin/sertifikasi');
        }
    }
    
    public function edit($id){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['id'] = $id;
        $res = $this->sertifikasi->updateData($data_insert);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('admin/sertifikasi');
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('admin/sertifikasi');
        }
    }
    
    public function hapus($id){
        $this->blockUnloggedOne();
        if($this->sertifikasi->deleteData(['id' => $id])){
            $this->session->set_flashdata("notices",[0 => "Data telah berhasil dihapus"]);
            redirect('admin/sertifikasi', 'refresh');
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, Guru dengan nip = ".$nip." tidak ditemukan"]);
            redirect('admin/sertifikasi', 'refresh');
        }
    }
    
    //belum
    public function sertifikasi() {
        $this->blockUnloggedOne();
        $data_sertifikasi = $this->sertifikasi->getData();
        $data = [
            'title' => 'Lihat Sertifikasi',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'nav_pos' => "sertifikasi",
            'data_sertifikasi' => $data_sertifikasi,
            'tahun_ajaran' => $this->session->tahun_ajaran,
            'semester' => $this->session->semester,
            'tambah' => "", //belum
            'edit' => "" //belum
        ];
        $this->loadView('admin/sertifikasi/lihat', $data);
    }
    
    public function peserta($id){
        $this->blockUnloggedOne();
        $sertifikasi = $this->sertifikasi->getData($id);
        $data = [
            'title' => 'Lihat Peserta Sertifikasi',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'nav_pos' => "sertifikasi",
            'tahun_ajaran' => $this->session->tahun_ajaran,
            'semester' => $this->session->semester,
            'sertifikasi' => $sertifikasi,
            'edit' => $this->load->view("admin/sertifikasi/edit_peserta", [], TRUE),
        ];
        $this->loadView('admin/sertifikasi/peserta', $data);
    }
    
    public function tambah_peserta($id_sertifikasi){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['sertifikasi'] = $id_sertifikasi;
        $res = $this->sertifikasi->addPeserta($data_insert);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Tambah Data Berhasil!"]);
            redirect('admin/sertifikasi/peserta/'.$id_sertifikasi);
        } else {
            $this->session->set_flashdata("errors",[0 => "Tambah Data Gagal!"]);
            redirect('admin/sertifikasi/peserta/'.$id_sertifikasi);
        }
    }
    
    public function edit_peserta($id, $id_sertifikasi){
        $this->blockUnloggedOne();
        $data_insert = $this->input->post(null, true);
        $data_insert['id'] = $id;
        $res = $this->sertifikasi->updatePeserta($data_insert);
        if($res >= 1){
            $this->session->set_flashdata("notices",[0 => "Edit Data Berhasil!"]);
            redirect('admin/sertifikasi/peserta/'.$id_sertifikasi);
        } else {
            $this->session->set_flashdata("errors",[0 => "Edit Data Gagal!"]);
            redirect('admin/sertifikasi/peserta/'.$id_sertifikasi);
        }
    }
    
    public function hapus_peserta($id, $id_sertifikasi){
        $this->blockUnloggedOne();
        if($this->sertifikasi->removePeserta(['id' => $id])){
            $this->session->set_flashdata("notices",[0 => "Data telah berhasil dihapus"]);
            redirect('admin/sertifikasi/peserta/'.$id_sertifikasi);
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, Data tidak ditemukan"]);
            redirect('admin/sertifikasi/peserta/'.$id_sertifikasi);
        }
    }
}
