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
class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $view = 'Login Index';
        echo $view;
        return $view;
    }
}
