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
        $this->load->model('model_user','user',TRUE);
    }
    
    public function index(){
        if (is_cli())
        {
            echo 'This Is CLI. ';
            return;
        }  else {
            $this->login();
        }
    }
    
    public function login(){
        if($this->blockLoggedOne())
        {
            redirect('admin/home', 'refresh');
        }
        else
        {
            $data = [
                'header' => $this->header(['title' => 'Login SITAHTA']),
                'footer'=> $this->footer()
            ];
            $this->loadView("login/index",$data);
        }
    }
    
    public function verify(){
        $nip = $this->input->post('nip', TRUE);
        $password = $this->input->post('password', TRUE);
        if(!$this->user->checkUserid($nip)){
            $this->session->set_flashdata("errors",[0 => "Maaf, "
                . "User dengan id : ".$nip." tidak ada"]);
            redirect('login/login', 'refresh');
        }else{
            if($this->user->checkPassword($nip, $password)){
                $this->set_data($nip);
                redirect('admin/home', 'refresh');
            }else{
                $this->session->set_flashdata("errors",[0 => "Maaf, Password anda salah"]);
                redirect('login/login', 'refresh');
            }
        }
    }
    
    private function set_data($nip){
        $data = $this->user->getData($nip);
        $this->session->set_userdata('logged_in',$data);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('login/login', 'refresh');
    }
}
