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
 * Description of Model_nilai
 *
 * @author s4if
 */
class Model_nilai extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($no_uh, $nis){
        $data = $this->db->get_where('nilai', ['no_uh' => $no_uh, 'nis' => $nis]);
        return $data->row();
    }
    
    public function getDataById($no_uh){
        $data = $this->db->query("select * from nilai "."Where no_uh = ".$no_uh);
        return $data->result();
    }
    
    public function getDataByNis($nis){
        $data = $this->db->query("select * from nilai "."Where nis = ".$nis);
        return $data->result();
    }
    
    public function insertData($data, $table_name = 'nilai'){
        if(!$this->dataExist($data['no_uh'], $data['nis'])){
            $this->setData($data);
            $this->db->insert($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function updateData($data, $table_name = 'nilai'){
        if($this->dataExist($data['no_uh'], $data['nis'])){
            $this->setData($data);
            $this->db->replace($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        if($this->dataExist($where['no_uh'], $where['nis'])){
            $this->db->where('no_uh', $where['no_uh']);
            $this->db->where('nis', $where['nis']);
            $this->db->delete('nilai');
            return true;
        }else{
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data){
        if (!empty($data['no_uh'])) : $this->db->set('no_uh',$data['no_uh']); endif;
        if (!empty($data['nis'])) : $this->db->set('nis',$data['nis']); endif;
        if (!empty($data['tanggal'])) : $this->db->set('tanggal',$data['tanggal']); endif;
        if (!empty($data['juz'])) : $this->db->set('juz',$data['juz']); endif;
        if (!empty($data['halaman'])) : $this->db->set('halaman',$data['halaman']); endif;
        if (!empty($data['nilai'])) : $this->db->set('nilai',$data['nilai']); endif;
        if (!empty($data['penguji'])) : $this->db->set('penguji',$data['penguji']); endif;
    }
    
    public function dataExist($no_uh, $nis) {
        $query = $this->db->get_where('nilai', ['no_uh' => $no_uh, 'nis' => $nis]);
        $rows = $query->num_rows();
        if($rows > 0){
            return true;
        }else{
            return false;
        }
    }
}