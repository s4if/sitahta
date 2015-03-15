<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
    
    public function getDataById($id){
        $data = $this->db->query("select * from nilai "."Where id = ".$id);
        return $data->result()[0];
    }
    
    public function getDataByNis($nis){
        $data = $this->db->query("select * from nilai "."Where nis = ".$nis);
        return $data->result();
    }
    
    public function insertData($data, $table_name = 'nilai'){
        if(!$this->dataExist($data['id'])){
            $this->setData($data);
            $this->db->insert($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function updateData($data, $table_name = 'nilai'){
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
            $this->db->delete('nilai');
            return true;
        }else{
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data){
        if (!empty($data['id'])) : $this->db->set('id',$data['id']); endif;
        if (!empty($data['nis'])) : $this->db->set('nis',$data['nis']); endif;
        if (!empty($data['tanggal'])) : $this->db->set('tanggal',$data['tanggal']); endif;
        if (!empty($data['juz'])) : $this->db->set('juz',$data['juz']); endif;
        if (!empty($data['halaman'])) : $this->db->set('halaman',$data['halaman']); endif;
        if (!empty($data['nilai'])) : $this->db->set('nilai',$data['nilai']); endif;
        if (!empty($data['penguji'])) : $this->db->set('penguji',$data['penguji']); endif;
    }
    
    private function dataExist($id) {
        $query = $this->db->get_where('nilai', array('id' => $id));
        $rows = $query->num_rows();
        if($rows > 0){
            return true;
        }else{
            return false;
        }
    }
}
