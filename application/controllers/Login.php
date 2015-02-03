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
    
//    public function index(){
//        $this->load->library('session');
//        if($this->session->userdata('logged_in'))
//        {
//            redirect('admin/home', 'refresh');
//        }
//        else
//        {
//            $this->load->helper('form');
//            $data = [
//                'header' => $this->header(['title' => 'Login SIPERPU']),
//                'footer'=> $this->footer()
//            ];
//            $this->loadView("login/index",$data);
//        }   
//    }
//    
//    public function verify(){
//    //This method will have the credentials validation
//        $this->load->library('session');
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules('nip', 'nip', 'trim|required|xss_clean');
//        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
//
//        if($this->form_validation->run() == FALSE)
//        {
//            //Field validation failed.  User redirected to login page
//            $data = [
//                'header' => $this->header(['title' => 'Login SIPERPU']),
//                'footer'=> $this->footer()
//            ];
//            $this->loadView("login/index",$data);
//        }
//        else
//        {
//            //Go to private area
//            redirect('admin/home', 'refresh');
//        }
//    
//    }
//  
//    function check_database($password)
//    {
//        $this->load->library('session');
//        //Field validation succeeded.  Validate against database
//        $nip = $this->input->post('nip');
//
//        //query the database
//        $result = $this->user->login($nip, $password);
//
//        if($result)
//        {
//            $sess_array = array();
//            foreach($result as $row)
//            {
//                $sess_array = array(
//                  'nip' => $row->nip,
//                  'nama' => $row->nama
//                );
//                $this->session->set_userdata('logged_in', $sess_array);
//            }
//            return TRUE;
//        }
//        else
//        {
//            $this->form_validation->set_message('check_database', 'NIP atau Password Salah!');
//            return false;
//        }
//    }
}
