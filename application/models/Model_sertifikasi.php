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
 * Description of Model_sertifikasi
 *
 * @author s4if
 */
class Model_sertifikasi extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getDataById($id){
        $data = $this->db->query("select * from sertifikasi "."Where id = ".$id);
        return $data->result();
    }
    
    public function getDataByNis($nis){
        $data = $this->db->query("select * from sertifikasi "."Where nis = ".$nis);
        return $data->result();
    }
    
    public function insertData($data, $table_name = 'sertifikasi'){
        if(!$this->dataExist($data['id'])){
            $this->setData($data);
            $this->db->insert($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function updateData($data, $table_name = 'sertifikasi'){
        if($this->dataExist($data['id'])){
            $this->setData($data);
            $this->db->replace($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        if($this->dataExist($where['id'])){
            $this->db->where('id', $where['id']);
            $this->db->delete('sertifikasi');
            return true;
        }else{
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    private function setData($data){
        if (!empty($data['id'])) : $this->db->set('id',$data['id']); endif;
        if (!empty($data['nis'])) : $this->db->set('nis',$data['nis']); endif;
        if (!empty($data['nama'])) : $this->db->set('nama',$data['nama']); endif;
        if (!empty($data['tempat_ujian'])) : $this->db->set('tempat_ujian',$data['tempat_ujian']); endif;
        if (!empty($data['tgl_ujian'])) : $this->db->set('tgl_ujian',$data['tgl_ujian']); endif;
        if (!empty($data['juz'])) : $this->db->set('juz',$data['juz']); endif;
        if (!empty($data['nilai'])) : $this->db->set('nilai',$data['nilai']); endif;
        if (!empty($data['predikat'])) : $this->db->set('predikat',$data['predikat']); endif;
        if (!empty($data['keterangan'])) : $this->db->set('keterangan',$data['keterangan']); endif;
    }
    
    private function dataExist($id) {
        $query = $this->db->get_where('sertifikasi', ['id' => $id]);
        $rows = $query->num_rows();
        if($rows > 0){
            return true;
        }else{
            return false;
        }
    }
}
