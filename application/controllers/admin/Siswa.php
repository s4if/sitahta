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
            'title' => 'Lihat Guru',
            'user' => ucwords($this->session->login_data->nama),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->nama,
//            'tambah' => $this->load->view("admin/guru/tambah",[],TRUE),
//            'edit' => $this->load->view("admin/guru/edit",['data_guru' => $data_siswa],TRUE),
            'data_siswa' => $data_siswa
        ];
        $this->loadView('admin/siswa/lihat', $data);
    }
}
