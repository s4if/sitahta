<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author s4if
 */

class Login extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('model_login','user',TRUE);
    }
    
    public function index(){
        if (is_cli())
        {
            echo 'This Is CLI. ';
            return;
        }  else {
            $this->realIndex();
        }
    }
    
    public function realIndex(){
        $this->blockLoggedOne();
        $data = [
            'title' => 'Login SITAHTA'
        ];
        $this->load->view("login/index",$data);
    }
    
    public function verify(){
        $id = $this->input->post('nip', TRUE);
        $password = $this->input->post('password', TRUE);
        $position = $this->user->checkUserid($id);
        if($position === 'null'){
            $this->session->set_flashdata("errors",[0 => "Maaf, "
                . "User dengan nis/nip : ".$id." tidak ada"]);
            redirect('login', 'refresh');
        }else{
            if($this->user->checkPassword($id, $password, $position)){
             $this->session->set_userdata('position', $position);
                $this->setData($id, $position);
                $this->redir($position);
            }else{
                $this->session->set_flashdata("errors",[0 => "Maaf, Password anda salah"]);
                redirect('login', 'refresh');
            }
        }
    }
    
    private function redir($position){
        if($position === 'admin'){
            redirect('admin/home', 'refresh');
        }else{
            redirect('user/index', 'refresh');
        }
    }
    
    private function setData($id, $position){
        $data = $this->user->getData($id, $position);
        $this->session->set_userdata('login_data', $data);
        $this->session->set_userdata('position', $position);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}
