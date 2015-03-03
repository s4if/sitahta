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
 * Description of Model_guru
 *
 * @author s4if
 */
class Model_guru extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($nip = "Empty"){
        $where = ($nip === "Empty")?"":"Where nip = ".$nip;
        $data = $this->db->query("select * from guru ".$where);
        return ($nip === "Empty")?$data->result():$data->result()[0];
    }
    
    public function insertData($data, $table_name = 'guru'){
        if(!$this->dataExist($data['nip'])){
            $this->setData($data);
            $this->db->insert($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function updateData($data, $table_name = 'guru'){
        if($this->dataExist($data['nip'])){
            $this->setData($data);
            $this->db->update($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        if($this->dataExist($where['nip'])){
            $this->db->delete('guru', $where);
            return true;
        }else{
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data){
        if (!empty($data['nip'])) : $this->db->set('nip',$data['nip']); endif;
        if (!empty($data['nama'])) : $this->db->set('nama',$data['nama']); endif;
        if (!empty($data['jenis_kelamin'])) : $this->db->set('jenis_kelamin',$data['jenis_kelamin']); endif;
        if (!empty($data['alamat'])) : $this->db->set('alamat',$data['alamat']); endif;
        if (!empty($data['email'])) : $this->db->set('email',$data['email']); endif;
        if (!empty($data['no_telp'])) : $this->db->set('no_telp',$data['no_telp']); endif;
        if (!empty($data['password'])) : $this->db->set('password',$data['password']); endif;
        if (!empty($data['kewenangan'])) : $this->db->set('kewenangan',$data['kewenangan']); endif;
    }
    
    public function dataExist($nip) {
        $query = $this->db->query("SELECT * FROM guru where nip ='".$nip."';");
        $rows = $query->num_rows();
        if($rows == 1){
            return true;
        }else{
            return false;
        }
    }
}
