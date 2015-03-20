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
        if (!empty($data['nama_ortu'])) : $this->db->set('nama_ortu',$data['nama_ortu']); endif;
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
    
    public function getFilteredData($params){
        $where = [];
        if($params['no_kelas'] === '0' && $params['jurusan'] === 'empty' &&  !($params['kelas'] === 'empty') ){
            $where = ['kelas' => $params['kelas']];
        }elseif ($params['no_kelas'] === '0' && $params['kelas'] === 'empty' &&  !($params['jurusan'] === 'empty')) {
            $where = ['jurusan' => $params['jurusan']];
        }elseif ($params['no_kelas'] === '0' && !($params['jurusan'] === 'empty') && !($params['kelas'] === 'empty')) {
            $where = ['kelas' => $params['kelas'], 'jurusan' => $params['jurusan']];
        }elseif ($params['kelas'] === 'empty' && !($params['jurusan'] === 'empty') && !($params['no_kelas'] === '0')) {
            $where = ['jurusan' => $params['jurusan'], 'no_kelas' => $params['no_kelas']];
        }elseif(!($params['no_kelas'] === '0') && !($params['jurusan'] === 'empty') && !($params['kelas'] === 'empty')){
            $where = ['kelas' => $params['kelas'], 'jurusan' => $params['jurusan'], 'no_kelas' => $params['no_kelas']];
        }else{
            
        }
        $query = $this->db->get_where("siswa",$where);
        return $query->result();
    }
}
