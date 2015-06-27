<?php

class User extends My_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_siswa', 'siswa', TRUE);
        $this->load->model('model_nilai', 'nilai', TRUE);
        $this->load->model('model_sertifikat', 'sertifikat', TRUE);
    }

    public function index() {
        if (is_cli()) {
            echo 'This Is For Avoiding Load Session in CLI. ';
            return;
        } else {
            $this->home();
        }
    }
    
    public function lihat(){
        $this->home();
    }

    public function home() {
        $this->blockUnloggedOne(TRUE);
        $siswa = $this->siswa->getData($this->session->login_data->getNis());
        $data_sertifikat = $siswa->getSertifikat();
        $data = [
            'title' => 'Profil Siswa',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'siswa' => $siswa,
            'nav_pos' => 'dashboardUser',
            'data_sertifikat' => $data_sertifikat,
            'edit_nilai' => $this->load->view("admin/siswa/edit_nilai", [], TRUE),
            'tambah_sertifikat' => $this->load->view("admin/siswa/tambah_sertifikat", ['kelas' => $siswa->getKelas(), 'nis' => $siswa->getNis()], TRUE),
            'edit_sertifikat' => $this->load->view("admin/siswa/edit_sertifikat", ['data_sertifikat' => $data_sertifikat], TRUE),
        ];
        $this->loadView('user/home', $data);
    }
    
    public function profil() {
        $this->blockUnloggedOne(TRUE);
        $siswa = $this->siswa->getData($this->session->login_data->getNis());
        $data_sertifikat = $siswa->getSertifikat();
        $data = [
            'title' => 'Profil Siswa',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'siswa' => $siswa,
            'nav_pos' => 'profilUser',
            'data_sertifikat' => $data_sertifikat,
            'edit_nilai' => $this->load->view("admin/siswa/edit_nilai", [], TRUE),
            'tambah_sertifikat' => $this->load->view("admin/siswa/tambah_sertifikat", ['kelas' => $siswa->getKelas(), 'nis' => $siswa->getNis()], TRUE),
            'edit_sertifikat' => $this->load->view("admin/siswa/edit_sertifikat", ['data_sertifikat' => $data_sertifikat], TRUE),
        ];
        $this->loadView('user/profil', $data);
    }
    public function nilai() {
        $this->blockUnloggedOne(TRUE);
        $siswa = $this->siswa->getData($this->session->login_data->getNis());
        $data_sertifikat = $siswa->getSertifikat();
        $data = [
            'title' => 'Profil Siswa',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'siswa' => $siswa,
            'nav_pos' => 'nilaiUser',
            'data_sertifikat' => $data_sertifikat,
            'edit_nilai' => $this->load->view("admin/siswa/edit_nilai", [], TRUE),
            'tambah_sertifikat' => $this->load->view("admin/siswa/tambah_sertifikat", ['kelas' => $siswa->getKelas(), 'nis' => $siswa->getNis()], TRUE),
            'edit_sertifikat' => $this->load->view("admin/siswa/edit_sertifikat", ['data_sertifikat' => $data_sertifikat], TRUE),
        ];
        $this->loadView('user/nilai', $data);
    }
    
    public function hafalan() {
        $this->blockUnloggedOne(TRUE);
        $siswa = $this->siswa->getData($this->session->login_data->getNis());
        $data_sertifikat = $siswa->getSertifikat();
        $data = [
            'title' => 'Profil Siswa',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama(),
            'siswa' => $siswa,
            'nav_pos' => 'hafalanUser',
            'data_sertifikat' => $data_sertifikat,
            'edit_nilai' => $this->load->view("admin/siswa/edit_nilai", [], TRUE),
            'tambah_sertifikat' => $this->load->view("admin/siswa/tambah_sertifikat", ['kelas' => $siswa->getKelas(), 'nis' => $siswa->getNis()], TRUE),
            'edit_sertifikat' => $this->load->view("admin/siswa/edit_sertifikat", ['data_sertifikat' => $data_sertifikat], TRUE),
        ];
        $this->loadView('user/hafalan', $data);
    }
    
    public function password(){
        $this->blockUnloggedOne(true);
        $data = [
            'title' => 'Ganti Password',
            'user' => ucwords($this->session->login_data->getNama()),
            'position' => $this->session->position,
            'nama' => $this->session->login_data->getNama()
        ];
        $this->loadView('admin/password', $data);
    }
    
    public function changePassword(){
        $this->blockUnloggedOne(true);
        $this->load->model('model_login','login',TRUE);
        $new_pass = $this->input->post('new_password', true);
        $confirm_pass = $this->input->post('confirm_password', TRUE);
        $stored_pass = $this->input->post('stored_password', true);
        $nis = $this->session->login_data->getNis();
        $position = $this->session->position;
        if($new_pass === $confirm_pass){
            if($this->login->checkPassword($nis, $stored_pass, $position)){
                $this->login->updatePassword($nis,$new_pass, $position);
                $this->session->set_flashdata("notices",[0 => "Password telah berhasil diganti"]);
                redirect('user/password', 'refresh');
            }else{
                $this->session->set_flashdata("errors",[0 => "Maaf, Password lama salah!"]);
                redirect('user/password', 'refresh');
            }
        }  else {
            $this->session->set_flashdata("errors",[0 => "Maaf, Password baru dan konfirmasi password tidak sama"]);
            redirect('user/password', 'refresh');
        }
        
    }
}
