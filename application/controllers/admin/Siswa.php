<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
        //print_r($this->input->post(null, true));
        $data_insert = $this->input->post(null, true);
        $data_insert['tgl_lahir'] = $data_insert['tahun']."-".$data_insert['bulan']."-".$data_insert['tanggal'];
        $data_insert['password'] = md5("qwerty");
        print_r($data_insert);
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
}
