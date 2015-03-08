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
    
    public function getData($nis = "Empty"){
        $where = ($nis === "Empty")?"":"Where nis = ".$nis;
        $data = $this->db->query("select * from siswa ".$where);
        return ($nis === "Empty")?$data->result():$data->result()[0];
    }
    
    public function insertData($data, $table_name = 'siswa'){
        if(!$this->dataExist($data['nis'])){
            $this->setData($data);
            $this->db->insert($table_name);
            return true;
        }else{
            return false;
        }
    }
    
    public function updateData($data, $table_name = 'siswa'){
        if($this->dataExist($data['nis'])){
            $this->setData($data);
            $this->db->replace($table_name);
            return true;
        }else{
            return false;
        }
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
        if (!empty($data['nis'])) : $this->db->set('nis',$data['nis']); endif;
        if (!empty($data['nama'])) : $this->db->set('nama',$data['nama']); endif;
        if (!empty($data['jenis_kelamin'])) : $this->db->set('jenis_kelamin',$data['jenis_kelamin']); endif;
        if (!empty($data['tempat_lahir'])) : $this->db->set('tempat_lahir',$data['tempat_lahir']); endif;
        if (!empty($data['tgl_lahir'])) : $this->db->set('tgl_lahir',$data['tgl_lahir']); endif;
        if (!empty($data['kelas'])) : $this->db->set('kelas',$data['kelas']); endif;
        if (!empty($data['jurusan'])) : $this->db->set('jurusan',$data['jurusan']); endif;
        if (!empty($data['no_kelas'])) : $this->db->set('no_kelas',$data['no_kelas']); endif;
        if (!empty($data['password'])) : $this->db->set('password',$data['password']); endif;
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
