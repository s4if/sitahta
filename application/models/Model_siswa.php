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
    
    /**
     * 
     * @param type $file_url
     * @return 0 for ok, -1 for file wrong, > 0 for data wrong
     */
    public function importData($file_url){
        try {
            $objReader = new PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($file_url);
            $objWorksheet = $objPHPExcel->getActiveSheet();
            $lastRow = $objWorksheet->getHighestDataRow();
            $failureCount = 0;
            $this->db->trans_begin();
            $data = $objWorksheet->rangeToArray('A1'.':I'.$lastRow, null, TRUE);
            for ($i = 1; $i < $lastRow;$i++){
                $row_data = $data[$i];
                if($this->cellValidation($row_data)){
                    $data_insert = $this->dataCorrection($row_data);
                    $this->db->query("REPLACE INTO siswa (nis, nama, jenis_kelamin, tempat_lahir, "
                            . "tgl_lahir, kelas, jurusan, no_kelas, nama_ortu, password) "
                            . "VALUES ('".$data_insert[0]."', '".$data_insert[1]."', '".$data_insert[2]."', '"
                            . $data_insert[3]."', '".$data_insert[4]."', '".$data_insert[5]."', '"
                            . $data_insert[6]."', '".$data_insert[7]."', '".$data_insert[8]."', '"
                            . md5('qwerty')."')");
                }  else {
                    $failureCount++;
                }
            }
            if(($failureCount > 0) || !$this->db->trans_status()){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }
            return $failureCount;
        }  catch (PHPExcel_Exception $ex) {
            return -1;
        }
    }
    
    private function cellValidation($row_data){
        $cellValid = true;
        foreach ($row_data as $cell){
            if(is_null($cell)){
                $cellValid = false;
                break;
            }
        }
        return $cellValid;
    }
    
    private function dataCorrection($row_data){
        //cek tanggal
        $tgl_mentah = explode("/", $row_data[4]);
        $row_data[4] = $tgl_mentah[2].'-'.$tgl_mentah[1].'-'.$tgl_mentah[0];
        if(!(($row_data[5] == 'X') || ($row_data[5] == 'XI') || ($row_data[5] == 'XII'))){
            $row_data[5] = 'X';
        }
        if(!(($row_data[6] == 'Reguler') || ($row_data[6] == 'Tahfidz') || ($row_data[6] == 'IPA') || ($row_data[6] == 'IPS'))){
            $row_data[6] = ($row_data[5] == 'X')?'Reguler':'IPA';
        }
        return $row_data;
    }
}
