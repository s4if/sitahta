<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_siswa
 *
 * @author s4if
 */
class Model_siswa extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($nip = "Empty"){
        
    }
    
    public function insertData($data, $table_name = 'guru'){
        
    }
    
    public function updateData($data, $table_name = 'guru'){
        
    }
    
    public function deleteData($where){
        if($this->dataExist($where['nis'])){
            $this->db->delete('siswa', $where);
            return true;
        }else{
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data){
        
    }
    
    //$where is an array that has nis properties
    public function dataExist($nis) {
        $query = $this->db->query("SELECT * FROM siswa where nis ='".$nis."';");
        $rows = $query->num_rows();
        if($rows == 1){
            return true;
        }else{
            return false;
        }
    }
}
