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
    
    public function getData($where){
        $data = $this->db->get_where('nilai', $where);
        return $data->result();
    }
    
    public function getDataById($no_uh){
        $data = $this->db->query("select "
                . "nilai.no_uh as 'no_uh', "
                . "nilai.kelas as 'kelas', "
                . "nilai.nis as 'nis', "
                . "nilai.tanggal as 'tanggal', "
                . "nilai.juz as 'juz', "
                . "nilai.halaman as 'halaman', "
                . "nilai.nilai as 'nilai', "
                . "nilai.penguji as 'penguji', "
                . "guru.nama as 'nama_penguji' "
                . "from nilai inner join guru on nilai.penguji = guru.nip "
                . "Where nilai.no_uh = ".$no_uh);
        return $data->result();
    }
    
    public function getDataByNis($nis){
        $data = $this->db->query("select "
                . "nilai.no_uh as 'no_uh', "
                . "nilai.kelas as 'kelas', "
                . "nilai.nis as 'nis', "
                . "nilai.tanggal as 'tanggal', "
                . "nilai.juz as 'juz', "
                . "nilai.halaman as 'halaman', "
                . "nilai.nilai as 'nilai', "
                . "nilai.penguji as 'penguji', "
                . "guru.nama as 'nama_penguji' "
                . "from nilai inner join guru on nilai.penguji = guru.nip "
                . "Where nilai.nis = ".$nis);
        return $data->result();
    }
    
    public function getNilaiSiswa(){
        $data = $this->db->query("select "
                . "nilai.no_uh as 'no_uh', "
                . "nilai.kelas as 'kelas', "
                . "nilai.nis as 'nis', "
                . "nilai.tanggal as 'tanggal', "
                . "nilai.juz as 'juz', "
                . "nilai.halaman as 'halaman', "
                . "nilai.nilai as 'nilai', "
                . "nilai.penguji as 'penguji', "
                . "siswa.nis as 'nis' "
                . "from nilai join siswa where nilai.nis = siswa.nis and siswa.kelas = nilai.kelas");
        $data_arr = array();
        foreach ($data->result() as $row)
        {
            $data_arr[$row->nis][$row->no_uh] = $row;
        }
        return $data_arr;
    }

    public function getDataByKelas($kelas){
        $data = $this->db->query("select * from nilai "."Where kelas = '".$kelas."'");
        return $data->result();
    }
    
    public function insertData($data, $replace = false){
        if((!$this->dataExist($data['no_uh'], $data['nis'], $data['kelas'])) || $replace){
            $this->setData($data);
            if($replace){
                $this->db->replace('nilai');
            }  else {
                $this->db->insert('nilai');
            }
            return true;
        }else{
            return false;
        }
    }
    
    public function updateData($data){
        if($this->dataExist($data['no_uh'], $data['nis'], $data['kelas'])){
            $this->setData($data);
            $this->db->replace('nilai');
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteData($where){
        if($this->dataExist($where['no_uh'], $where['nis'], $where['kelas'])){
            $this->db->delete('nilai', $where);
            return true;
        }else{
            return false;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    public function setData($data){
        if (!empty($data['no_uh'])) : $this->db->set('no_uh',$data['no_uh']); endif;
        if (!empty($data['kelas'])) : $this->db->set('kelas',$data['kelas']); endif;
        if (!empty($data['nis'])) : $this->db->set('nis',$data['nis']); endif;
        if (!empty($data['tanggal'])) : $this->db->set('tanggal',$data['tanggal']); endif;
        if (!empty($data['juz'])) : $this->db->set('juz',$data['juz']); endif;
        if (!empty($data['halaman'])) : $this->db->set('halaman',$data['halaman']); endif;
        if (!empty($data['nilai'])) : $this->db->set('nilai',$data['nilai']); endif;
        if (!empty($data['penguji'])) : $this->db->set('penguji',$data['penguji']); endif;
    }
    
    public function dataExist($no_uh, $nis, $kelas) {
        $query = $this->db->get_where('nilai', ['no_uh' => $no_uh, 'nis' => $nis, 'kelas' => $kelas]);
        $rows = $query->num_rows();
        return ($rows > 0)?TRUE:FALSE;
    }
}
