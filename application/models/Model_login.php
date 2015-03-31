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
class Model_login extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function checkUserid($id){
        $query = $this->db->query("select * from guru Where nip = ?", [$id]);
        if($query->num_rows() >= 1){
            //return level admin (guru)
            return 'guru';
        }else{
            $query = $this->db->query("select * from siswa Where nis = ?", [$id]);
            if($query->num_rows() >= 1){
                //return level user (siswa)
                return 'user';
            }else{
                //return string 'null' if nothing found
                return 'null';
            }
        }
    }
    
    public function checkPassword($id, $passwd, $position){
        $data = null;
        if($position === 'guru'){
            $data = $this->db->query("select password from guru Where nip = ?", [$id]);
        }elseif ($position === 'user') {
            $data = $this->db->query("select password from siswa Where nis = ?", [$id]);
        }
        $row = $data->row_array();
        $stored_passwd =  $row['password'];
        return (md5($passwd) === $stored_passwd)? true : false;
    }
    
    public function getData($id, $position){
        if($position === 'guru'){
            return $this->getDataGuru($id);
        }elseif ($position === 'user') {
            return $this->getDataSiswa($id);
        }
    }
    
    private function getDataGuru($id){
        $data = $this->db->query("select * from guru Where nip = ?", [$id]);
        return $stored_passwd =  $data->row();
    }
    
    private function getDataSiswa($id){
        $data = $this->db->query("select * from siswa Where nis = ?", [$id]);
        return $stored_passwd =  $data->row();
    }
            
    public function updatePassword($id, $passwd, $position){
        if($position === 'guru'){
            return $this->updatePasswordGuru($id, $passwd);
        }elseif ($position === 'user') {
            return $this->updatePasswordSiswa($id, $passwd);
        }
    }
    
    private function updatePasswordGuru($id, $passwd){
        $res = $this->db->update("guru", ['password' => md5($passwd)],['nip' => $id]);
        return $res;
    } 
    
    private function updatePasswordSiswa($id, $passwd){
        $res = $this->db->update("siswa", ['password' => md5($passwd)],['nis' => $id]);
        return $res;
    }
}
