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
 * Description of Model_user
 *
 * @author s4if
 */
class Model_user extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function checkUserid($nip){
        $query = $this->db->query("select * from user Where nip = ?", [$nip]);
        return ($query -> num_rows() >= 1)? TRUE : FALSE;
    }
    
    public function checkPassword($nip, $passwd){
        $data = $this->db->query("select password from user Where nip = ?", [$nip]);
        $stored_passwd =  $data->row()->password;
        return (md5($passwd) === $stored_passwd)? true : false;
    }
    
    public function getData($nip){
        $data = $this->db->query("select nip, nama from user Where nip = ?", [$nip]);
        return $stored_passwd =  $data->row();
    }
            
    function updatePassword($nip, $passwd){
        $res = $this->db->update("user", ['password' => md5($passwd)],['nip' => $nip]);
        return $res;
    }
}
